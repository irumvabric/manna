<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderBy('id')->get();

        return view('pages.about', compact('teamMembers'));
    }
}