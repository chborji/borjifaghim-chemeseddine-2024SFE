<?php

namespace App\Http\Controllers\Admin;

use App\model\Ingredient;

use App\Model\IngCategory;
use App\Model\Translation;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $ingredients = Ingredient::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $ingredients = new Ingredient();
        }
        $ingcategories = IngCategory::get();

        $ingredients = $ingredients->orderBy('name')->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.ingredient.index', compact('ingredients', 'search', 'ingcategories'));
    }

   /*  public function get_categories(Request $request)
    {  


        $cat = Ingredient::where(['category_ids' => '[{"id":"' . json_decode($request->parent_id) . '"}]'])->get();
        //   $res = '<option value="select" disabled selected>---Select---</option>';  
        $res = 0;
        foreach ($cat as $row) {

            $res .= '<option value="' . $row->name . '">' . $row->name . '</option>';
        }

        return response()->json([
            'options' => $res,
        ]);
    }
 */

 public function get_categories(Request $request)
 {
     $selectedCategoryIds = json_decode($request->parent_id, true);

     $ingredientsQuery = Ingredient::query();

     foreach ($selectedCategoryIds as $categoryId) {
         $ingredientsQuery->orWhereJsonContains('category_ids', [['id' => $categoryId]]);
     }

     $ingredients = $ingredientsQuery->get();

     // Generate options for the ingredients dropdown
     $options = '';
     foreach ($ingredients as $ingredient) {
         $options .= '<option value="' . $ingredient->id . '">' . $ingredient->name . '</option>';
     }

     // Return JSON response with options for ingredients dropdown
     return response()->json(['options' => $options]);
 }


 

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ], [
            'name.required' => 'Name is required!',
            'category_id.required' => 'Category is required!',

        ]);
        if (!empty($request->file('image'))) {
            $image_name =  Helpers::upload('ingredient/', 'png', $request->file('image'));
        } else {
            $image_name = 'def.png';
        };

        $ingredient = new Ingredient();
        $ingredient->name = $request->name;
        //[array_search('en', $request->lang)];
        $ingcategory = [];
        if ($request->category_id != null) {
            array_push($ingcategory, [
                'id' => $request->category_id,
            ]);
        }
        $ingredient->category_ids = json_encode($ingcategory);
        $ingredient->quantity = $request->quantity;
        $ingredient->description = $request->description;
        // $ingredient->name = $request->name;
        $ingredient->priceSupp = $request->priceSupp;
        $ingredient->image = $image_name;
        $ingredient->save();
        $data = [];
        /* foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en' ) {
                array_push($data, array(
                    'translationable_type'  => 'App\Model\Ingredient',
                    'translationable_id'    => $ingredient->id,
                    'locale'                => $key,
                    'key'                   => 'name',
                    'value'                 => $request->name[$index],
                ));
            }
        } */
        if (count($data)) {
            Translation::insert($data);
        }
        Toastr::success("L'ingrédient a été ajouté avec succès ");

        // $ingredients = $query->paginate(Helpers::getPagination())->appends($query_param);
        // return view('admin-views.ingredient.list', compact('ingredients'));

        return back();
    }
    public function edit($id)
    {
        $ingredient = Ingredient::withoutGlobalScopes()->with('translations')->find($id);
        $ingredient_category = json_decode($ingredient->category_ids);
        $ingcategories = IngCategory::where(['parent_id' => 0])->get();

        return view('admin-views.ingredient.edit', compact('ingredient', 'ingredient_category', 'ingcategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',


        ], [
            'name.required' => 'Name is required!',
        ]);

        $ingredient = Ingredient::find($id);
        $ingredient->name = $request->name;
        $ingcategory = [];
        if ($request->category_id != null) {
            array_push($ingcategory, [
                'id' => $request->category_id,
            ]);
        }
        $ingredient->category_ids = json_encode($ingcategory);

        $ingredient->priceSupp = $request->priceSupp;
        $ingredient->quantity = $request->quantity;
        $ingredient->description = $request->description;
        $ingredient->image = $request->has('image') ? Helpers::update('ingredient/', $ingredient->image, 'png', $request->file('image')) : $ingredient->image;

        $ingredient->save();

      /*   foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    [
                        'translationable_type'  => 'App\Model\ingredient',
                        'translationable_id'    => $ingredient->id,
                        'locale'                => $key,
                        'key'                   => 'name'
                    ],
                    ['value'                 => $request->name[$index]]
                );
            }
        } */
        Toastr::success("L'ingrédient a été mis à jour avec succès");

        //  return view('admin-views.ingredient.list', compact('ingredient'));

        return back();
    }
    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $ingredients = Ingredient::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $ingredients = new Ingredient();
        }

        $ingredients = $ingredients->orderBy('name')->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.ingredient.list', compact('ingredients', 'search'));
    }

    public function delete(Request $request)
    {
        $ingredient = Ingredient::find($request->id);
        Helpers::delete('ingredient/' . $ingredient['image']);
        $ingredient->delete();
        Toastr::success('Ingrédient supprimé');
        return back();
    }
}
