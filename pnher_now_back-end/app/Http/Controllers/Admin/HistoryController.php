<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Baggage;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('supervisor.history');
    }

    public function history(){
        $delivery = Baggage::with('deliveryStatus')
            ->where('delivery_status_id', 5)
            ->count();
        $instock = Baggage::with('deliveryStatus')
            ->where('delivery_status_id', 3)
            ->count();
        $itemdetail = Baggage::with('deliveryStatus')
            ->where('delivery_status_id', 3)
            ->count();

        // Count deliverers with the same branch as the supervisor
        $deliverer = Role::where('name', 'deliverer')->count();
        $histories = Baggage::where('delivery_status_id', 5)->get();
        return view('supervisor.history', ['histories' => $histories,'delivery'=>$delivery, 'instock'=>$instock, 'itemdetail'=>$itemdetail, 'deliverer'=>$deliverer]);
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
