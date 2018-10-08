<?php

namespace App\Http\Controllers;

use App\Cash;
use App\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;
class CashController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();

        $cash = DB::table('cashes')
            ->join('products', 'cashes.product_id', '=', 'products.id')
            ->join('sales', 'sales.product_id', '=', 'products.id')
            ->select('products.brand_name','products.generic_name', 'cashes.*','sales.number')
            ->orderBy('id', 'DESC')->first();
       // ->get();

     //  dd($cash);


        view()->share('cash',$cash);
           // dd($cash);

        if($request->has('download')){
                $pdf = PDF::loadView('cash');
                return $pdf->download('cash.pdf');
            }

            return view('cash',compact('products','cash'));
        }
       // return view('cash',compact('cash','products'));

      /*  $cashes = DB::table("cashes")->orderBy('id', 'desc')->first();
        $prod = DB::table("products")->get();
        dd($cashes, $prod);
        view()->share('cashes', $cashes);
        //dd($cashes);

        if ($request->has('download')) {
            $pdf =  PDF::loadview('cash');
            return $pdf->download('pdfview.pdf');
        }*/
      //  return view ('cash');




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
        $cash = Cash::create($request->input());
        return response()->json($cash);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
