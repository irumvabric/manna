<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; // Will be available after install
use App\Exports\DonationsExport;     // We will create this
use Barryvdh\DomPDF\Facade\Pdf;      // Will be available after install

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
            return Excel::download(new DonationsExport($request->all()), 'donations_' . now()->format('Ymd_His') . '.xlsx');
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
