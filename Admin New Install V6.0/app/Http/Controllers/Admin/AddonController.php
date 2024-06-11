<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\AddOn;
use App\Model\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $addons = AddOn::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $addons = new AddOn();
        }

        $addons = $addons->orderBy('name')->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.addon.index', compact('addons', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required!',
        ]);
        if (!empty($request->file('image'))) {
            $image_name =  Helpers::upload('addon/', 'png', $request->file('image'));
        } else {
            $image_name = 'def.png';
        };

        $addon = new AddOn();
        $addon->name = $request->name;
        $addon->price = $request->price;
        // $addon->quantity = $request->quantity;
        //$addon->description = $request->description;
        // dd($request->all());

        $addon->image = $image_name;
        $addon->save();

        $data = [];
        /*  foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type'  => 'App\Model\AddOn',
                    'translationable_id'    => $addon->id,
                    'locale'                => $key,
                    'key'                   => 'name',
                    'value'                 => $request->name[$index],
                ));
            }
        } */
        if (count($data)) {
            Translation::insert($data);
        }

        Toastr::success('Addon ajouté avec succès !');
        return back();
    }

    public function edit($id)
    {
        $addon = AddOn::withoutGlobalScopes()->with('translations')->find($id);
        return view('admin-views.addon.edit', compact('addon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ], [
            'name.required' => 'Name is required!',
        ]);

        $addon = AddOn::find($id);
        $addon->name = $request->name;
        $addon->price = $request->price;
        //  $addon->quantity = $request->quantity;
        //  $addon->description = $request->description;
        $addon->image = $request->has('image') ? Helpers::update('addon/', $addon->image, 'png', $request->file('image')) : $addon->image;

        $addon->save();

        /*   foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    [
                        'translationable_type'  => 'App\Model\AddOn',
                        'translationable_id'    => $addon->id,
                        'locale'                => $key,
                        'key'                   => 'name'
                    ],
                    ['value'                 => $request->name[$index]]
                );
            }
        } */
        Toastr::success("L'addon a été mis à jour avec succès");
        return back();
    }

    public function delete(Request $request)
    {
        $addon = AddOn::find($request->id);
        $addon->delete();
        Toastr::success('Addon supprimé');
        return back();
    }
}
