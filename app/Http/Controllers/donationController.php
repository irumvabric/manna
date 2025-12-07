<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donator;
use Illuminate\Http\Request;

class donationController extends Controller
{
    function index()
    {
        return view('donation.index');
    }

    function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'amount' => 'required|numeric|min:0.01',
            'frequency' => 'nullable|string|max:100',
            'comments' => 'nullable|string|max:2000',
            'currency' => 'nullable|string|max:10',
        ]);

        // Save donation (use model properties to avoid mass-assignment issues)
        $donation = new Donator();
        $donation->name = $data['name'];
        $donation->address = $data['address'] ?? null;
        $donation->email = $data['email'];
        $donation->phone = $data['phone'] ?? null;
        $donation->amount = $data['amount'];
        $donation->frequency = $data['frequency'] ?? null;
        $donation->comments = $data['comments'] ?? null;
        $donation->currency = $data['currency'] ?? null;
        $donation->save();

        return redirect()->back()->with('success', 'Donation successful! Thank you for your support.');
    }
}
