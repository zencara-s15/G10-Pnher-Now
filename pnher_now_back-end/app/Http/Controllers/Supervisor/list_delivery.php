<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class list_delivery extends Controller
{
    public function index()
    {
        return view('supervisor.list_delivery');
    }
}
