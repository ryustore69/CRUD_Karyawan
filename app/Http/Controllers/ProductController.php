<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar produk
     */
    public function index()
    {
        // Placeholder - nanti bisa diganti dengan view produk yang sesungguhnya
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat produk baru
     */
    public function create()
    {
        // Placeholder - nanti bisa diganti dengan view form create produk
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan produk baru ke database
     */
    public function store(Request $request)
    {
        // Placeholder - implementasi akan ditambahkan nanti
        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail produk berdasarkan id
     */
    public function show($id)
    {
        // Placeholder - implementasi akan ditambahkan nanti
        return view('product.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk edit produk
     */
    public function edit($id)
    {
        // Placeholder - implementasi akan ditambahkan nanti
        return view('product.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     * Memperbarui data produk di database
     */
    public function update(Request $request, $id)
    {
        // Placeholder - implementasi akan ditambahkan nanti
        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus produk dari database
     */
    public function destroy($id)
    {
        // Placeholder - implementasi akan ditambahkan nanti
        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}

