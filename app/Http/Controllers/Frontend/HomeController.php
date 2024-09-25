<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    public function index(){
    	$banners = Banner::where('status' , 1)->get();
    	$products = Product::all();
    	return view('frontend.dashboard' , compact('products','banners'));
    }
}
