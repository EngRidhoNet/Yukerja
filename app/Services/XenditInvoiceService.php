<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class XenditInvoiceService
{
    protected $xenditApiKey;
    protected $xenditApiUrl;

    public function __construct()
    {
        $this->xenditApiKey = config('services.xendit.secret_key');
        $this->xenditApiUrl = 'https://api.xendit.co/v2/invoices';
        
        // Log untuk debugging
        Log::info('XenditInvoiceService initialized', [
            'api_key_present' => !empty($this->xenditApiKey),
            'api_key_prefix' => $this->xenditApiKey ? substr($this->xenditApiKey, 0, 10) . '...' : 'null'
        ]);
    }

    public function generateExternalId()
    {
        return 'INV-' . now()->format('Ymd-His') . '-' . strtoupper(substr(md5(uniqid()), 0, 6));
    }

    public function createInvoice($externalId, $amount, $customerEmail, $description, $successRedirectUrl, $failureRedirectUrl = null)
    {
        // Validate API key
        if (empty($this->xenditApiKey)) {
            throw new \Exception('Xendit API key tidak dikonfigurasi. Silakan periksa file .env');
        }

        try {
            $client = new Client();

            $payload = [
                'external_id' => $externalId,
                'amount' => (int) $amount,
                'payer_email' => $customerEmail,
                'description' => $description,
                'success_redirect_url' => $successRedirectUrl,
                'currency' => 'IDR',
                'should_send_email' => false,
            ];

            // Add failure redirect if provided
            if ($failureRedirectUrl) {
                $payload['failure_redirect_url'] = $failureRedirectUrl;
            }

            Log::info('Creating Xendit invoice', [
                'payload' => $payload,
                'api_key_prefix' => substr($this->xenditApiKey, 0, 10) . '...'
            ]);

            $authHeader = 'Basic ' . base64_encode($this->xenditApiKey . ':');
            Log::info('Authorization header created', [
                'auth_header_prefix' => substr($authHeader, 0, 20) . '...'
            ]);

            $response = $client->post($this->xenditApiUrl, [
                'headers' => [
                    'Authorization' => $authHeader,
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            $responseData = json_decode($response->getBody(), true);
            Log::info('Xendit invoice created successfully', $responseData);
            
            return $responseData;

        } catch (RequestException $e) {
            Log::error('Xendit API Error', [
                'message' => $e->getMessage(),
                'status_code' => $e->getCode(),
            ]);
            
            if ($e->hasResponse()) {
                $responseBody = (string) $e->getResponse()->getBody();
                Log::error('Xendit API Response Body: ' . $responseBody);
                
                // Parse error message untuk memberikan feedback yang lebih baik
                $errorData = json_decode($responseBody, true);
                if (isset($errorData['message'])) {
                    throw new \Exception('Xendit Error: ' . $errorData['message']);
                }
            }
            
            throw new \Exception('Gagal membuat invoice pembayaran: ' . $e->getMessage());
        }
    }
}