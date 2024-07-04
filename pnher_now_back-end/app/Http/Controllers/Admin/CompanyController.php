<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('role_or_permission:Company access|Company create|Company edit|Company delete', ['only' => ['index','show']]);
    //     $this->middleware('role_or_permission:Company create', ['only' => ['create','store']]);
    //     $this->middleware('role_or_permission:Company edit', ['only' => ['edit','update']]);
    //     $this->middleware('role_or_permission:Company delete', ['only' => ['destroy']]);
    // }

    public function index() {
        // $company = Company::pagenate(4);
        // return view('companies.index', ['company' => $company]);
        return view('companies.index');
    }

    public function create(){
        return view('companies.new');
    }

    public function store(Request $request){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $companies = Company::create($data);
        return redirect()->back()->withSuccess('Company created !!!');
    }
}
