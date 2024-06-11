<?php

namespace App\Http\Controllers\Api;

use App\Model\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Model\BusinessSetting;
use App\Mail\EmailVerification;
use App\Model\EmailVerifications;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BranchAuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ];

        if (auth('branch')->attempt($data)) {
            $token = Str::random(120);
            //$branch = Auth::user();

            Branch::where(['email' => $request['email']])->update([
                'auth_token' => $token
            ]);
            return response()->json([
                'success' => true,
                'token' => $token,
                //'id' => auth()->guard('branch')->id,
            ]);
        } else {
            $errors = [];
            array_push($errors, ['code' => 'auth-001', 'message' => trans('branch.login_failed')]);
            return response()->json([
                'errors' => $errors,
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        if (auth()->guard('branch')) {

            auth()->guard('branch')->logout();
            return response()->json([
                'success' => true,
                'message' => 'Logout successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to Logout'
            ]);
        }
    }
}
