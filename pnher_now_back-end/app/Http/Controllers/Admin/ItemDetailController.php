<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Baggage;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ItemDetailController extends Controller
{
    public function index()
    {
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
        // $baggageInStockes = Baggage::all();
        $baggageInStockes = Baggage::where('delivery_status_id', 3)->get();
        // $baggageInStockes = BaggageInStockesResource::collection($baggageInStockes);
        return view('supervisor.item_detail', ['baggageInStockes' => $baggageInStockes, 'delivery' => $delivery, 'instock' => $instock, 'itemdetail' => $itemdetail, 'deliverer' => $deliverer]);
    }
}
