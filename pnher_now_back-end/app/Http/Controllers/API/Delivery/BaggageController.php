<?php

namespace App\Http\Controllers\API\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Baggage;
use App\Models\User;
use App\Http\Resources\BaggageResource;
use App\Models\DeliveryBaggage;

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
        try {
            // Define validation rules
            $userId = $request->user()->id;
            // Default delivery status is "Pending"
            $deliveryStatus = 1;
            $rules = [
                'type' => 'required|string|max:255',
                'weight' => 'required|integer',
                'receiver_phone' => 'required|string|max:255',
                'sending_address'=> 'required|string|max:255',
                'company' => 'required|string|max:255',
                'receiving_address' => 'required|string|max:255',
                'longitude' => 'nullable|numeric|between:-180,180',
                'latitude' => 'nullable|numeric|between:-90,90',
            ];

            // Adjust validation rules for optional fields
            if ($request->has('post_id')) {
                $rules['post_id'] = 'nullable|exists:posts,id';
            }

            if ($request->has('delivery_status_id')) {
                $rules['delivery_status_id'] = 'nullable|exists:delivery_status,id';
            }

            // Validate the incoming request data
            $validatedData = $request->validate($rules);

            // Prepare the data for insertion
            $data = $validatedData;
            $data['post_id'] = $userId;
            $data['delivery_status_id'] = $deliveryStatus;

            // Create the baggage entry
            $baggage = Baggage::create($data);

            // Return a JSON response
            return response()->json(['success' => 'Baggage post created successfully!', 'baggage' => $baggage], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            return response()->json(['error' => 'Validation failed', 'messages' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Return other errors
            return response()->json(['error' => 'Failed to create baggage post', 'message' => $e->getMessage()], 500);
        }
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

    // Find the baggage by ID and update it
    $baggage = Baggage::find($id);
    // dd($baggage->id);

    // Update the delivery_status_id
    $isUpdated = $baggage->update(['delivery_status_id' => $request->delivery_status_id]);
    // Check if delivery_status_id is 2
    if ($isUpdated) {
        // Get the authenticated user's ID (assuming the deliverer is the authenticated user)
        $delivererId = auth()->user()->id;

        // Create a new record in the delivery_baggage table
        $test = DeliveryBaggage::create([
            'baggage_id' => $baggage->id,
            'deliverer_id' => $delivererId,
        ]);
        // dd($test);
    }

    // Return a JSON response
    return response()->json(['success' => 'Baggage updated successfully!', 'baggage' => $baggage], 200);
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
