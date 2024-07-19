<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaggageInStockesResource;
use App\Models\Baggage;
use Illuminate\Http\Request;

class BaggageInStockeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $baggageInStockes = Baggage::all();
        $baggageInStockes = Baggage::where('delivery_status_id', 3)->get();
        $baggageInStockes = BaggageInStockesResource::collection($baggageInStockes);
        return view('supervisor.list_instock',['baggageInStockes' => $baggageInStockes]);
    }


    public function itemDetail(){
        $details = Baggage::where('delivery_status_id', 3)->get();
        $details = BaggageInStockesResource::collection($details);
        return view('supervisor.item_detail',['baggageInStockes' => $details]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
