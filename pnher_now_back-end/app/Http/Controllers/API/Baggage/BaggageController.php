<?php

namespace App\Http\Controllers\API\Baggage;

use App\Http\Controllers\Controller;
use App\Models\Baggage;
use App\Models\User;
use Illuminate\Http\Request;

class BaggageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listBaggages()
    {
        //
        $baggage = Baggage::all();
        return response()->json(
            [
               'success'=>true,
                'data'=>$baggage,
               'message'=>'baggage list retrieved successfully'
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createBaggage(Request $request)
    {
        $baggage = Baggage::store($request);
        return response()->json(
            [
                'success'=>true,
                'data'=>$baggage,
                'message'=>'created successfully'
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function showBaggage(string $id)
    {
        $baggage = Baggage::find($id);
        return response([
            'success'=>true,
            'data'=>$baggage,
            'message'=>'baggage retrieved successfully'
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function editBaggage(Request $request, string $id)
    {
        //
        Baggage::store($request,$id);
        return [
            'success' => true,
            'message' => "Baggage updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteBaggage(string $id)
    {
        $baggage = Baggage::find($id);
        $baggage->delete();
        return [
           'success' => true,
           'message' => "Baggage deleted successfully"
        ];
    }
}
