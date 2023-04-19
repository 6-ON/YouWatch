<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user)
    {
        //subscribe to user
        auth()->user()->subscriptions()->attach($user);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //unsubscribe from user
        auth()->user()->subscriptions()->detach($user);
    }
}
