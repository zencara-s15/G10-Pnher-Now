<?php

namespace App\Http\Controllers\API\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetFeedbackResource;
use App\Models\Feedback;
use Illuminate\Http\Request;

class GetFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getFeedbacks = Feedback::orderBy('id','desc')->get();

        $getFeedbacks = GetFeedbackResource::collection($getFeedbacks);
        return response()->json([
            'success' => 'Feedbacks retrieved successfully!',
            'getFeedbacks' => $getFeedbacks
        ], 200);

        dd(10);
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
