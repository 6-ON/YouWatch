<?php

namespace App\Http\Controllers;

use App\Http\Requests\Video\LikeRequest;
use App\Models\Like;
use App\Models\Video;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(LikeRequest $request, Video $video)
    {;

        // store like
        $video->reactions()->create([
            'user_id' => auth()->id(),
            'isLiked' => $request->like
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        // validate request
        $request->validate([
            'like' => 'required|boolean'
        ]);
        // update like
        $video->reactions()->where('user_id', auth()->id())->update([
            'isLiked' => $request->like
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        // delete like
        $video->reactions()->where('user_id', auth()->id())->delete();
    }
}
