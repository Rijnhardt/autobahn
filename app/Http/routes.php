<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('orders', 'OrderController');

Route::get('api/products', 'OrderController@getProducts');

Route::get('api/kitchen', function () {
   
    $results = DB::select('select orders.id as order_id, products.name, order_items.qty from kitchen_items inner join order_items on kitchen_items.order_item_id = order_items.id inner join orders on order_items.order_id = orders.id inner join products on order_items.product_id = products.id where kitchen_items.is_completed = false');
    return $results;
    
});

Route::get('/orderItem/complete/{id}', function ($id){
   $kitchenItem = \App\KitchenItem::where('order_item_id', '=', $id)->get();
   
   $kitchenItem->is_completed = true;
   $kitchenItem->completed_at = Carbon::now();
   
   $kitchenItem->save();
});

Route::get('kitchen', function () {
   return view('kitchen.index'); 
});

Route::auth();



