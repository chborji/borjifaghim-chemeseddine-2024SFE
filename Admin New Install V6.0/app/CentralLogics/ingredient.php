<?php

namespace App\CentralLogics;

use App\Model\Ingredient;

class IngredientLogic
{
    public static function get_ingredient($id)
    {
        return Ingredient::active()->where('id', $id)->first();
    }
}
