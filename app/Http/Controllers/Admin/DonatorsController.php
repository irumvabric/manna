<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donator;
use Illuminate\Http\Request;

class DonatorsController extends Controller
{
    public function index()
    {

        $donators = Donator::all(); // Fetch donators from the database or service
        return view('admin.donators.index', compact('donators'));
    }
}
