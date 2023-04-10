<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Video $video)
    {
        // validate request
        $request->validate([
            'body' => 'required|string'
        ]);
        // store comment
        $video->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);
        // return created response code
        return response()->json([
            'message' => 'Comment created successfully'
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        // validate request
        $request->validate([
            'body' => 'required|string'
        ]);
        // update comment
        $comment->update([
            'body' => $request->body
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        // delete comment
        $comment->delete();
    }
}
