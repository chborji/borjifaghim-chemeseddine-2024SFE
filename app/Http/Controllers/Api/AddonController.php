<?php

namespace App\Http\Controllers\Api;

use App\model\AddOn;
use App\Model\Translation;
use Illuminate\Http\Request;
//use App\Model\Ingredient;
//use App\Model\Review;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\CentralLogics\AddonLogic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
//use Razorpay\Api\Addon;

class AddonController extends Controller
{

    public function get_all_addons()
    {
        try {
            $addons = Addon::get();
            return response()->json($addons, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_addon($id)
    {
        try {
            $addon = Addon::find($id);
            //$product = Helpers::product_data_formatting($product, false);
            return response()->json($addon, 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => ['code' => 'addon-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }
    }
}
