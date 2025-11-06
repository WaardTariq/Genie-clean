<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Booking;
use App\Models\Cleaner;
use App\Models\Job;
use App\Models\PromoCode;
use App\Models\PromoCodeUsages;
use App\Models\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function getServices()
    {
        try {
            $services = service::where('status', 1)->get();

            return response()->json(['status' => true, 'message' => 'Services Fetched Successfully', 'data' => $services], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'messaege' => 'Something Went Wrong' . $e->getMessage()], 500);
        }
    }

    public function getServiceDetail(Request $request)
    {
        try {
            $serviceId = $request->query('service_id');
            $service = service::where('id', $serviceId)->where('status', 1)->first();
            return response()->json(['status' => true, 'message' => 'Service Detail Fetched Successfully', 'data' => $service], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong' . $e->getMessage()], 500);
        }
    }

    



}
