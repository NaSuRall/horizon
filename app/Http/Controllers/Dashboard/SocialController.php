<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
        $socials = Social::paginate(9);
        return view('dashboard.social', compact('socials'));
    }
    public function store(Request $request)
    {

    }
    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }
}


