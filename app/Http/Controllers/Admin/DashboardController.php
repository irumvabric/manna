<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total Received (Approved Donations)
        // Assuming 'controller' field being NOT NULL means Approved
        $totalReceived = Donation::sum('amount');

        // 2. Pending Approvals
        $pendingApprovalCount = Donation::count();

        // 3. Active Donators
        $activeDonatorsCount = Donator::count();

        // 4. Late Donations (Overdue payments)
        // Logic: Find donators whose last approved donation is older than their periodicity allows.
        $lateDonationsCount = 0;
        $activeDonators = Donator::all();
        
        // Periodicity Map: ID => Days
        $periodicityMap = [
            1 => 30,  // Monthly
            3 => 90,  // Quarterly
            6 => 180, // Semiannually
            12 => 365 // Yearly
        ];

        foreach ($activeDonators as $donator) {
            $days = $periodicityMap[$donator->periodicity ?? 1] ?? 30; // Default to 30 days
            
            $lastDonation = Donation::where('donator_id', $donator->id)
                                    ->latest()
                                    ->first();
            
            $isLate = false;
            
            if (!$lastDonation) {
                // If never donated, check creation date
                if ($donator->created_at->diffInDays(now()) > $days) {
                    $isLate = true;
                }
            } else {
                if ($lastDonation->created_at->diffInDays(now()) > $days) {
                    $isLate = true;
                }
            }

            if ($isLate) {
                $lateDonationsCount++;
            }
        }

        // 5. Chart Data: Donations per Period (Last 6 Months)
        $months = [];
        $monthlyData = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M');
            $year = $date->year;
            $month = $date->month;

            $sum = Donation::whereYear('created_at', $year)
                           ->whereMonth('created_at', $month)
                           ->sum('amount');
            
            $months[] = $monthName;
            $monthlyData[] = $sum;
        }

        // 6. Chart Data: Status Distribution
        $statusDistribution = [
            'labels' => ['Approved', 'Pending', 'Late'],
            'data' => [
                Donation::count(),
                $pendingApprovalCount,
                $lateDonationsCount
            ]
        ];

        // 7. Recent Donations
        $recentDonations = Donation::with('donator')
            ->latest()
            ->take(5)
            ->get()
            ->map(function($donation) {
                $status = $donation->status;
                
                // Check if this specific donation is "Late" (maybe not applicable to single donation, 
                // but we can check if it was made "late" relative to previous? 
                // For simplicity, we use Approved/Pending/Late based on logic if it's pending but old?)
                
                if ($status === 'pending' && $donation->created_at->diffInDays(now()) > 30) {
                     $status = 'late'; // Override strict pending if very old?
                }

                return (object)[
                    'donator_name' => $donation->donator ? ($donation->donator->name . ' ' . $donation->donator->surname) : 'Unknown',
                    'amount' => $donation->amount,
                    'period' => $this->getPeriodLabel($donation->donator->periodicity ?? 1),
                    'status' => $status,
                    'date' => $donation->created_at->format('Y-m-d'),
                    'currency' => $donation->currency,
                    'avatar' => $donation->donator ? substr($donation->donator->name, 0, 1) : '?'
                ];
            });

        return view('admin.dashboard', compact(
            'totalReceived', 
            'pendingApprovalCount', 
            'activeDonatorsCount', 
            'lateDonationsCount',
            'months',
            'monthlyData',
            'statusDistribution',
            'recentDonations'
        ));
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
