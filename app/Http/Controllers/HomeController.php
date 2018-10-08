<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cash;
use App\Customer;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::count();
        $products = Product::count();
        $incomes = Product::sum('selling_price');
        return view('home',compact('customers','products','incomes'));
    }

    public function sale(){
        $products =Product::all();

        $cash = Cash::all();

        $sales = DB::table('sales')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->select('products.*', 'sales.number')
            ->get();
       // dd($sales);

        return view('sales.index',compact('products','sales','cash'));
    }


    public function add(Request $request)
    {
        $sales = new Sale();
        $sales->number = $request->number;
        $sales->product_id = $request->product_id;
        $sales->save();

        return redirect()->back()
            ->with('success','created successfully');
    }

    public function user(){
        $users = User::all();
        return view('user',compact('users'));
    }

}
