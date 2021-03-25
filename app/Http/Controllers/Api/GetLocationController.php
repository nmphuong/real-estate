<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Provinces;
use App\Wards;
use App\Districts;

class GetLocationController extends Controller
{

    public function getProvinces()
    {
        $provinces = Provinces::orderBy('created_at', 'DESC')->get();
        return  response()->json([

            'status' => true,

            'code' => 200,

            'message' => trans('message.success'),

            'data' => $provinces

      ], 200);
    }

    public function getDistricts($id)
    {
        $districts = Districts::where('province_id', $id)->orderBy('created_at', 'DESC')->get();
        return  response()->json([

            'status' => true,

            'code' => 200,

            'message' => trans('message.success'),

            'data' => $districts

      ], 200);
    }

    public function getWards($id)
    {
        $wards = Wards::where('district_id', $id)->orderBy('created_at', 'DESC')->get();
        return  response()->json([

            'status' => true,

            'code' => 200,

            'message' => trans('message.success'),

            'data' => $wards

      ], 200);
    }
}
