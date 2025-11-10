<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ============================================================================
// HOME ROUTE
// ============================================================================
// Route untuk menampilkan halaman welcome/beranda
// URL: http://localhost:8000/
// Method: GET
Route::get('/', function () {
    return view('welcome');
});

// ============================================================================
// KARYAWAN ROUTES - CRUD Operations (Route Eksplisit)
// ============================================================================
// Semua route untuk operasi CRUD karyawan didefinisikan secara eksplisit
// Route didefinisikan satu per satu untuk kejelasan dan kontrol yang lebih baik

// 1. Index - Menampilkan daftar karyawan dengan search, filter, dan pagination
// URL: http://localhost:8000/karyawans
// Method: GET
// Route Name: karyawans.index
// Controller: KaryawanController@index
Route::get('/karyawans', [KaryawanController::class, 'index'])->name('karyawans.index');

// 2. Create - Menampilkan form untuk menambah karyawan baru
// URL: http://localhost:8000/karyawans/create
// Method: GET
// Route Name: karyawans.create
// Controller: KaryawanController@create
Route::get('/karyawans/create', [KaryawanController::class, 'create'])->name('karyawans.create');

// 3. Store - Menyimpan data karyawan baru ke database
// URL: http://localhost:8000/karyawans
// Method: POST
// Route Name: karyawans.store
// Controller: KaryawanController@store
// Validasi: nama (required|min:3|max:255), pendidikan (required|in:S1,S2,S3), divisi (required|in:...)
Route::post('/karyawans', [KaryawanController::class, 'store'])->name('karyawans.store');

// 4. Show - Menampilkan detail karyawan berdasarkan ID
// URL: http://localhost:8000/karyawans/{id}
// Method: GET
// Route Name: karyawans.show
// Controller: KaryawanController@show
// Parameter: {karyawan} - ID atau model Karyawan (Route Model Binding)
Route::get('/karyawans/{karyawan}', [KaryawanController::class, 'show'])->name('karyawans.show');

// 5. Edit - Menampilkan form untuk mengedit data karyawan
// URL: http://localhost:8000/karyawans/{id}/edit
// Method: GET
// Route Name: karyawans.edit
// Controller: KaryawanController@edit
// Parameter: {karyawan} - ID atau model Karyawan (Route Model Binding)
Route::get('/karyawans/{karyawan}/edit', [KaryawanController::class, 'edit'])->name('karyawans.edit');

// 6. Update - Mengupdate data karyawan yang sudah ada
// URL: http://localhost:8000/karyawans/{id}
// Method: PUT atau PATCH
// Route Name: karyawans.update
// Controller: KaryawanController@update
// Parameter: {karyawan} - ID atau model Karyawan (Route Model Binding)
// Validasi: sama seperti store
Route::put('/karyawans/{karyawan}', [KaryawanController::class, 'update'])->name('karyawans.update');
Route::patch('/karyawans/{karyawan}', [KaryawanController::class, 'update']); // PATCH juga bisa digunakan

// 7. Destroy - Menghapus data karyawan dari database
// URL: http://localhost:8000/karyawans/{id}
// Method: DELETE
// Route Name: karyawans.destroy
// Controller: KaryawanController@destroy
// Parameter: {karyawan} - ID atau model Karyawan (Route Model Binding)
Route::delete('/karyawans/{karyawan}', [KaryawanController::class, 'destroy'])->name('karyawans.destroy');

// ============================================================================
// RINGKASAN ROUTE KARYAWAN
// ============================================================================
// Semua route di atas membuat 7 route untuk operasi CRUD:
//
// 1. GET    /karyawans              → karyawans.index    → index()    → Daftar karyawan
// 2. GET    /karyawans/create       → karyawans.create   → create()  → Form tambah
// 3. POST   /karyawans              → karyawans.store    → store()   → Simpan data baru
// 4. GET    /karyawans/{id}         → karyawans.show     → show()    → Detail karyawan
// 5. GET    /karyawans/{id}/edit    → karyawans.edit     → edit()    → Form edit
// 6. PUT    /karyawans/{id}         → karyawans.update   → update()  → Update data
// 7. DELETE /karyawans/{id}         → karyawans.destroy  → destroy() → Hapus data
//
// Catatan: Route Model Binding
// - Laravel secara otomatis mencari model Karyawan berdasarkan ID di parameter {karyawan}
// - Jika tidak ditemukan, akan otomatis return 404
// - Contoh: /karyawans/1 → mencari Karyawan dengan id = 1
//
// Cara cek semua route: php artisan route:list --name=karyawans
// Lihat dokumentasi lengkap di file: DOCUMENTASI_KARYAWAN.md

// ============================================================================
// PRODUCT ROUTES - CRUD Operations menggunakan Resource Controller
// ============================================================================
// Route resource untuk mengelola data produk (referensi dari modul sebelumnya)
Route::resource('product', \App\Http\Controllers\ProductController::class);