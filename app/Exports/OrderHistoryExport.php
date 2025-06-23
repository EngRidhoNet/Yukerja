<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class OrderHistoryExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $transactions;
    protected $stats;

    public function __construct($transactions, $stats)
    {
        $this->transactions = $transactions;
        $this->stats = $stats;
    }

    public function collection()
    {
        return $this->transactions;
    }

    public function headings(): array
    {
        return [
            'No.',
            'No. Invoice',
            'Layanan',
            'Mitra',
            'Total (Rp)',
            'Status Pembayaran',
            'Metode Pembayaran',
            'Tanggal Pesanan',
            'Tanggal Pembayaran',
            'Referensi Transaksi'
        ];
    }

    public function map($transaction): array
    {
        static $no = 1;
        
        return [
            $no++,
            $transaction->invoice_number,
            $transaction->job_title,
            $transaction->mitra_name,
            number_format($transaction->amount, 0, ',', '.'),
            $this->getStatusText($transaction->payment_status),
            $transaction->payment_method ?? '-',
            $transaction->created_at ? Carbon::parse($transaction->created_at)->format('d/m/Y H:i') : '-',
            $transaction->payment_date ? Carbon::parse($transaction->payment_date)->format('d/m/Y H:i') : '-',
            $transaction->transaction_reference ?? '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->transactions->count() + 1;
        
        return [
            // Style untuk header
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 12,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0B2F57'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            
            // Style untuk semua data
            "A1:J{$lastRow}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'CCCCCC'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            
            // Style untuk kolom nomor
            "A2:A{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],
            
            // Style untuk kolom total
            "E2:E{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                ],
                'font' => [
                    'bold' => true,
                ],
            ],
            
            // Style untuk kolom status
            "F2:F{$lastRow}" => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 18,  // Invoice
            'C' => 30,  // Layanan
            'D' => 20,  // Mitra
            'E' => 15,  // Total
            'F' => 15,  // Status
            'G' => 20,  // Metode Pembayaran
            'H' => 18,  // Tanggal Pesanan
            'I' => 18,  // Tanggal Pembayaran
            'J' => 25,  // Referensi
        ];
    }

    public function title(): string
    {
        return 'Riwayat Pesanan';
    }

    private function getStatusText($status)
    {
        $statusMap = [
            'paid' => 'Lunas',
            'pending' => 'Pending',
            'failed' => 'Gagal',
            'refunded' => 'Refund'
        ];

        return $statusMap[$status] ?? ucfirst($status);
    }
}