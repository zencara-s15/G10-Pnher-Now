<?php

namespace App\Http\Controllers\API\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Baggage;
use App\Models\User;
use App\Http\Resources\BaggageResource;


class BaggageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function BaggageList()
    {
        // Retrieve all baggage with deliveryStatus and user relationships loaded
        // $baggage = Baggage::with(['deliveryStatus:id,name', 'user:id,name'])->get();

        // Return a JSON response
        // return response()->json([
        //     'success' => 'Baggage retrieved successfully!',
        //     'baggage' => $baggage
        // ], 200);
        return BaggageResource::collection(Baggage::all());
        // return Baggage::all();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function BaggagePost(Request $request)
    {
        // Define validation rules
        $userId = $request->user()->id;
        // Default delivery status is "Pending"
        $deliveryStatus = 1; 
        $rules = [
            'type' => 'required|string|max:255',
            'weight' => 'required|integer',
            'receiver_phone' => 'required|string|max:255',
            'sending_address' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'receiving_address' => 'required|string|max:255',
        ];

        // Adjust validation rules for optional fields
        if ($request->has('post_id')) {
            $rules['post_id'] = 'nullable|exists:posts,id';
        }

        if ($request->has('delivery_status_id')) {
            $rules['delivery_status_id'] = 'nullable|exists:delivery_status,id';
        }

        // Validate the incoming request data
        $request->validate($rules);

        // Prepare the data for insertion
        $data = $request->all();

        // Create the baggage entry
        $baggage = Baggage::create($data);
        $baggage->post_id = $userId;
        $baggage->delivery_status_id = $deliveryStatus;

        $baggage->save();
        // Return a JSON response
        return response()->json(['success' => 'Baggage post created successfully!', 'baggage' => $baggage], 201);
    }

    /**
     * Display the specified resource.
     */
    public function GetBaggageById(string $id)
    {
        // Retrieve baggage with delivery status relationship loaded by ID
        $baggage = Baggage::with('deliveryStatus:id,name')->find($id);

        // Return a JSON response
        return response()->json(['success' => 'Baggage retrieved successfully!', 'baggage' => $baggage], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function BaggageUpdateById(Request $request, string $id)
    {
        // Define validation rules
        $rules = [
            'delivery_status_id' => 'nullable|exists:delivery_status,id',
        ];
        // Validate the incoming request data
        $request->validate($rules);
        // Prepare the data for update
        $data = $request->all();
        // Find the baggage by ID and update it
        $baggage = Baggage::find($id);
        $baggage->update(['delivery_status_id' => $request->delivery_status_id]);
        // Return a JSON response
        return response()->json(['success' => 'Baggage updated successfully!', 'baggage' => $baggage], 200);
        // return response()->json(['success' => 'Baggage updated successfully!', 'baggage' => $baggage], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteBaggage(string $id)
    {
        // Find and delete the baggage by ID
        $baggage = Baggage::destroy($id);
        return response()->json(['success' => $baggage, 'message' => 'Baggage deleted successfully'], 200);
    }
}
