<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboardIndex()
    {
        $user = auth()->user();
        return view('layouts.dashboard', [
            'user' => $user,
        ]);
    }
}
