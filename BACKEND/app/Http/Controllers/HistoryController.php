<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {

        return auth()->user()->history()->orderByPivot('created_at','desc')->paginate(10, pageName: 'p');
    }
}
