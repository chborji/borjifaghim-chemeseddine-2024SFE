<?php

namespace App\CentralLogics;

use App\Model\AddOn;
//use Razorpay\Api\Addon as ApiAddon;

class AddonLogic
{
    public static function get_addon($id)
    {
        //dd(Product::active()->where('id', $id)->first());
        return Addon::active()->where('id', $id)->first();
        //var_dump(Product::active()->where('id', $id)->first());
    }
}
