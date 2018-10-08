<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('sales')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->select('products.*', 'sales.number')
            ->get();
        //dd($products);

        return view('product',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->input());
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $product = Product::find($product_id);
        return response()->json($product);
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
    public function update(Request $request, $product_id)
    {
        $product = Product::find($product_id);
        $product->brand_name = $request->brand_name;
        $product->generic_name = $request->generic_name;
        $product->description = $request->description;
        $product->date_arrival = $request->date_arrival;
        $product->expiry_date = $request->expiry_date;
        $product->selling_price = $request->selling_price;
        $product->original_price = $request->original_price;
        $product->quantity = $request->quantity;
        $product->quantity_left = $request->quantity_left;
        $product->profit = $request->profit;
        $product->save();
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $product = Product::destroy($product_id);
        return response()->json($product);
    }
}
