<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Baggage;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // dd(1);
        // Retrieve all posts
        $user_id = $request->user()->id;
        $postBaggage = Post::where('user_id', $user_id)->get();
        // Return posts as a JSON response
        $posts = Post::with('baggage')->where('user_id', $user_id)->get();
        if ($postBaggage->isEmpty()) {
            return response()->json([
                'error' => 'No baggage found for this post.',
            ],404);
        }
        $postBaggages = $postBaggage->map(function ($posts){
            return [
                'id' => $posts->id,
                'title' => $posts->title,
                'description' => $posts->description,
                'publish' => $posts->publish,
                'baggage_id' => $posts->baggage_id,
                'baggages' => $posts->baggage->map(function ($baggages){
                    return [
                        'baggage_id' => $baggages->id,
                        'type'=>$baggages->type,
                        'weight'=>$baggages->weight,
                        'receiver_phone'=> $baggages->receiver_phone,
                        'sending_address' => $baggages->sending_address,
                        'receiver_address' => $baggages->receiver_address
                    ];
                })->toArray()
            ];
        });
        return response()->json([
            'posts' => $postBaggages
        ],200);
    }
    public function createPost(Request $request)
    {
        $validateData = $request->validate(
            [
                'title' =>'required|string|max: 255',
                'description' =>'required|string|max: 255',
                'publish'=> 'boolean',
                'baggage_id' =>'nullable|array',
            ]
            );
            $post = Post::store($request);
            return response()->json([
                    'success' => true,
                    'data' => $post,
                    'message' =>'post create successfully'
            ],200);
    }

    public function editPost(Request $request, $id){
        $user_id = $request->user()->id;
        $posts = Post::where('user_id', $user_id)->get();
        $posts = Post::store($request,$id);
        return response()->json([
                   'success' => true,
                   'message' => 'post updated successfully'
            ],200);
    }
    

    public function showPost($id) {
        $post = Post::with('baggage')->find($id);
        return response()->json([
                   'success' => true,
                    'data' => $post
            ],200);
    }

    public function deletePost(string $id) {
        $post = Post::find($id);
        $post->delete();
        return response()->json([
                   'success' => true,
                   'message' => 'post deleted successfully'
            ],200);
    }
}
