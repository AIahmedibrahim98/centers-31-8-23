<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /*  if ($request->header('api_token')) {
            $user = User::firstWhere('api_token', $request->header('api_token'));
            if ($user) {
                return response()->json([
                    'status' => 'user posts',
                    'posts' => $user->posts
                ]);
            } else {
                return response()->json([
                    'status' => 'user login Faild',
                    'message' => 'Token Does not Match'
                ], 401);
            }
        } else {
            return response()->json([
                'status' => 'user login Faild',
                'message' => 'Need To Login'
            ], 401);
        } */

        return response()->json([
            'status' => 'user posts',
            'posts' => auth()->user()->posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
