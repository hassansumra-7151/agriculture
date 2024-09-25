<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use PDF;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:manage product', ['only' => ['index']]);
    }
    
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }
    public function create()
    {
    	$categories = Category::whereNotNull('category_id')->get();
        return view('admin.product.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id', 
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'category_id' => $request->input('category_id'),
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
            'image' => '', 
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('product/images'), $imageName);
            $data['image'] = $imageName;
        }

        $product = Product::create($data);
        return response()->json(['message' => 'Product Added successfully!']);
    }
    public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::whereNotNull('category_id')->get();
        return view('admin.product.edit', compact('product','categories'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id', 
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $data = [
            'category_id' => $request->input('category_id'),
            'product_name' => $request->input('product_name'),
            'price' => $request->input('price'),
        ];

        if ($request->hasFile('image'))
        {
            if ($product->image && file_exists(public_path('product/images/' . $product->image))) {
                unlink(public_path('product/images/' . $product->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('product/images'), $imageName);
            $data['image'] = $imageName; // Set image field in data array
        }

        $product->update($data);
        return response()->json(['message' => 'Product updated successfully!']);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'product deleted successfully!']);
        }

        return response()->json(['message' => 'product not found.'], 404);
    }

    public function generateInvoicePDF($id)
    {

        $product = Product::findOrFail($id);
        $pdf = PDF::loadView('admin.invoice', compact('product'));
        return $pdf->stream('invoice_' . $product->id . '.pdf');
    }




}
