<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingProduct;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Auth;

class ProductController extends Controller
{
    public function shop(){
    	$products = Product::get();
        $allMainCategories = Category::whereNull('category_id')->with('subcategories')->get();
    	return view('frontend.product.shop' , compact('products' , 'allMainCategories'));
    }
    public function checkout(){
        return view('frontend.product.checkout');
    }

    public function shopDetail(){

    	return view('frontend.product.shop-detail');
    }
     public function viewProduct($id){
     	$product = Product::where('id' , $id)->first();
     	$category = Category::where('id', $id)->whereNull('category_id')->first();
     	$allMainCategories = Category::whereNull('category_id')->get();
    	return view('frontend.product.shop-detail' , compact('product' ,'category','allMainCategories'));
    }
    public function cart($id = Null){
        // $carts = Cart::with('product')->first();
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id',$user_id)->get();

    	return view('frontend.product.cart' , compact('carts'));
    }

    public function AddToCart(Request $request, $id) {
        $user = Auth::user()->id;
        $product_id = $id;

        $data = [
            'user_id' => $user,
            'product_id' => $product_id,
            'qty' => $request->qty
        ];


        $cart = Cart::create($data);


        return response()->json(['message' => 'Cart Added successfully!']);
    }

    public function store(Request $request)
    {
        // Get the cart data from the request
        $cartItems = $request->input('cart');
        $validProductIds = \DB::table('products')->pluck('id')->toArray();
        $bookingProducts = [];
        foreach ($cartItems as $item) {
            if (in_array($item['id'], $validProductIds)) { 
                $bookingProducts[] = [
                    'user_id' => auth()->id(),
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                ];
                
            }
        }

        // Insert data into the `booking_products` table if there are valid entries
        if (!empty($bookingProducts)) {
            BookingProduct::insert($bookingProducts);
        }

        // Handle subtotal and total as needed
        $subtotal = $request->input('subtotal');
        $total = $request->input('total');

        // You can save subtotal and total to another table or use them as needed

        // Redirect or return response as needed
        return redirect()->route('product.cart')->with('success', 'Checkout successful!');
    }

    public function deleteItem(Request $request)
    {
        $itemId = $request->input('id');
        $cartItem = Cart::find($itemId);

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
  
}
