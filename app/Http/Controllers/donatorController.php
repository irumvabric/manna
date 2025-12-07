<?php

namespace App\Http\Controllers;

use App\Models\Donator;
use Illuminate\Http\Request;

class donatorController extends Controller
{
    function index()
    {
        return view('donator.index');
    }

    function store(Request $request)
    {
        $data = $request->validate([

            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            // 'payment_method' => 'required|string|max:100',
            'target_amount' => 'required|numeric|min:0.01',
            'periodicity' => 'nullable|string|max:100',
            'currency' => 'nullable|string|max:10',
        ]);

        // Save donator (use model properties to avoid mass-assignment issues)
        $donator = new Donator();

        $donator->name = $data['name'];
        $donator->email = $data['email'];
        $donator->phone = $data['phone'] ?? null;
        // $donator->payment_method = $data['payment_method'];
        $donator->target_amount = $data['target_amount'];
        $donator->periodicity = $data['periodicity'] ?? null;
        $donator->currency = $data['currency'] ?? null;
        $donator->save();

        return redirect()->back()->with('success', 'donator successful! Thank you for your support.');
    }
}
