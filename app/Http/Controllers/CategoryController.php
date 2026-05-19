<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Fungsi 1: Untuk membaca seluruh data dan menampilkannya di tabel HTML
    public function index()
    {
        // Category::latest()->get() mengambil data urut dari yang paling baru ditambah
        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }
    // Fungsi 2: Menampilkan halaman HTML form untuk input kategori baru
    public function create()
    {
        return view('categories.create');
    }
    // Fungsi 3: Menangkap data kiriman form dari fungsi "create" dan memasukannya ke Database
    public function store(Request $request)
    {
        // Bagian penting: VALIDASI. 
        // a. required = harus diisi
        // b. unique:categories,name = nilai yang diketik tidak boleh sama 
        //    dengan data di dalam tabel 'categories' kolom 'name'.
        $request->validate([
            'name' => 'required|string|unique:categories,name|max:255'
        ]);
        Category::create($request->all());
        return redirect()->route('categories.index')
            ->with('success', 'Satu Kategori berhasil ditambahkan!');
    }
    // Fungsi 4: Menampilkan halaman form untuk mengubah data (beserta pembawaan data lama)
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }
    // Fungsi 5: Menerima data perbaikan dari halaman "edit" untuk di timpa ke Database lama
    public function update(Request $request, Category $category)
    {
        // Validasi unik pada operasi Update butuh penanganan khusus.
        // Kita harus menambahkan ID Kategori saat ini (,$category>id) di ujung tag unique.
        // Tujuannya agar sistem "memaklumi/mengabaikan" namanya sendiri saat divalidasi
        // jadi tidak terjadi error "Nama sudah dipakai" oleh dirinya sendiri.
        $request->validate([
            'name' => 'required|string|unique:categories,name,' .
                $category->id . '|max:255'
        ]);
        $category->update($request->all());
        return redirect()->route('categories.index')
            ->with('success', 'Data Kategori berhasil diupdate!');
    }
    // Fungsi 6: Menghapus data spesifik dari Database
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Data Kategori berhasil dihapus!');
    }
}