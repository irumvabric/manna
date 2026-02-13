<?php

namespace App\Http\Controllers\Donator;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $donator = Donator::where('user_id', $user->id)->first();
        
        // Fetch donations for this user
        $donations = Donation::where('donator_id', $donator->id)
            ->latest()
            ->take(10)
            ->get();

        $totalDonated = Donation::where('donator_id', $donator->id)
            ->where('status', 'approved')
            ->sum('amount');

        $currencySymbol = $donator->currency_symbol ?? '$';

        return view('donator.dashboard', compact('donations', 'totalDonated', 'currencySymbol'));
    }
}
