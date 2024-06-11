<?php

namespace App\Http\Controllers\Admin;

use App\Model\ProductCompose;
use App\Model\IngCategory;
use App\Model\Translation;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ProductComposeController extends Controller
{
    public function index()
    {
        $ingcategories = IngCategory::where(['parent_id' => 0])->get();

        return view('admin-views.product-compose.index', compact('ingcategories'));

        //return view('admin-views.product-compose.index', compact('ingcategories'));
    }

    public function ajouter(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required!',
        ]);


        if (!empty($request->file('file'))) {
            $image_name =  Helpers::upload('productcompose/', 'png', $request->file('file'));
        } else {
            $image_name = 'def.png';
        };

        //   $path = $request->file('image')->store('storage/productcompose');


        $prodcomposes = new ProductCompose();
        $prodcomposes->name = $request->name;
        $prodcomposes->price = $request->price;
        // $category->requis = 0;
        $prodcomposes->image = $image_name;
        $prodcomposes->ingredients = $request->ingredients;

        $prodcomposes->save();


        return response()->json([], 200);
        //return back();
    }
    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $prodcomposes = ProductCompose::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $prodcomposes = new ProductCompose();
        }

        $prodcomposes = $prodcomposes->orderBy('name')->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.product-compose.list', compact('prodcomposes', 'search'));
        // return back();
    }

    public function edit($id)
    {
        $prodcompose = ProductCompose::withoutGlobalScopes()->with('translations')->find($id);

        $ingcategories = IngCategory::where(['parent_id' => 0])->get();

        return view('admin-views.product-compose.edit', compact('prodcompose', 'ingcategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required!',
        ]);



        $prodcompose = ProductCompose::find($id);
        $prodcompose->name = $request->name;
        $prodcompose->price = $request->price;

        $prodcompose->image = $request->has('image') ? Helpers::update('productcompose/', $prodcompose->image, 'png', $request->file('image')) : $prodcompose->image;
        $prodcompose->ingredients = $request->ingredients;

        $prodcompose->save();

        return response()->json([], 200);
    }

    public function delete(Request $request)
    {
        $prodcompose = ProductCompose::find($request->id);
        Helpers::delete('productcompose/' . $prodcompose['image']);
        $prodcompose->delete();
        Toastr::success('product removed!');
        return back();
    }
}
