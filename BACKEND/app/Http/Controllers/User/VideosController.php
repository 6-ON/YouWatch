<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VideosController extends Controller
{


    public function index(User $user)
    {
        $user->loadCount('subscribers');
        $user->append('is_subscribed_to');
        return response()->json([
            'user' => $user,
            'videos' => $user->videos()->without('user')->paginate(10, pageName: 'p')
        ]);
    }

}
