<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = \App\Order::all();
        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = \App\ProductGroup::with('products')->get();
        
        return view('orders.create', ['products' => $products]);
        
    }
    
    public function getProducts()
    {
        return \App\ProductGroup::with('products')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $requestOrderItems = $request->all();
		$orderItems = [];
		
		$total = 0;
		
		$order = new \App\Order;
		$order->total = 0;
		$order->user_id = \Auth::user()->id;
		
		$order->save();
		
        $orderRef = $order->id;
        
        foreach($requestOrderItems as $item)
        {
            $orderItem = new \App\OrderItem;
            $orderItem->qty = $item["qty"];
            $orderItem->order_id = $orderRef;
            
            $product = \App\Product::find($item["product_id"]);
            
            $total = $total + ($orderItem->qty * $product->price);
            
            $orderItem->product_id = $product->id;
            
            $orderItem->save();
            
            if ($product->is_prepared) {
                $kitchenItem = new \App\KitchenItem;
                $kitchenItem->order_item_id = $orderItem->id;
                $kitchenItem->save();
            }
            
            $orderItems[] = $orderItem->qty . " x " . $product->name;
        }
        
        $order->total = $total;
        $order->items = sizeof($orderItems);

        $order->save();        
        
        return ["items" => $orderItems, "ref" => $orderRef, "total" => $total, "itemCount" => $order->items];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
