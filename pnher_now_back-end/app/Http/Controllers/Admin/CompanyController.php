<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:Company access|Company create|Company edit|Company delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Company create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Company edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Company delete', ['only' => ['destroy']]);
    }

    public function index() {
        $companies = Company::all();
        return redirect()->route('admin.company.index');
    }

    public function create(){
        return view('company.new');
    }

    public function store(Request $request){
        $data = $request->all();
        $company = Company::create($data);
        // Redirect to the company index page with a success message
        return redirect()->route('admin.company.index')->with('success', 'Company created successfully');
    }

    public function destroy(string $id){
        $company = Company::findOrFail( $id );
        $company->delete();
        // Redirect to the company index page with a success message
        return redirect()->route('admin.company.index')->withSuccess('Company deleted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id){
        $company = Company::findOrFail( $id );
        $company = Company::findOrFail( $company->id );
        return view('company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company){
        $company->update($request->all());
        return redirect()->route('admin.company.index')->withSuccess('Company updated successfully');
    }

    
}