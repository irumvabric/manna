<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response; // For CSV download

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->getFilteredQuery($request);

        // Get filtered results for calculation
        $filteredDonations = $query->get();
        $totalRecords = $filteredDonations->count();
        $totalAmount = $filteredDonations->sum('amount');

        // Pagination for the table
        $donations = $query->latest()->paginate(10);

        return view('admin.reports.index', compact(
            'donations',
            'totalRecords',
            'totalAmount'
        ));
    }

    public function export(Request $request, $type)
    {
        if ($type === 'excel') {
            // Fallback to CSV since Excel package had installation issues
            return $this->exportCsv($request);
        } 
        
        if ($type === 'pdf') {
            $query = $this->getFilteredQuery($request);
            $donations = $query->get();
            $totalAmount = $donations->sum('amount');
            $totalRecords = $donations->count();

            $pdf = Pdf::loadView('admin.reports.pdf', compact('donations', 'totalAmount', 'totalRecords'));
            return $pdf->download('donations_' . now()->format('Ymd_His') . '.pdf');
        }

        return back();
    }

    private function exportCsv(Request $request)
    {
        $query = $this->getFilteredQuery($request);
        $donations = $query->get();
        $filename = "donations_" . now()->format('Ymd_His') . ".csv";

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Donator Name', 'Email', 'Amount', 'Currency', 'Periodicity', 'Status', 'Date');

        $callback = function() use($donations, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($donations as $donation) {
                $periodMap = [
                    1 => 'Monthly',
                    3 => 'Quarterly', 
                    6 => 'Semiannually',
                    12 => 'Yearly'
                ];
                
                $row = [
                    $donation->donator ? ($donation->donator->name . ' ' . $donation->donator->surname) : 'Unknown',
                    $donation->donator ? $donation->donator->email : '-',
                    $donation->amount,
                    $donation->currency,
                    $periodMap[$donation->donator->periodicity ?? 1] ?? 'Monthly',
                    ucfirst($donation->status),
                    $donation->created_at->format('Y-m-d H:i:s'),
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getFilteredQuery(Request $request)
    {
        $query = Donation::with('donator');

        // Filter by Period
        if ($request->filled('period')) {
            $period = $request->input('period');
            $query->whereHas('donator', function($q) use ($period) {
                $q->where('periodicity', $period);
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by Donator Name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('donator', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query;
    }
}
