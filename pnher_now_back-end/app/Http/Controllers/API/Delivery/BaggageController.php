<?php

namespace App\Http\Controllers\API\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Baggage;

class BaggageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function BaggageList()
    {
        // Retrieve all baggage
        $baggage = Baggage::all();

        // Return a JSON response
        return response()->json(['success' => 'Baggage retrieved successfully!', 'baggage' => $baggage], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function BaggagePost(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'type' => 'required|string|max:255',
            'weight' => 'required|integer',
            'receiver_phone' => 'required|string|max:255',
            'sending_address' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'receiving_address' => 'required|string|max:255',
            'status' => 'required|boolean',
            'post_id' => 'required|exists:posts,id'
        ]);

        // Prepare the data for insertion
        $data = $request->all();

        // Create the baggage entry
        $baggage = Baggage::create($data);

        // Return a JSON response
        return response()->json(['success' => 'Baggage post created successfully!', 'baggage' => $baggage], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
