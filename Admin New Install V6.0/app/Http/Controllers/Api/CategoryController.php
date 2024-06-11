<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\CategoryLogic;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Order;
use Kreait\Firebase\Database\Query\Sorter\OrderByKey;

class CategoryController extends Controller
{
    public function get_categories()
    {
        try {
            $categories = Category::where(['status' => 1])->orderBy('name')->get();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_childes($id)
    {
        try {
            $categories = Category::where(['id' => $id, 'status' => 1])->get();
            return response()->json([$categories, 200]);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_products($id)
    {
        return response()->json(Helpers::product_data_formatting(CategoryLogic::products($id), true), 200);
        // return response()->json(CategoryLogic::products($id), 200);
    }

    public function get_all_products($id)
    {
        try {
            return response()->json(Helpers::product_data_formatting(CategoryLogic::all_products($id), true), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
}
