<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Branch;
use App\Model\BusinessSetting;
use App\Model\Currency;

class ConfigController extends Controller
{
    public function configuration()
    {
        $currency_symbol = Currency::where(['currency_code' => Helpers::currency_code()])->first()->currency_symbol;
        $cod = json_decode(BusinessSetting::where(['key' => 'cash_on_delivery'])->first()->value, true);
        $dp = json_decode(BusinessSetting::where(['key' => 'digital_payment'])->first()->value, true);

        $dm_config = Helpers::get_business_settings('delivery_management');
        $delivery_management = array(
            "status" => (int) $dm_config['status'],
            "min_shipping_charge" => (float) $dm_config['min_shipping_charge'],
            "shipping_per_km" => (float) $dm_config['shipping_per_km'],
        );
        return response()->json([
            'restaurant_name' => BusinessSetting::where(['key' => 'restaurant_name'])->first()->value,
            'restaurant_open_time' => BusinessSetting::where(['key' => 'restaurant_open_time'])->first()->value,
            'restaurant_close_time' => BusinessSetting::where(['key' => 'restaurant_close_time'])->first()->value,
            'restaurant_logo' => BusinessSetting::where(['key' => 'logo'])->first()->value,
            'restaurant_address' => BusinessSetting::where(['key' => 'address'])->first()->value,
            'restaurant_phone' => BusinessSetting::where(['key' => 'phone'])->first()->value,
            'restaurant_email' => BusinessSetting::where(['key' => 'email_address'])->first()->value,
            //'restaurant_location_coverage' => Branch::where(['id' => 1])->first(['longitude', 'latitude', 'coverage']),
            'minimum_order_value' => (float)BusinessSetting::where(['key' => 'minimum_order_value'])->first()->value,
            'base_urls' => [
                'restaurant_image_url' => asset('storage/restaurant'),

                'product_image_url' => asset('storage/product'),
                'customer_image_url' => asset('storage/profile'),
                'banner_image_url' => asset('storage/banner'),
                'category_image_url' => asset('storage/category'),
                'review_image_url' => asset('storage/review'),
                'notification_image_url' => asset('storage/notification'),
                'delivery_man_image_url' => asset('storage/delivery-man'),
                'chat_image_url' => asset('storage/conversation'),
            ],
            'currency_symbol' => $currency_symbol,
            'delivery_charge' => (float) BusinessSetting::where(['key' => 'delivery_charge'])->first()->value,
            'delivery_management' => $delivery_management,
            'cash_on_delivery' => $cod['status'] == 1 ? 'true' : 'false',
            'digital_payment' => $dp['status'] == 1 ? 'true' : 'false',
            //'branches' => Branch::all(['id', 'name', 'email', 'longitude', 'latitude', 'address', 'coverage']),
            'terms_and_conditions' => BusinessSetting::where(['key' => 'terms_and_conditions'])->first()->value,
            'privacy_policy' => BusinessSetting::where(['key' => 'privacy_policy'])->first()->value,
            'about_us' => BusinessSetting::where(['key' => 'about_us'])->first()->value,
            /*'terms_and_conditions' => route('terms-and-conditions'),
            'privacy_policy' => route('privacy-policy'),
            'about_us' => route('about-us')*/
            'email_verification' => (bool)Helpers::get_business_settings('email_verification') ?? 0,
            'phone_verification' => (bool)Helpers::get_business_settings('phone_verification') ?? 0,
            'currency_symbol_position' => Helpers::get_business_settings('currency_symbol_position') ?? 'right',
            'maintenance_mode' => (bool)Helpers::get_business_settings('maintenance_mode') ?? 0,
            'country' => Helpers::get_business_settings('country') ?? 'BD',
            'self_pickup' => (bool)Helpers::get_business_settings('self_pickup') ?? 1,
            'delivery' => (bool)Helpers::get_business_settings('delivery') ?? 1,
        ]);
    }
}
