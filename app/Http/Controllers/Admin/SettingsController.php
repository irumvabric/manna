<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        // Load settings from DB and pass to view
        $settings = [
            'email_notifications' => \App\Models\Setting::getBool('email_notifications', true),
            'late_payment_alerts' => \App\Models\Setting::getBool('late_payment_alerts', true),
            'reminder_days' => \App\Models\Setting::get('reminder_days', 7),
            'auto_approval' => \App\Models\Setting::getBool('auto_approval', false),
            'admin_email' => \App\Models\Setting::get('admin_email', config('mail.from.address', 'admin@donation.com')),
        ];

        return view('admin.Settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Validate inputs
        $request->validate([
            'reminder_days' => 'required|integer|min:1',
            'admin_email' => 'required|email',
        ]);

        // Save boolean toggles as 1/0
        \App\Models\Setting::set('email_notifications', $request->has('email_notifications'));
        \App\Models\Setting::set('late_payment_alerts', $request->has('late_payment_alerts'));
        \App\Models\Setting::set('auto_approval', $request->has('auto_approval'));

        // Save other values
        \App\Models\Setting::set('reminder_days', $request->input('reminder_days'));
        \App\Models\Setting::set('admin_email', $request->input('admin_email'));

        return back()->with('success', 'Settings updated successfully.');
    }
}
