<?php

namespace App\Http\Controllers\Donator;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Fetch donations for this user
        $donations = Donation::whereHas('donator', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->latest()->take(10)->get();

        $totalDonated = Donation::whereHas('donator', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->sum('amount');

        return view('donator.dashboard', compact('donations', 'totalDonated'));
    }
}
