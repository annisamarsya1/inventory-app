<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Daftar produk
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('products.index', compact('products'));
    }

    // Form tambah
    public function create()
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $defaultCategories = ['Elektronik', 'Fashion', 'Makanan', 'Alat Tulis'];
            foreach ($defaultCategories as $name) {
                Category::firstOrCreate(['name' => $name]);
            }
            $categories = Category::all();
        }

        return view('products.create', compact('categories'));
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    // Tambah data otomatis
    public function insert()
    {
        $category = Category::inRandomOrder()->first();

        if (!$category) {
            return redirect()->route('products.index')
                ->with('error', 'Kategori belum ada, silakan tambah kategori terlebih dahulu.');
        }

        Product::create([
            'name' => 'Produk Otomatis',
            'category_id' => $category->id,
            'price' => 100000,
            'stock' => 50,
            'status' => 'tersedia',
            'description' => 'Data ditambahkan otomatis'
        ]);

        return redirect()->route('products.index')->with('success', 'Produk otomatis berhasil ditambahkan');
    }

    // Form edit
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Update produk
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate');
    }

    // Hapus produk
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}
