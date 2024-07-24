<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\DelivererAndUser;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function FeedbackList()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function FeedbackPost(Request $request)
    {
        $request->validate([
            // 'user_id' = auth()->user()->id,
            'title' => 'required',
            'comment' => 'required|string',
            'rates' => 'required',
        ]);

        // Retrieve the last deliverer_and_user_id
        $lastDelivererAndUser = DelivererAndUser::latest('id')->first();

        if ($lastDelivererAndUser) {
            // Merge the deliverer_and_user_id into the request data
            $feedbackData = $request->all();
            $feedbackData['user_id'] = auth()->id(); // Get the authenticated user's ID
            $feedbackData['delivererAndUser_id'] = $lastDelivererAndUser->id;

            // Create the Feedback record
            $feedback = Feedback::create($feedbackData);

            return response()->json(['message' => 'Feedback submitted successfully', 'data' => $feedback], 201);
        } else {
            return response()->json(['message' => 'No Deliverer and User record found'], 404);
        }

        // $feedback = Feedback::create($request->all());

        // return response()->json(['message' => 'Feedback submitted successfully', 'data' => $feedback], 201);

        // dd(10);
    }

    /**
     * Display the specified resource.
     */
    public function GetFeedbackById(string $id)
    {
        //
    }

    public function store(string $request)
    {
        // $request->validate([
        //     // 'user_id' = auth()->user()->id,
        //     'title' => 'required',
        //     'comment' => 'required|string',
        // ]);

        // $feedback = Feedback::create($request->all());

        // return response()->json(['message' => 'Feedback submitted successfully', 'data' => $feedback], 201);
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
