<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        // specific settings are not yet in DB, so we pass default dummy data or nulls
        // In a real app, we would fetch key-value pairs from a 'settings' table.
        return view('admin.Settings.index');
    }

    public function update(Request $request)
    {
        // Validate and save settings
        $request->validate([
            'reminder_days' => 'required|integer|min:1',
            'admin_email' => 'required|email',
        ]);

        // Logic to save settings would go here (e.g., Settings::set('key', $value))

        return back()->with('success', 'Settings updated successfully.');
    }
}
