<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderDetail;
use App\Brand;
use App\Category;
use App\Product;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['orderCount'] = OrderDetail::where(['status'=>1])->count();
        $data['brandCount'] = Brand::where(['status'=>1])->count();
        $data['categoryCount'] = Category::where(['status'=>1])->count();
        $data['productCount'] = Product::where(['status' => 1])->count();
        $orders = OrderDetail::where(['status'=>1])->orderBy('id', 'desc')->take(4)->get();

        return view('home',compact('orders', 'data'));

    }
}
