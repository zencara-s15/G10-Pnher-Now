<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Baggage;
use Illuminate\Http\Request;

class ItemDetailController extends Controller
{
    public function index()
    {
        // $baggageInStockes = Baggage::all();
        $baggageInStockes = Baggage::where('delivery_status_id', 3)->get();
        // $baggageInStockes = BaggageInStockesResource::collection($baggageInStockes);
        return view('supervisor.item_detail',['baggageInStockes' => $baggageInStockes]);
    }

   
}
