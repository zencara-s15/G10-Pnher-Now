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
        // $this->middleware('role_or_permission:Company access|Company create|Company edit|Company delete', ['only' => ['index','show']]);
        // $this->middleware('role_or_permission:Company create', ['only' => ['create','store']]);
        // $this->middleware('role_or_permission:Company edit', ['only' => ['edit','update']]);
        // $this->middleware('role_or_permission:Company delete', ['only' => ['destroy']]);
    // }

    public function index() {
        $company = Company::all();
        return view('company.index',['company' => $company]);
        // return view('companies.index');
    }

    public function create(){
        return view('company.new');
    }

    public function store(Request $request){
        // $request-> validate([
        //     'name'=> 'required',
        //     'address'=> 'required',
        // ]);

        $company = Company::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->back()->withSuccess('Company created !!!');
    }

    public function show($id){
        $company = Company::find($id);
        return view('company.show', compact('company'));
    }

    public function edit($id){
        $company = Company::find($id);
        return view('company.edit', compact('company'));
    }

}
