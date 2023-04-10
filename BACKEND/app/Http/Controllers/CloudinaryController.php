<?php

namespace App\Http\Controllers;

use Cloudinary\Api\ApiUtils;
use Illuminate\Http\Request;

class CloudinaryController extends Controller
{
    // get signature
    public function getSignature(Request $request)
    {
        $timestamp = time();
        $params = [
            'timestamp' => $timestamp,
            'folder' => 'Youwatch',
        ];
        $signature = ApiUtils::signParameters($params, env('CLOUDINARY_API_SECRET'));
        return response()->json([
            'signature' => $signature,
            'timestamp' => $timestamp
        ]);
    }
}
