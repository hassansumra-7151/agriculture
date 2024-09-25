<?php

namespace App\Helpers;

use App\Models\GeneralSettings;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Auth;

class Helpers
{
    public static function getGeneralSettings()
    {
        return GeneralSettings::first();
    }

    public static function getUserData()
    {
        return auth()->user(); 
    }

    public static function getProductCount()
    {
        return Product::count();
    }

    public static function getCartTotalItems()
    {
        $user = auth()->user(); 
        return $user ? Cart::where('user_id', $user->id)->count() : 0;
    }

    public static function getCategoriesWithSubcategories()
    {
        // Retrieve categories with their subcategories
        $categories = Category::with('subcategories')->whereNull('parent_category')->get();
        return $categories;
    }
}
