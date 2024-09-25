<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{

	public function __construct()
    {
        $this->middleware('permission:manage category', ['only' => ['index']]);
    }

    public function create()
    {
    	$categories = Category::whereNull('category_id')->get();
        return view('admin.category.create', compact('categories'));
        
    }
	public function store(Request $request)
	{
	    // Validate the incoming request data
	    $validatedData = $request->validate([
	        'category_name' => 'required|string|max:255',
	        'parent_category' => 'nullable|exists:categories,id', // Corrected validation rule
	    ]);

	    $data = array(
	         'category_name' => $request->category_name,
	         'category_id' => $request->category_id,
	        );
	        $create = Category::create($data);
	        return response()->json(['message' => 'Category Added successfully!']);
	}


}
