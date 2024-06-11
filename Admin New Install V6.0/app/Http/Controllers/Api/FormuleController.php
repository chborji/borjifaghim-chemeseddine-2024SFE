<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Formule;
use Illuminate\Http\Request;

class FormuleController extends Controller
{
    public function get_all_formules()
    {
        try {
            $formules = Formule::orderBy('name')->get();
            return response()->json($formules, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_formule($id)
    {
        try {

            $formule = Formule::find($id);
            return response()->json($formule, 200);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => ['code' => 'formule-001', 'message' => trans('custom.no_data_found')]
            ], 404);
        }
    }
}
