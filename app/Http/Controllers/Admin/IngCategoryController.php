<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Model\IngCategory;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Model\Translation;
use Brian2694\Toastr\Facades\Toastr;


class IngCategoryController extends Controller
{
    function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $ingcategories = IngCategory::Where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $ingcategories = new IngCategory;
        }


        $ingcategories = $ingcategories->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.ingcategory.index', compact('ingcategories', 'search'));
    }


    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required!',
        ]);

        if (!empty($request->file('image'))) {
            $image_name =  Helpers::upload('ingcategory/', 'png', $request->file('image'));
        } else {
            $image_name = 'def.png';
        }

        $ingcategory = new IngCategory();
        $ingcategory->name = $request->name;
       // [array_search('en', $request->lang)];
        $ingcategory->image = $image_name;
        //   $ingcategory->description = $request->description;
        $ingcategory->parent_id = $request->parent_id == null ? 0 : $request->parent_id;
        //   $ingcategory->position = $request->position;
        $ingcategory->save();

        $data = [];
        /* foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type'  => 'App\Model\IngCategory',
                    'translationable_id'    => $ingcategory->id,
                    'locale'                => $key,
                    'key'                   => 'name',
                    'value'                 => $request->name[$index],
                ));
            }
        } */
        if (count($data)) {
            Translation::insert($data);
        }

        return back();
    }

    public function edit($id)
    {
        $ingcategory = IngCategory::withoutGlobalScopes()->with('translations')->find($id);
        return view('admin-views.ingcategory.edit', compact('ingcategory'));
    }

    public function status(Request $request)
    {
        $ingcategory = IngCategory::find($request->id);
        $ingcategory->status = $request->status;
        $ingcategory->save();
        Toastr::success("Mise à jour du statut des catégories d'ingrédients");
        return back();
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required!',
        ]);
        $ingcategory = IngCategory::find($id);
        $ingcategory->name = $request->name;
        //   $ingcategory->description = $request->description;
        $ingcategory->image = $request->has('image') ? Helpers::update('ingcategory/', $ingcategory->image, 'png', $request->file('image')) : $ingcategory->image;
        $ingcategory->save();
       /*  foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    [
                        'translationable_type'  => 'App\Model\IngCategory',
                        'translationable_id'    => $ingcategory->id,
                        'locale'                => $key,
                        'key'                   => 'name'
                    ],
                    ['value'                 => $request->name[$index]]
                );
            } 
        }*/
        Toastr::success("La catégorie d'ingrédients a été mise à jour avec succès");
        return back();
    }

    public function delete(Request $request)
    {
        $ingcategory = IngCategory::find($request->id);
        Helpers::delete('ingcategory/' . $ingcategory['image']);
        $ingcategory->delete();
        Toastr::success('Catégorie supprimée');
        return back();
    }
}
