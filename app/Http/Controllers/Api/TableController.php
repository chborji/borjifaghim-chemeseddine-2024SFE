<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\CategoryLogic;
use App\Http\Controllers\Controller;
use App\Model\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function get_all_tables()
    {
        try {
            $tables = Table::get();
            return response()->json($tables, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }


    public function update_table_status(Request $request)
    {

        if (Table::where(['id' => $request['id']])->first()) {
            Table::where(['id' => $request['id']])->update([
                'status' => $request['status']
            ]);
            return response()->json(['message' => trans('custom.payment_method_updated')], 200);
        }
        return response()->json([
            'errors' => [
                ['code' => 'orderjyfjf', 'message' => trans('custom.no_data_found')]
            ]
        ], 401);
    }
}
