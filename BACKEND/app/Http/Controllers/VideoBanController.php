<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoBanController extends Controller
{


    public function store(Request $request,Video $video): void
    {
        $video->ban();
    }


    /**
     * Remove the resource from storage.
     */
    public function destroy($video): void
    {
        Video::withoutGlobalScope('notBanned')->findOrFail($video)->unban();
    }
}
