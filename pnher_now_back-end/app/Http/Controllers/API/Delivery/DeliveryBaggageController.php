<?php

namespace App\Http\Controllers\API\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Baggage;
use App\Models\Post;
use App\Models\DeliveryBaggage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class DeliveryBaggageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetPost()
    {
        // Retrieve all delivery baggage with their associated posts and users
        $deliveryBaggage = DeliveryBaggage::with('post.user', 'post.baggage')->get();

        // Extract relevant data
        $deliveryBaggageWithUserData = $deliveryBaggage->map(function ($item) {
            return [
                'id' => $item->id,
                'post_id' => optional($item->post)->id,
                'post_title' => optional($item->post)->title,
                'user_name' => optional(optional($item->post)->user)->name,
                'user_email' => optional(optional($item->post)->user)->email,
                'baggage' => $item->post->baggage->map(function ($baggage) {
                    return [
                        'baggage_id' => $baggage->id,
                        'type' => $baggage->type,
                        'weight' => $baggage->weight,
                        'receiver_phone' => $baggage->receiver_phone,
                        'sending_address' => $baggage->sending_address,
                        'company' => $baggage->company,
                        'receiving_address' => $baggage->receiving_address,
                        'status' => $baggage->status,
                    ];
                })->toArray(),
                'status' => $item->status,
            ];
        });

        // Return JSON response
        return Response::json(['data' => $deliveryBaggageWithUserData]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function PostDelivery(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'deliverer_id' => 'required|exists:users,id',
            'status' => 'required|boolean',
        ]);

        // Prepare the data for insertion
        $data = $request->all();

        // Create the delivery baggage entry
        $deliveryBaggage = DeliveryBaggage::create($data);

        // Return a JSON response
        return response()->json(['success' => 'Delivery baggage created successfully!', 'delivery_baggage' => $deliveryBaggage], 201);
    }

    /**
     * Display the specified resource.
     */
    public function GetDelivery(string $id)
    {
        // Retrieve delivery baggage with their associated posts, users, and baggage by ID
        $deliveryBaggage = DeliveryBaggage::with('post.user', 'post.baggage')
            ->where('id', $id)
            ->get();

        // Check if delivery baggage with the specified ID exists
        if ($deliveryBaggage->isEmpty()) {
            return Response::json(['error' => 'Delivery baggage not found.'], 404);
        }

        // Extract relevant data
        $deliveryBaggageWithUserData = $deliveryBaggage->map(function ($item) {
            return [
                'id' => $item->id,
                'post_id' => optional($item->post)->id,
                'post_title' => optional($item->post)->title,
                'user_name' => optional(optional($item->post)->user)->name,
                'user_email' => optional(optional($item->post)->user)->email,
                'baggage' => $item->post->baggage->map(function ($baggage) {
                    return [
                        'baggage_id' => $baggage->id,
                        'type' => $baggage->type,
                        'weight' => $baggage->weight,
                        'receiver_phone' => $baggage->receiver_phone,
                        'sending_address' => $baggage->sending_address,
                        'company' => $baggage->company,
                        'receiving_address' => $baggage->receiving_address,
                        'status' => $baggage->status,
                    ];
                })->toArray(),
                'status' => $item->status,
            ];
        });

        // Return JSON response
        return Response::json(['data' => $deliveryBaggageWithUserData]);
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
    public function DeliveryPickUp()
    {
        // Get the currently authenticated user
        $user = Auth::user();
        
        // Check if the user is authenticated
        if (!$user) {
            return Response::json(['error' => 'User not authenticated.'], 401);
        }

        // Retrieve delivery baggage assigned to the logged-in user
        $deliveryBaggage = DeliveryBaggage::with('baggage')
            ->where('deliverer_id', $user->id)
            ->get();

        // Check if there are any delivery baggage items
        if ($deliveryBaggage->isEmpty()) {
            return Response::json(['message' => 'No delivery baggage found for the current user.'], 404);
        }

        // Extract relevant data
        $deliveryBaggageWithData = $deliveryBaggage->map(function ($item) {
            return [
                'id' => $item->id,
                'baggage_id' => $item->baggage_id,
                'baggage' => [
                    'type' => $item->baggage->type,
                    'weight' => $item->baggage->weight,
                    'receiver_phone' => $item->baggage->receiver_phone,
                    'sending_address' => $item->baggage->sending_address,
                    'company' => $item->baggage->company,
                    'receiving_address' => $item->baggage->receiving_address,
                    'status' => $item->baggage->status,
                ],
                'status' => $item->status,
            ];
        });

        // Return JSON response
        return Response::json(['data' => $deliveryBaggageWithData]);
    }
}
