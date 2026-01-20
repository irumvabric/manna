<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DonationNotification;
use App\Models\Donation;
use App\Models\Donator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        // For "Record Donation" modal
        $donatorsList = Donator::all();

        return view('admin.donations.index', compact(
            'donations',
            'donatorsList',
            'totalApprovedAmount',
            'pendingAmount',
            'thisMonthAmount',
            'todayCount'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'target_amount' => 'required|numeric|min:0',
            'periodicity' => 'required|string',
            'currency' => 'required|string|size:3',
        ]);

        // Find or create donator
        $donator = Donator::updateOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'phone' => $request->phone,
                'target_amount' => $request->target_amount,
                'periodicity' => $request->periodicity,
                'currency' => $request->currency,
            ]
        );

        // Record the donation as pending
        Donation::create([
            'donator_id' => $donator->id,
            'amount' => $request->target_amount,
            'currency' => $request->currency,
            'status' => 'pending',
            'payment_method' => 'cash', // Default or placeholder
        ]);

        // Send notification to admin
        try {
            $adminEmail = 'irumvabric@gmail.com'; // Fallback or configured admin email
            Mail::to($adminEmail)->send(new DonationNotification($request->all(), 'donation'));
        } catch (\Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Your donation submission has been received. Thank you!');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Send notification to admin
        try {
            $adminEmail = 'irumvabric@gmail.com';
            Mail::to($adminEmail)->send(new DonationNotification($request->all(), 'contact'));
        } catch (\Exception $e) {
            Log::error('Contact Mail sending failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Your message has been sent successfully. We will get back to you soon!');
    }

    public function storeManual(Request $request)
    {
        $request->validate([
            'donator_id' => 'required|exists:donators,id',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'payment_method' => 'required|string',
            'status' => 'required|string',
        ]);

        Donation::create($request->all());

        return redirect()->back()->with('success', 'Donation recorded successfully.');
    }

    public function update(Request $request, Donation $donation)
    {
        if ($request->has('status')) {
            $donation->update(['status' => $request->status]);
            return redirect()->back()->with('success', 'Donation status updated to ' . $request->status . '.');
        }

        $request->validate([
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'payment_method' => 'required|string',
            'status' => 'required|string',
        ]);

        $donation->update($request->all());

        return redirect()->back()->with('success', 'Donation updated successfully.');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->back()->with('success', 'Donation deleted successfully.');
    }
}
