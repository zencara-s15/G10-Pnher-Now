<?php

namespace App\Http\Controllers\API\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Supervisor\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }

    public function index()
    {
        // dd(1);
        $branches = Branch::with(['company', 'user'])->get();
        return response()->json($branches);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'address' => 'required',
        ]);

        $branch = Branch::create($request->all());

        return response()->json($branch, 201);
    }
}
