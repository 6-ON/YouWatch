<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class BannedVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Video::withoutGlobalScope('notBanned')->banned()->paginate(10,pageName:'p');
    }

}
