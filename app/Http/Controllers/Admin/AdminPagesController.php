<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPagesController extends Controller
{
    // Login Page Show
    public function ShowLoginPage()
    {
        return view('pages.login');
    }

    // Dashboard Page Show
    public function ShowDashboard()
    {
        return view('pages.dashboard');
    }

   
}
