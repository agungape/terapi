<?php

namespace App\Http\Controllers;

use App\Models\ShopeeAffiliateProduct;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopeeAffiliateController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = ShopeeAffiliateProduct::query()
            ->with(['primaryImage', 'category'])
            ->active()
            ->when($request->category, function ($query) use ($request) {
                $query->byCategory($request->category);
            })
            ->paginate(12);

        return view('e-commerce.products-services', compact('products', 'categories'));
    }
}
