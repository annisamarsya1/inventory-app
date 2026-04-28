<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }
public function insert()
{
    $category = Category::first();

    Product::create([
        'name' => 'Laptop Asus',
        'category_id' => $category->id,
        'price' => 7000000,
        'stock' => 10,
        'description' => 'Laptop gaming',
        'status' => 'tersedia'
    ]);

    return redirect('/products');
}


public function update()
    {
        $product = Product::first();

        if ($product) {
            $product->update([
                'name' => 'Laptop Lenovo',
                'price' => 8000000,
                'stock' => 5,
                'description' => 'Laptop update',
                'status' => 'habis'
            ]);
        }
        return redirect('/products');
    }


 public function delete()
    {
        $product = Product::first();

        if ($product) {
            $product->delete();
        }

        return redirect('/products');
}
}
