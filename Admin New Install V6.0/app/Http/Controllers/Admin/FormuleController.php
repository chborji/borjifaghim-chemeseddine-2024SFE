<?php

namespace App\Http\Controllers\Admin;

use App\Model\Formule;
use App\Model\Category;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class FormuleController extends Controller
{
    public function index1()
    {
        $categories = Category::where(['position' => 0])->get();
        return view('admin-views.formule.index', compact('categories'));
    }
    /**
     * Store a new flight in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)

    {
        if (!empty($request->file('file'))) {
            $image_name =  Helpers::upload('formule/', 'png', $request->file('file'));
        } else {
            $image_name = 'def.png';
        };

        $formule = new Formule;

        $formule->name = $request->name;
        $formule->price = $request->price;
        $formule->image = $image_name;

        //$formule->requis = $request->requis;
        $formule->products = $request->products;




        $formule->save();

        return back();
    }
    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $formules = Formule::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $formules = new Formule();
        }

        $formules = $formules->orderBy('name')->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.formule.list', compact('formules', 'search'));
        // return back();
    }

    public function edit($id)
    {
        $formule = Formule::find($id);

        $categories = Category::where(['parent_id' => 0])->get();

        return view('admin-views.formule.edit', compact('formule', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required!',
        ]);




        $formule = Formule::find($id);
        $formule->name = $request->name;
        $formule->price = $request->price;
        // $category->requis = 0;
        $formule->image = $request->has('image') ? Helpers::update('formule/', $formule->image, 'png', $request->file('image')) : $formule->image;
        $formule->products = $request->products;

        $formule->save();

        return response()->json([], 200);
    }

    public function delete(Request $request)
    {
        $formule = Formule::find($request->id);
        Helpers::delete('formule/' . $formule['image']);
        $formule->delete();
        Toastr::success('product removed!');
        return back();
    }
}
