<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\ProductCompose;
use Illuminate\Http\Request;

class ProductComposeController extends Controller
{
    public function get_all_composes()
    {
        try {
            $productscomp = ProductCompose::orderBy('name')->get();
            return response()->json($productscomp, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_compose($id)
    {
        try {

            $productcomp = ProductCompose::find($id);
            return response()->json($productcomp, 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => ['code' => 'productscompose-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }
    }
}
