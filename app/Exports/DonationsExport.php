<?php

namespace App\Exports;

use App\Models\Donation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DonationsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = Donation::with('donator');
        $filters = $this->filters;

        // Re-implementing filter logic here to ensure export matches view
        if (!empty($filters['period'])) {
            $period = $filters['period'];
            $query->whereHas('donator', function($q) use ($period) {
                $q->where('periodicity', $period);
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->whereHas('donator', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    public function map($donation): array
    {
        return [
            $donation->donator ? ($donation->donator->name . ' ' . $donation->donator->surname) : 'Unknown',
            $donation->donator ? $donation->donator->email : '-',
            $donation->amount,
            $donation->currency,
            $this->getPeriodLabel($donation->donator->periodicity ?? 1),
            ucfirst($donation->status),
            $donation->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Donator Name',
            'Email',
            'Amount',
            'Currency',
            'Periodicity',
            'Status',
            'Date',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text
            1 => ['font' => ['bold' => true]],
        ];
    }

    private function getPeriodLabel($p) {
        $map = [
           1 => 'Monthly',
           3 => 'Quarterly',
           6 => 'Semiannually',
           12 => 'Yearly'
       ];
       return $map[$p] ?? 'Monthly';
   }
}
