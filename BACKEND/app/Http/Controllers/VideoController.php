<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;
use App\Http\Requests\Video\CreateRequest;
use App\Http\Requests\Video\UpdateRequest;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // constructor
    public function __construct()
    {
        // add the middleware to the controller
        $this->middleware('owns.video')->only(['destroy', 'update']);
    }
    public function index()
    {
        // check if the request has tags
        return Video::with('tags')
        ->paginate(10, pageName: 'p');
    }
    public function tags()
    {
        return Tag::all();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        // create the video
        $video = Video::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'url' => $request->url,
            'thumbnail_url' => $request->thumbnail_url,
        ]);
        // attach the tags
        $video->attachTags($request->tags);
        // return created response code
        return response()->json([
            'message' => 'Video created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return $video->load('comments');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Video $video)
    {

        // update the video
        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'url' => $request->url,
            'thumbnail_url' => $request->thumbnail_url,
        ]);
        // attach the tags if updated
        if ($request->tags) {
            $video->syncTags($request->tags);
        }
        // return updated response
        return response()->json([
            'message' => 'Video updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        // soft delete the video
        $video->delete();
    }
}
