<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donator;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'donators' => Donator::count(),
            'donations' => Donation::count(),
        ];

        $recentContacts = Donation::latest()->take(5)->get();
        $recentAnnonces = Donation::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recentContacts', 'recentAnnonces'));
    }
}
