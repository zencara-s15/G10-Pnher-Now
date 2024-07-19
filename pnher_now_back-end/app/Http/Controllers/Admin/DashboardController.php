<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Baggage;
use App\Models\Company;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalCompanies = Company::count();
        $totalBaggages = Baggage::count();
        // $allFeedbacks = Feedback::count();
        return view('dashboard', compact('totalUsers', 'totalCompanies', 'totalBaggages'));
    }
}
