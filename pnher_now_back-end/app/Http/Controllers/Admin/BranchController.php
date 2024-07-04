<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResource;
use App\Models\Supervisor\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        $branches = BranchResource::collection($branches);
        return view('branch.index',['branches' => $branches]);
        // return view('branch.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('branch.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'user_id'=>'required',
            'company_id' => 'required',
            'address' => 'required',
        ]);
        $branch = Branch::create([
            'name'=>$request->name,
            'user_id'=>$request->user_id,
            'company_id'=>$request->company_id,
            'address'=>$request->address,
        ]);
        $branch->syncRoles($request->roles);
        return redirect()->back()->withSuccess('Branch created !!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
