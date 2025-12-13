<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $query = Donation::with('donator');

        // Search Filter (by Donator Name)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('donator', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('surname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Payment Method Filter
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->input('payment_method'));
        }

        // Date Filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        // Sorting
        $donations = $query->latest()->paginate(10);

        // Stats Logic
        // 1. Total Approved Amount (All time)
        $totalApprovedAmount = Donation::where('status', 'approved')->sum('amount');
        
        // 2. Pending Amount (Potential revenue waiting approval)
        $pendingAmount = Donation::where('status', 'pending')->sum('amount');

        // 3. This Month's Donations (Approved)
        $thisMonthAmount = Donation::where('status', 'approved')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('amount');

        // 4. Today's Count
        $todayCount = Donation::whereDate('created_at', today())->count();

        return view('admin.donations.index', compact(
            'donations',
            'totalApprovedAmount',
            'pendingAmount',
            'thisMonthAmount',
            'todayCount'
        ));
    }
}
