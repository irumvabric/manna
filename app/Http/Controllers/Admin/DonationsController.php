<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationsController extends Controller
{
    public function index()
    {

        $donations = Donation::all(); // Fetch donations from the database or service
        return view('admin.donations.index', compact('donations'));
    }
}
