<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $userId;
    protected $status;
    protected $search;

    public function __construct($userId, $status, $search)
    {
        $this->userId = $userId;
        $this->status = $status;
        $this->search = $search;
    }

    public function collection()
    {
        $query = Transaction::where('customer_id', $this->userId)
            ->with(['jobPost', 'mitra.user']);

        if ($this->status !== 'all') {
            $query->where('payment_status', $this->status);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('invoice_number', 'like', "%{$this->search}%")
                  ->orWhereHas('jobPost', function ($q) {
                      $q->where('title', 'like', "%{$this->search}%");
                  })
                  ->orWhereHas('mitra.user', function ($q) {
                      $q->where('name', 'like', "%{$this->search}%");
                  });
            });
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No Invoice',
            'Layanan',
            'Mitra',
            'Total',
            'Biaya Admin',
            'Pendapatan Mitra',
            'Status',
            'Metode Pembayaran',
            'Tanggal Pesanan',
            'Tanggal Pembayaran',
            'Referensi Transaksi',
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->invoice_number,
            $transaction->jobPost->title ?? 'N/A',
            $transaction->mitra->user->name ?? 'N/A',
            number_format($transaction->amount, 2),
            number_format($transaction->admin_fee, 2),
            number_format($transaction->mitra_earning, 2),
            $transaction->payment_status,
            $transaction->payment_method ?? '',
            $transaction->created_at->format('Y-m-d H:i:s'),
            $transaction->payment_date ? $transaction->payment_date->format('Y-m-d H:i:s') : '',
            $transaction->transaction_reference ?? '',
        ];
    }
}