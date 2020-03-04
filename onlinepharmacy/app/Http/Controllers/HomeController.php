<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = product::take(20)->get();
        return view('home',['allproducts' => $products]);
    }
}
