<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Transaction;
use App\Services\XenditInvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $xenditService;

    public function __construct(XenditInvoiceService $xenditService)
    {
        $this->xenditService = $xenditService;
    }

    public function createPayment(JobApplication $application)
    {
        try {
            Log::info('Payment creation started for application: ' . $application->id);
            
            $this->authorizeApplication($application);

            if ($application->status !== 'accepted') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya penawaran yang telah diterima yang bisa dibayar.'
                ], 400);
            }

            // Check if transaction already exists
            $existingTransaction = Transaction::where('job_post_id', $application->job_post_id)
                ->where('mitra_id', $application->mitra_id)
                ->first();

            if ($existingTransaction && $existingTransaction->payment_status === 'paid') {
                return response()->json([
                    'success' => false,
                    'message' => 'Pembayaran sudah dilakukan sebelumnya.'
                ], 400);
            }

            DB::beginTransaction();

            // Create or update transaction
            $adminFeeRate = 0.05; // 5% admin fee
            $amount = $application->bid_amount;
            $adminFee = $amount * $adminFeeRate;
            $mitraEarning = $amount - $adminFee;

            $transaction = $existingTransaction ?: new Transaction();
            $transaction->fill([
                'job_post_id' => $application->job_post_id,
                'customer_id' => $application->jobPost->customer_id,
                'mitra_id' => $application->mitra_id,
                'amount' => $amount,
                // 'admin_fee' => $adminFee,
                // 'mitra_earning' => $mitraEarning,
                'payment_status' => 'pending',
                'invoice_number' => $existingTransaction ? $existingTransaction->invoice_number : 
                    'INV-' . date('Ymd') . '-' . str_pad($application->id, 6, '0', STR_PAD_LEFT),
            ]);
            $transaction->save();

            Log::info('Transaction saved with ID: ' . $transaction->id);

            // Create Xendit invoice with success redirect URL
            $externalId = $this->xenditService->generateExternalId();
            $customerEmail = Auth::user()->email;
            $description = "Pembayaran untuk pekerjaan: " . $application->jobPost->title;
            
            // Success redirect akan ke route yang mengupdate status
            $successRedirectUrl = route('customer.payment.success', [
                'application_id' => $application->id,
                'transaction_id' => $transaction->id
            ]);
            
            // Failure redirect
            $failureRedirectUrl = route('customer.dashboard.penawaran', ['payment_failed' => 1]);

            Log::info('Creating Xendit invoice for external ID: ' . $externalId);

            $invoice = $this->xenditService->createInvoice(
                $externalId,
                $amount,
                $customerEmail,
                $description,
                $successRedirectUrl,
                $failureRedirectUrl
            );

            // Update transaction with Xendit invoice details
            $transaction->update([
                'xendit_invoice_id' => $invoice['id'],
                'xendit_external_id' => $externalId,
                'payment_url' => $invoice['invoice_url'],
            ]);

            DB::commit();

            Log::info('Payment creation completed successfully for application: ' . $application->id);

            // Return JSON response with payment URL
            if (isset($invoice['invoice_url'])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Invoice pembayaran berhasil dibuat!',
                    'payment_url' => $invoice['invoice_url'],
                    'invoice_id' => $invoice['id']
                ]);
            } else {
                Log::error('Missing invoice_url in Xendit response: ' . json_encode($invoice));
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal membuat invoice pembayaran. Silakan coba lagi.'
                ], 500);
            }

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating payment: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        try {
            Log::info('Payment success callback received', $request->all());
            
            $applicationId = $request->get('application_id');
            $transactionId = $request->get('transaction_id');
            
            if (!$applicationId || !$transactionId) {
                Log::warning('Missing parameters in payment success callback');
                return redirect()->route('customer.dashboard.penawaran')->with([
                    'status' => 'error',
                    'message' => 'Parameter pembayaran tidak lengkap.'
                ]);
            }

            DB::beginTransaction();

            // Get transaction
            $transaction = Transaction::find($transactionId);
            if (!$transaction) {
                throw new \Exception('Transaksi tidak ditemukan.');
            }

            // Get application
            $application = JobApplication::find($applicationId);
            if (!$application) {
                throw new \Exception('Aplikasi tidak ditemukan.');
            }

            // Verify authorization
            $customer = Auth::user()->customer;
            if (!$customer || $transaction->customer_id !== $customer->id) {
                throw new \Exception('Unauthorized access.');
            }

            // Update transaction status
            $transaction->update([
                'payment_status' => 'paid',
                'payment_date' => now(),
                'payment_method' => 'xendit',
            ]);

            // Update application status to in_progress
            $application->update(['status' => 'in_progress']);
            
            // Update job post status to in_progress
            $application->jobPost->update(['status' => 'in_progress']);

            DB::commit();

            Log::info('Payment success processed for application: ' . $application->id);

            return redirect()->route('customer.dashboard.penawaran')->with([
                'status' => 'success',
                'message' => 'Pembayaran berhasil! Pekerjaan telah dimulai dan status diperbarui ke "Sedang Dikerjakan".'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error processing payment success: ' . $e->getMessage());

            return redirect()->route('customer.dashboard.penawaran')->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses pembayaran: ' . $e->getMessage()
            ]);
        }
    }

    private function authorizeApplication(JobApplication $application)
    {
        $customer = Auth::user()->customer;
        if (!$customer || $application->jobPost->customer_id !== $customer->id) {
            throw new \Exception('Unauthorized action.');
        }
    }
}