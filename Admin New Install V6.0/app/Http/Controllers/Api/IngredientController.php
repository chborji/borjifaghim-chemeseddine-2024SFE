<?php

namespace App\Http\Controllers\Api;

use App\Model\Product;
use App\model\Ingredient;
use App\Model\Translation;
use Illuminate\Http\Request;
//use App\Model\Ingredient;
//use App\Model\Review;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\CentralLogics\IngredientLogic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{

    public function get_all_ingredients()
    {
        try {
            $ingredients = Ingredient::get();
            return response()->json($ingredients, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    /* public function get_searched_products(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $products = ProductLogic::search_products($request['name'], $request['limit'], $request['offset']);
        if (count($products['products']) == 0) {
            $key = explode(' ', $request['name']);
            $ids = Translation::where(['key' => 'name'])->where(function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->orWhere('value', 'like', "%{$value}%");
                }
            })->pluck('translationable_id')->toArray();
            $paginator = Product::active()->whereIn('id', $ids)->withCount(['wishlist'])->paginate($request['limit'], ['*'], 'page', $request['offset']);
            $products = [
                'total_size' => $paginator->total(),
                'limit' => $request['limit'],
                'offset' => $request['offset'],
                'products' => $paginator->items()
            ];
        }
        $products['products'] = Helpers::product_data_formatting($products['products'], true);
        return response()->json($products, 200);
    }*/
    public function get_ingredient($id)
    {
        try {
            $ingredient = Ingredient::where($id);
            //$product = Helpers::product_data_formatting($product, false);
            return response()->json($ingredient, 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => ['code' => 'ingredient-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }
    }

    public function get_product($id)
    {
        try {

            $product = Product::find($id);
            //$product = Helpers::product_data_formatting($product, false);
            return response()->json($product, 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => ['code' => 'product-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }
    }
}
/*public function get_all_ingredients()
{
    try {
        $ingredients = Ingredient::get();
        return response()->json($ingredients, 200);
    } catch (\Exception $e) {
        return response()->json([], 200);
    }
}*/