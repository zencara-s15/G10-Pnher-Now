<?php

namespace App\Http\Controllers\API\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Baggage;
use App\Models\Post;
use App\Models\Delivery_baggage;
use Illuminate\Support\Facades\Response;

class DeliveryBaggageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetPost()
    {
        // Retrieve all delivery baggage with their associated posts and users
        $deliveryBaggage = Delivery_Baggage::with('post.user')->get();

        // Extract relevant data
        $deliveryBaggageWithUserData = $deliveryBaggage->map(function ($item) {
            return [
                'id' => $item->id,
                'post_id' => $item->post ? $item->post->id : null,
                'post_title' => $item->post ? $item->post->title : null,
                'user_name' => $item->post && $item->post->user ? $item->post->user->name : null,
                'user_email' => $item->post && $item->post->user ? $item->post->user->email : null,
                'baggage' => $item->post && $item->post->baggage()->pluck('baggage')->toArray(),
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
        $deliveryBaggage = Delivery_Baggage::create($data);

        // Return a JSON response
        return response()->json(['success' => 'Delivery baggage created successfully!', 'delivery_baggage' => $deliveryBaggage], 201);
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
