<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Model\Review;
use App\Model\Product;
use App\Model\Category;
use App\Model\IngCategory;
use App\Model\Translation;
use Illuminate\Http\Request;
use App\Model\ProductCompose;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Rap2hpoutre\FastExcel\FastExcel;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function variant_combination(Request $request)
{
    // Initialisation du tableau d'options et récupération des informations de base
    $options = [];
    $price = $request->price;
    $product_name = $request->name;

    // Vérification si la requête contient des choix
    if ($request->has('choice_no')) {
        foreach ($request->choice_no as $key => $no) {
            // Construction du nom de la clé pour les options de choix
            $name = 'choice_options_' . $no;
            
            // Concatenation des options en une seule chaîne
            $my_str = implode('', $request[$name]);
            
            // Transformation de la chaîne en un tableau d'options et ajout à la liste des options
            array_push($options, explode(',', $my_str));
        }
    }

    // Initialisation du tableau des résultats avec un tableau vide
    $result = [[]];

    // Génération des combinaisons de variantes
    foreach ($options as $property => $property_values) {
        $tmp = [];
        
        // Combinaison des valeurs des propriétés avec les résultats existants
        foreach ($result as $result_item) {
            foreach ($property_values as $property_value) {
                $tmp[] = array_merge($result_item, [$property => $property_value]);
            }
        }
        
        // Mise à jour des résultats avec les nouvelles combinaisons
        $result = $tmp;
    }

    // Stockage des combinaisons finales
    $combinations = $result;

    // Retourne une réponse JSON avec une vue partielle des combinaisons de variantes
    return response()->json([
        'view' => view('admin-views.product.partials._variant-combinations', compact('combinations', 'price', 'product_name'))->render(),
    ]);
}



    public function index()
    {
        $categories = Category::where(['position' => 0])->get();
        // return view('admin-views.product.index', compact('categories'));

        $ingcategories = IngCategory::where(['parent_id' => 0])->get();
        return view('admin-views.product.index', compact('ingcategories', 'categories'));
    }

    /*  public function index1()
    {
        $categories = Category::where(['position' => 0])->get();
        return view('admin-views.formule.index', compact('categories'));
    }*/

    public function get_categories(Request $request)
    {
        $cat = Product::where(['category_ids' => '[{"id":"' . $request->parent_id . '"}]'])->get();
        //$res = '<option value="select" disabled selected>---Select---</option>';  
        $res = 0;
        foreach ($cat as $row) {

            $res .= '<option value="' . $row->name . '">' . $row->name . '</option>';
        }

        return response()->json([
            'options' => $res,
        ]);
    }
 

    public function get_category(Request $request)
    {
        $cat = Product::where(['category_ids' => '[{"id":"' . $request->parent_id . '"}]'])->get();
        //$res = '<option value="select" disabled selected>---Select---</option>';  
        $res = 0;
        foreach ($cat as $row) {

            $res .= '<option value="' . $row->name . '">' . $row->name . '</option>';
        }

        return response()->json([
            'options' => $res,
        ]);
    }
    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $query = Product::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('id', 'like', "%{$value}%")->orWhere('name', 'like', "%{$value}%");
                }
            })->latest();
            $query_param = ['search' => $request['search']];
        } else {
            $query = Product::latest();
        }
        $products = $query->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.product.list', compact('products', 'search'));
    }

    public function search(Request $request)
    {
        $key = explode(' ', $request['search']);
        $products = Product::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view' => view('admin-views.product.partials._table', compact('products'))->render()
        ]);
    }

    public function view($id)
    {
        $product = Product::where(['id' => $id])->first();
        $reviews = Review::where(['product_id' => $id])->latest()->paginate(20);
        return view('admin-views.product.view', compact('product', 'reviews'));
    }
    


    public function ajouter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            //'category_id' => 'required',
            'image' => 'required',
            'price' => 'required|numeric',
        ], [
            'name.required' => 'Product name is required!',
            'category_id.required' => 'category  is required!',
        ]);

        if ($request['discount_type'] == 'percent') {
            $dis = ($request['price'] / 100) * $request['discount'];
        } else {
            $dis = $request['discount'];
        }

        if ($request['price'] <= $dis) {
            $validator->getMessageBag()->add('unit_price', 'Discount can not be more or equal to the price!');
        }

        if ($request['price'] <= $dis || $validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        $img_names = [];
        if (!empty($request->file('images'))) {
            foreach ($request->images as $img) {
                $image_data = Helpers::upload('product/', 'png', $img);
                array_push($img_names, $image_data);
            }
            $image_data = json_encode($img_names);
        } else {
            $image_data = json_encode([]);
        }

        $product = new Product();

        $product->name = $request->name;
        $category = [];
        if ($request->category_ids != null) {
            array_push($category, [
                'id' => $request->category_ids,
            ]);
        }

        $product->category_ids = json_encode($category);
       

        $choice_options = [];
        if ($request->has('choice')) {
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_' . $no;
                if ($request[$str][0] == null) {
                    $validator->getMessageBag()->add('name', 'Attribute choice option values can not be null!');
                    return response()->json(['errors' => Helpers::error_processor($validator)]);
                }
               // Construit le nom unique pour l'item en utilisant le numéro de choix
              $item['name'] = 'choice_' . $no;

                 // Récupère le titre du choix à partir de la requête en utilisant la clé correspondante
                 $item['title'] = $request->choice[$key];

                 // Nettoie la chaîne de caractères en remplaçant les séquences d'espaces par un seul espace
                 $cleaned_str = preg_replace('/\s+/', ' ', $request[$str]);

                // Divise la chaîne nettoyée en un tableau d'options en utilisant la virgule comme délimiteur
                $item['options'] = explode(',', $cleaned_str);

                // Ajoute l'item au tableau des options de choix
                array_push($choice_options, $item);
            }
        }
        $product->choice_options = json_encode($choice_options);
        $variations = [];
        $options = [];
        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }
        //Generates the combinations of customer choice options
        $combinations = Helpers::combinations($options);
        if (count($combinations[0]) > 0) {
            foreach ($combinations as $key => $combination) {
                $str = '';
                foreach ($combination as $k => $item) {
                    if ($k > 0) {
                        $str .= '-' . str_replace(' ', '', $item);
                    } else {
                        $str .= str_replace(' ', '', $item);
                    }
                }
                $item = [];
                $item['type'] = $str;
                $item['price'] = abs($request['price_' . str_replace('.', '_', $str)]);
                array_push($variations, $item);
            }
        }
        //combinations end
        $product->variations = json_encode($variations);
        $product->price = $request->price;
        //$product->quantity_stock = $request->quantity_stock;

        //  $product->set_menu = $request->item_type;
        $product->image = Helpers::upload('product/', 'png', $request->file('image'));
        // $product->available_time_starts = $request->available_time_starts;
        // $product->available_time_ends = $request->available_time_ends;

        $product->tax = $request->tax_type == 'amount' ? $request->tax : $request->tax;
        $product->tax_type = $request->tax_type;
        //$product->pricedisc = $request->pricedisc;

        $product->discount = $request->discount_type == 'amount' ? $request->discount : $request->discount;
        $product->discount_type = $request->discount_type;

        $product->attributes = $request->has('attribute_id') ? json_encode($request->attribute_id) : json_encode([]);
        $product->add_ons = $request->has('addon_ids') ? json_encode($request->addon_ids) : json_encode([]);
       // $product->category_ids = $request->has('categories') ? json_encode($request->categories) : json_encode([]);

        $product->ingredients = $request->has('ingredient_ids') ? json_encode($request->ingredient_ids) : json_encode([]);
        //$product->ingredients = $request->has('ingredient_ids') ? json_encode($request->ingredient_ids) : $product->ingredients;


        $product->save();
       

        return response()->json([], 200);
    }

    public function edit($id)
    {
        $product = Product::withoutGlobalScopes()->with('translations')->find($id);
        $product_category = json_decode($product->category_ids);
        $ingredient_category = json_decode($product->ingredients);

        $categories = Category::get();
        $ingcategories = IngCategory::where(['parent_id' => 0])->get();

        return view('admin-views.product.edit', compact('product', 'product_category', 'categories', 'ingcategories', 'ingredient_category'));
    }

    public function status(Request $request)
    {
        $product = Product::find($request->id);
        $product->status = $request->status;
        $product->save();
        Toastr::success('Product status updated!');
        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            //'category_id' => 'required',
            'price' => 'required|numeric',
        ], [
            'name.required' => 'Product name is required!',
            //'category_id.required' => 'category  is required!',
        ]);

        if ($request['discount_type'] == 'percent') {
            $dis = ($request['price'] / 100) * $request['discount'];
        } else {
            $dis = $request['discount'];
        }

        if ($request['price'] <= $dis) {
            $validator->getMessageBag()->add('unit_price', 'Discount can not be more or equal to the price!');
        }

        if ($request['price'] <= $dis || $validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        $product = Product::find($id);
        $product->name = $request->name;
        //$product->quantity_stock = $request->quantity_stock;


        $category = [];
        if ($request->category_id != null) {
            array_push($category, [
                'id' => $request->category_id,
            ]);
        }

        $product->category_ids = json_encode($category);


     

        $choice_options = [];
        if ($request->has('choice')) {
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_' . $no;
                if ($request[$str][0] == null) {
                    $validator->getMessageBag()->add('name', 'Attribute choice option values can not be null!');
                    return response()->json(['errors' => Helpers::error_processor($validator)]);
                }
                $item['name'] = 'choice_' . $no;
                $item['title'] = $request->choice[$key];
                $item['options'] = explode(',', implode('|', preg_replace('/\s+/', ' ', $request[$str])));
                array_push($choice_options, $item);
            }
        }
        $product->choice_options = json_encode($choice_options);
        $variations = [];
        $options = [];
        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }
        //Generates the combinations of customer choice options
        $combinations = Helpers::combinations($options);
        if (count($combinations[0]) > 0) {
            foreach ($combinations as $key => $combination) {
                $str = '';
                foreach ($combination as $k => $item) {
                    if ($k > 0) {
                        $str .= '-' . str_replace(' ', '', $item);
                    } else {
                        $str .= str_replace(' ', '', $item);
                    }
                }
                $item = [];
                $item['type'] = $str;
                $item['price'] = abs($request['price_' . str_replace('.', '_', $str)]);
                array_push($variations, $item);
            }
        }
        //combinations end
        $product->variations = json_encode($variations);
        $product->price = $request->price;
        // $product->set_menu = $request->item_type;
        $product->image = $request->has('image') ? Helpers::update('product/', $product->image, 'png', $request->file('image')) : $product->image;
        // $product->available_time_starts = $request->available_time_starts;
        //$product->available_time_ends = $request->available_time_ends;

        $product->tax = $request->tax_type == 'amount' ? $request->tax : $request->tax;
        $product->tax_type = $request->tax_type;
        // $product->pricedisc = $request->pricedisc;

        $product->discount = $request->discount_type == 'amount' ? $request->discount : $request->discount;
        $product->discount_type = $request->discount_type;

        $product->attributes = $request->has('attribute_id') ? json_encode($request->attribute_id) : json_encode([]);
        $product->add_ons = $request->has('addon_ids') ? json_encode($request->addon_ids) : json_encode([]);

        $product->ingredients = $request->has('ingredient_ids') ? json_encode($request->ingredient_ids) : json_encode([]);
        //$product->ingredients = $request->has('ingredient_ids') ? json_encode($request->ingredient_ids) : $product->ingredients;



        $product->save();
        /* 
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    [
                        'translationable_type' => 'App\Model\Product',
                        'translationable_id' => $product->id,
                        'locale' => $key,
                        'key' => 'name'
                    ],
                    ['value' => $request->name[$index]]
                );
            }
            if ($request->description[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    [
                        'translationable_type' => 'App\Model\Product',
                        'translationable_id' => $product->id,
                        'locale' => $key,
                        'key' => 'description'
                    ],
                    ['value' => strip_tags($request->description[$index])]
                );
            }
        }
 */
        // return response()->json([], 200);
        Toastr::success('Product updated successfully!');
        return back();
        //  return view('admin-views.product.list', compact('product'));  
    }

    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        Helpers::delete('product/' . $product['image']);
        $product->delete();
        Toastr::success('Product removed!');
        return back();
    }

    public function bulk_import_index()
    {
        return view('admin-views.product.bulk-import');
    }

    public function bulk_import_data(Request $request)
    {
        try {
            $collections = (new FastExcel)->import($request->file('products_file'));
        } catch (\Exception $exception) {
            Toastr::error('You have uploaded a wrong format file, please upload the right file.');
            return back();
        }

        $data = [];
        foreach ($collections as $key => $collection) {
            if ($collection['name'] === "") {
                Toastr::error('Please fill name fields of row ' . ($key + 2));
                return back();
            }
            if ($collection['description'] === "") {
                Toastr::error('Please fill description fields of row ' . ($key + 2));
                return back();
            }
            if ($collection['price'] === "") {
                Toastr::error('Please fill price fields of row ' . ($key + 2));
                return back();
            }
            if ($collection['tax'] === "") {
                Toastr::error('Please fill tax fields of row ' . ($key + 2));
                return back();
            }
            if ($collection['category_id'] === "") {
                Toastr::error('Please fill category_id fields of row ' . ($key + 2));
                return back();
            }
            /*if ($collection['sub_category_id'] === "") {
                Toastr::error('Please fill sub_category_id fields of row ' . ($key + 2));
                return back();
            }*/
            if ($collection['discount'] === "") {
                Toastr::error('Please fill discount fields of row ' . ($key + 2));
                return back();
            }
            if ($collection['discount_type'] === "") {
                Toastr::error('Please fill discount_type fields of row ' . ($key + 2));
                return back();
            }
            if ($collection['tax_type'] === "") {
                Toastr::error('Please fill tax_type fields of row ' . ($key + 2));
                return back();
            }
            /* if ($collection['set_menu'] === "") {
                Toastr::error('Please fill set_menu fields of row ' . ($key + 2));
                return back();
            }*/

            if (!is_numeric($collection['price'])) {
                Toastr::error('Price of row ' . ($key + 2) . ' must be number');
                return back();
            }

            if (!is_numeric($collection['discount'])) {
                Toastr::error('Discount of row ' . ($key + 2) . ' must be number');
                return back();
            }

            if (!is_numeric($collection['tax'])) {
                Toastr::error('Tax of row ' . ($key + 2) . ' must be number');
                return back();
            }

            $product = [
                'discount_type' => $collection['discount_type'],
                'discount' => $collection['discount'],
            ];
            if ($collection['price'] <= Helpers::discount_calculate($product, $collection['price'])) {
                Toastr::error('Discount can not be more or equal to the price in row ' . ($key + 2));
                return back();
            }
        }

        foreach ($collections as $collection) {
            array_push($data, [
                'name' => $collection['name'],
                'description' => $collection['description'],
                'image' => 'def.png',
                'price' => $collection['price'],
                'variations' => json_encode([]),
                'add_ons' => json_encode([]),
                'ingredients' => json_encode([]),
                'tax' => $collection['tax'],
                'status' => 1,
                'attributes' => json_encode([]),
                'category_ids' => json_encode([['id' => $collection['category_id'], 'position' => 0],/* ['id' => $collection['sub_category_id'], 'position' => 1]*/]),
                'choice_options' => json_encode([]),
                'discount' => $collection['discount'],
                'discount_type' => $collection['discount_type'],
                'tax_type' => $collection['tax_type'],
                'set_menu' => $collection['set_menu'],
            ]);
        }
        DB::table('products')->insert($data);
        Toastr::success(count($data) . ' - Products imported successfully!');
        return back();
    }

    public function bulk_export_data()
    {
        $products = Product::get();
        $storage = [];

        foreach ($products as $item) {
            $category_id = 0;
            $sub_category_id = 0;
            foreach (json_decode($item->category_ids, true) as $category) {
                if ($category['position'] == 1) {
                    $category_id = $category['id'];
                } else if ($category['position'] == 2) {
                    $sub_category_id = $category['id'];
                }
            }

            if (!isset($item->name)) {
                $item->name = 'Demo Product';
            }

            if (!isset($item->description)) {
                $item->description = 'No description available';
            }

            $storage = [
                'name' => $item->name,
                'description' => $item->description,
                'category_id' => $category_id,
                'sub_category_id' => $sub_category_id,
                'price' => $item->price,
                'tax' => $item->tax,
                'available_time_starts	' => $item->available_time_starts,
                'available_time_ends' => $item->available_time_ends,
                'status' => $item->status,
                'discount' => $item->discount,
                'discount_type' => $item->discount_type,
                'tax_type' => $item->tax_type,
                'set_menu' => $item->set_menu,

            ];
        }
        return (new FastExcel($storage))->download('products.xlsx');
    }
}
