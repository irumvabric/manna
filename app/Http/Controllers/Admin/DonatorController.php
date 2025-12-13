<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donator;
use Illuminate\Http\Request;

class DonatorController extends Controller
{
    public function index(Request $request)
    {
        $query = Donator::query();

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('surname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Periodicity Filter
        if ($request->filled('periodicity')) {
            $query->where('periodicity', $request->input('periodicity'));
        }

        // Status/Currency Filter (Optional, added based on available fields)
        if ($request->filled('currency')) {
            $query->where('currency', $request->input('currency'));
        }

        $donators = $query->latest()->paginate(10);

        // Stats for the top cards
        $totalDonators = Donator::count();
        $monthlyDonators = Donator::where('periodicity', 1)->count();
        $yearlyDonators = Donator::where('periodicity', 12)->count();
        // Calculate total potential monthly revenue (approximation)
        // Convert all to a base currency if needed, but for now sum target_amount 
        // assuming single currency or just raw sum.
        $totalTargetAmount = Donator::sum('target_amount');

        return view('admin.donators.index', compact(
            'donators',
            'totalDonators',
            'monthlyDonators',
            'yearlyDonators',
            'totalTargetAmount'
        ));
    }
}
