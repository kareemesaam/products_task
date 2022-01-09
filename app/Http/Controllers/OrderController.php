<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::pluck('name','id');
        return view('orders.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        // Start transaction!
        DB::beginTransaction();
        //create order
        $order = Order::create($request->safe()->only(['customer_name']));
        //add products to order
        foreach ($request->products as $item){
            $product =  Product::find($item['id']);
            if ($product && $product->stock >= $item['quantity'] ){
                $order->products()->attach($product->id, ['product_price' => $product->price, 'quantity' => $item['quantity']]);
                $product->decrement('stock', $item['quantity']);
            }else{
                // Rollback and then redirect
                DB::rollback();
                return redirect()->back()->with('error', 'Sorry the quantity of ' . $product->name .' product not allowed now please try again later');
            }
        }
        // Commit the queries!
        DB::commit();
        return redirect()->route('products.index')->with('success','Order Created successfully');

    }


}
