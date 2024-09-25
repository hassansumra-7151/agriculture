<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:manage banner', ['only' => ['index']]);
    }


    public function create()
    {
        return view('admin.banner.create');
        
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
	        'status' => 'required|boolean',
	        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'second_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'short_desc' => 'required|string|max:500',
        ]);

        $banner = new Banner;
        $banner->title = $request->title;
        $banner->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('banners'), $imageName);
            $banner->image =  $imageName;
        }

        if ($request->hasFile('second_image')) {
            $secondImage = $request->file('second_image');
            $secondImageName = time() . '_' . $secondImage->getClientOriginalName();
            $secondImage->storeAs('public/banners', $secondImageName);
            $banner->second_image = $secondImageName;
        }

        $banner->short_desc = $request->short_desc;
        $banner->save();
        return response()->json(['message' => 'Banner Added successfully!']);
    }

    public function list(){
        $banners = Banner::all();
        return view('admin.banner.list' , compact('banners'));
    }

    public function edit($id){
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'status' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'second_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $banner = Banner::findOrFail($id);
    $banner->title = $request->title;
    $banner->status = $request->status;

    if ($request->hasFile('image')) {
        // Delete the old image if exists
        if ($banner->image) {
            $oldImagePath = public_path('banners/' . $banner->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('banners'), $imageName);
        $banner->image = $imageName;
    }

    if ($request->hasFile('second_image')) {
        // Delete the old second image if exists
        if ($banner->second_image) {
            $oldSecondImagePath = public_path('banners/' . $banner->second_image);
            if (file_exists($oldSecondImagePath)) {
                unlink($oldSecondImagePath);
            }
        }
        
        $secondImage = $request->file('second_image');
        $secondImageName = time() . '_' . $secondImage->getClientOriginalName();
        $secondImage->move(public_path('banners'), $secondImageName);
        $banner->second_image = $secondImageName;
    }
    $banner->save();

    return response()->json(['message' => 'Banner updated successfully!']);
}


    public function destroy($id)
    {
        $banner = Banner::find($id);
        
        if ($banner) {
            $banner->delete();
            return response()->json(['message' => 'banner deleted successfully!']);
        }
    }
}
