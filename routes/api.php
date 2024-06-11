<?php

use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {
    Route::post('login', 'BranchAuthController@login');
    Route::post('check-email', 'BranchAuthController@check_email');
    Route::post('verify-email', 'BranchAuthController@verify_email');
    Route::get('logout', 'BranchAuthController@logout');
});
Route::group(['namespace' => 'Api'], function () {
    // Route::get('/', 'ConfigController@configuration');
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@get_categories');
        Route::get('childes/{category_id}', 'CategoryController@get_childes');
        Route::get('products/{category_id}', 'CategoryController@get_products');
        Route::get('products/{category_id}/all', 'CategoryController@get_all_products');
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'ProductController@get_all_products');
        Route::get('latest', 'ProductController@get_latest_products');
        // Route::get('set-menu', 'ProductController@get_set_menus');
        Route::get('search', 'ProductController@get_searched_products');
        // Route::get('details/{id}', 'ProductController@get_product');
        Route::get('details/{id}', 'ProductController@get_ingredient');
    });
    Route::group(['prefix' => 'config'], function () {
        Route::get('/', 'ConfigController@configuration');
    });
    Route::group(['prefix' => 'table'], function () {
        Route::get('/', 'TableController@get_all_tables');
        Route::post('status', 'TableController@update_table_status');
    });
    Route::group(['prefix' => 'ingredients'], function () {
        Route::get('/', 'IngredientController@get_all_ingredients');
        Route::get('details/{id}', 'IngredientController@get_product');
    });
    Route::group(['prefix' => 'addons'], function () {
        Route::get('/', 'AddonController@get_all_addons');
        Route::get('details/{id}', 'AddonController@get_addon');
    });

    Route::group(['prefix' => 'formules'], function () {
        Route::get('/', 'FormuleController@get_all_formules');
        Route::get('details/{id}', 'FormuleController@get_formule');
    });

    Route::group(['prefix' => 'composes'], function () {
        Route::get('/', 'ProductComposeController@get_all_composes');
        Route::get('details/{id}', 'ProductComposeController@get_compose');
    });


    Route::group(['prefix' => 'order'], function () {
        Route::get('list', 'OrderController@get_order_list');
        Route::get('details', 'OrderController@get_order_details');
        Route::post('place', 'OrderController@place_order');
        //Route::put('place/{id}', 'OrderController@get_order');

        Route::put('cancel', 'OrderController@cancel_order');
        Route::get('track', 'OrderController@track_order');
        Route::get('/', 'OrderController@get_all_order');

        Route::post('payment', 'OrderController@update_payment_status');
    });
});

Route::group(['namespace' => 'Api'], function () {

    Route::group(['prefix' => 'customer', 'middleware'], function () {
        Route::get('info', 'CustomerController@info');
        Route::put('update-profile', 'CustomerController@update_profile');
        Route::put('cm-firebase-token', 'CustomerController@update_cm_firebase_token');
        Route::get('transaction-history', 'CustomerController@get_transaction_history');

        Route::group(['prefix' => 'address'], function () {
            Route::get('list', 'CustomerController@address_list');
            Route::post('add', 'CustomerController@add_new_address');
            Route::put('update/{id}', 'CustomerController@update_address');
            Route::delete('delete', 'CustomerController@delete_address');
        });

        // Chatting
        Route::group(['prefix' => 'message'], function () {
            Route::get('get', 'ConversationController@messages');
            Route::post('send', 'ConversationController@messages_store');
            Route::post('chat-image', 'ConversationController@chat_image');
        });

        Route::group(['prefix' => 'wish-list'], function () {
            Route::get('/', 'WishlistController@wish_list');
            Route::post('add', 'WishlistController@add_to_wishlist');
            Route::delete('remove', 'WishlistController@remove_from_wishlist');
        });
    });
});





/*Route::group(['namespace' => 'Api\V1', 'middleware' => 'localization'], function () {

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
          Route::post('register', 'CustomerAuthController@registration');
        Route::post('login', 'CustomerAuthController@login');

        Route::post('check-phone', 'CustomerAuthController@check_phone');
        Route::post('verify-phone', 'CustomerAuthController@verify_phone');

        Route::post('check-email', 'CustomerAuthController@check_email');
        Route::post('verify-email', 'CustomerAuthController@verify_email');
     
        Route::post('forgot-password', 'PasswordResetController@reset_password_request');
        Route::post('verify-token', 'PasswordResetController@verify_token');
        Route::put('reset-password', 'PasswordResetController@reset_password_submit');

        Route::group(['prefix' => 'branch'], function () {
            Route::post('/login', 'BranchAuthController@login');
        });
    });
    
       Route::group(['prefix' => 'delivery-man'], function () {
        Route::get('profile', 'DeliverymanController@get_profile');
        Route::get('current-orders', 'DeliverymanController@get_current_orders');
        Route::get('all-orders', 'DeliverymanController@get_all_orders');
        Route::post('record-location-data', 'DeliverymanController@record_location_data');
        Route::get('order-delivery-history', 'DeliverymanController@get_order_history');
        Route::put('update-order-status', 'DeliverymanController@update_order_status');
        Route::put('update-payment-status', 'DeliverymanController@order_payment_status_update');
        Route::get('order-details', 'DeliverymanController@get_order_details');
        Route::get('last-location', 'DeliverymanController@get_last_location');
        Route::put('update-fcm-token', 'DeliverymanController@update_fcm_token');

        Route::group(['prefix' => 'reviews', 'middleware' => ['auth:api']], function () {
            Route::get('/{delivery_man_id}', 'DeliveryManReviewController@get_reviews');
            Route::get('rating/{delivery_man_id}', 'DeliveryManReviewController@get_rating');
            Route::post('/submit', 'DeliveryManReviewController@submit_review');
        });
    });
    

    Route::group(['prefix' => 'config'], function () {
        Route::get('/', 'ConfigController@configuration');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('latest', 'ProductController@get_latest_products');
        Route::get('set-menu', 'ProductController@get_set_menus');
        Route::get('search', 'ProductController@get_searched_products');
        Route::get('details/{id}', 'ProductController@get_product');
        Route::get('related-products/{product_id}', 'ProductController@get_related_products');
        Route::get('reviews/{product_id}', 'ProductController@get_product_reviews');
        Route::get('rating/{product_id}', 'ProductController@get_product_rating');
        Route::post('reviews/submit', 'ProductController@submit_product_review')->middleware('auth:api');
    });

    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', 'BannerController@get_banners');
    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', 'NotificationController@get_notifications');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoryController@get_categories');
        Route::get('childes/{category_id}', 'CategoryController@get_childes');
        Route::get('products/{category_id}', 'CategoryController@get_products');
        Route::get('products/{category_id}/all', 'CategoryController@get_all_products');
    });
*/

    /*

    Route::group(['prefix' => 'banners'], function () {
        Route::get('/', 'BannerController@get_banners');
    });

    Route::group(['prefix' => 'coupon', 'middleware' => 'auth:api'], function () {
        Route::get('list', 'CouponController@list');
        Route::get('apply', 'CouponController@apply');
    });

    //map api
    Route::group(['prefix' => 'mapapi'], function () {
        Route::get('place-api-autocomplete', 'MapApiController@place_api_autocomplete');
        Route::get('distance-api', 'MapApiController@distance_api');
        Route::get('place-api-details', 'MapApiController@place_api_details');
        Route::get('geocode-api', 'MapApiController@geocode_api');
    });
});*/
