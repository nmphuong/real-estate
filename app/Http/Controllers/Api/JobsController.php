<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Job;

class JobsController extends Controller
{
    public function getAllJob()
    {
        $data = Job::where('status', 1)->orderBy('created_at', 'DESC')->get();
        return response()->json([

            'status' => true,

            'code' => 200,

            'message' => trans('message.success'),

            'data' => $data

      ], 200);
    }
}
