<?php

namespace App\Http\Controllers\Blogger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Simple dashboard for bloggers
        // You can add logic to fetch blogger-specific stats here
        return view('blogger.dashboard');
    }
}
