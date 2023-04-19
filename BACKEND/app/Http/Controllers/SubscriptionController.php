<?php

namespace App\Http\Controllers;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return auth()->user()->subscriptionsVideos()->paginate(10, pageName: 'p');
    }

}
