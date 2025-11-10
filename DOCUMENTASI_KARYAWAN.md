# Dokumentasi CRUD Karyawan - Laravel 12

## 📋 Deskripsi Aplikasi

Aplikasi CRUD (Create, Read, Update, Delete) untuk mengelola data karyawan perusahaan. Aplikasi ini dibangun menggunakan Laravel 12 dengan arsitektur MVC (Model-View-Controller) dan menggunakan **Tailwind CSS** untuk styling.

### Fitur Utama:
- ✅ **Create**: Menambahkan data karyawan baru
- ✅ **Read**: Menampilkan daftar dan detail karyawan
- ✅ **Update**: Mengedit data karyawan yang sudah ada
- ✅ **Delete**: Menghapus data karyawan
- ✅ **Search**: Pencarian karyawan berdasarkan nama
- ✅ **Filter**: Filter berdasarkan divisi dan pendidikan
- ✅ **Sorting**: Pengurutan data berdasarkan kolom tertentu
- ✅ **Pagination**: Pembagian data menjadi beberapa halaman dengan opsi 5, 10, atau 50 data per halaman
- ✅ **Validasi**: Validasi input dengan pesan error yang jelas
- ✅ **CSRF Protection**: Perlindungan terhadap serangan CSRF
- ✅ **UI Modern**: Menggunakan Tailwind CSS untuk tampilan yang modern dan responsif

---

## 🗂️ Struktur Database

### Tabel: `karyawans`

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | bigint | Primary key, auto increment |
| nama | string(255) | Nama lengkap karyawan (min 3 karakter) |
| pendidikan | enum | Pilihan: S1, S2, S3 |
| divisi | enum | Pilihan: Marketing, Produksi, SDM, IT, HRD, Finance, Operations, Quality Control, Research & Development, Legal, Procurement, Customer Service |
| created_at | timestamp | Waktu data dibuat |
| updated_at | timestamp | Waktu data terakhir diupdate |

---

## 🛣️ Routing System

### Route Eksplisit

Aplikasi menggunakan **Route Eksplisit** yang didefinisikan satu per satu di `routes/web.php` untuk kejelasan dan kontrol yang lebih baik:

```php
use App\Http\Controllers\KaryawanController;

// 1. Index - Menampilkan daftar karyawan
Route::get('/karyawans', [KaryawanController::class, 'index'])->name('karyawans.index');

// 2. Create - Menampilkan form tambah karyawan
Route::get('/karyawans/create', [KaryawanController::class, 'create'])->name('karyawans.create');

// 3. Store - Menyimpan data karyawan baru
Route::post('/karyawans', [KaryawanController::class, 'store'])->name('karyawans.store');

// 4. Show - Menampilkan detail karyawan
Route::get('/karyawans/{karyawan}', [KaryawanController::class, 'show'])->name('karyawans.show');

// 5. Edit - Menampilkan form edit karyawan
Route::get('/karyawans/{karyawan}/edit', [KaryawanController::class, 'edit'])->name('karyawans.edit');

// 6. Update - Mengupdate data karyawan
Route::put('/karyawans/{karyawan}', [KaryawanController::class, 'update'])->name('karyawans.update');
Route::patch('/karyawans/{karyawan}', [KaryawanController::class, 'update']);

// 7. Destroy - Menghapus data karyawan
Route::delete('/karyawans/{karyawan}', [KaryawanController::class, 'destroy'])->name('karyawans.destroy');
```

### Daftar Route

| Method | URL | Route Name | Controller Method | Keterangan |
|--------|-----|------------|-------------------|------------|
| GET | `/karyawans` | `karyawans.index` | `index()` | Menampilkan daftar semua karyawan |
| GET | `/karyawans/create` | `karyawans.create` | `create()` | Menampilkan form tambah karyawan |
| POST | `/karyawans` | `karyawans.store` | `store()` | Menyimpan data karyawan baru |
| GET | `/karyawans/{id}` | `karyawans.show` | `show($id)` | Menampilkan detail karyawan |
| GET | `/karyawans/{id}/edit` | `karyawans.edit` | `edit($id)` | Menampilkan form edit karyawan |
| PUT/PATCH | `/karyawans/{id}` | `karyawans.update` | `update($id)` | Mengupdate data karyawan |
| DELETE | `/karyawans/{id}` | `karyawans.destroy` | `destroy($id)` | Menghapus data karyawan |

### Route Model Binding

Laravel secara otomatis melakukan **Route Model Binding** berdasarkan nama parameter `{karyawan}`:
- Laravel mencari model `Karyawan` berdasarkan ID
- Jika tidak ditemukan, otomatis return 404
- Contoh: `/karyawans/1` → mencari `Karyawan` dengan `id = 1`

---

## 📁 Struktur File

### 1. **Model** - `app/Models/Karyawan.php`
- Menggunakan Eloquent ORM
- Menentukan `$fillable = ['nama', 'pendidikan', 'divisi']` untuk mass assignment
- Menghubungkan dengan tabel `karyawans` di database

### 2. **Controller** - `app/Http/Controllers/KaryawanController.php`
- Resource Controller dengan 7 method
- Menangani logika bisnis dan validasi
- Mengatur alur data dari request ke view
- Fitur: Search, Filter, Sorting, Pagination (5/10/50)

### 3. **Migration** - `database/migrations/xxxx_create_karyawans_table.php`
- Mendefinisikan struktur tabel `karyawans`
- Menggunakan enum untuk pendidikan dan divisi
- Menambahkan timestamps otomatis

### 4. **Views** - `resources/views/karyawans/`
- `index.blade.php`: Daftar karyawan dengan search, filter, sorting, pagination (Tailwind CSS)
- `create.blade.php`: Form tambah karyawan baru (Tailwind CSS)
- `edit.blade.php`: Form edit karyawan (Tailwind CSS)
- `show.blade.php`: Detail karyawan (Tailwind CSS)
- `welcome.blade.php`: Halaman beranda (Tailwind CSS)

### 5. **Routes** - `routes/web.php`
- Mendefinisikan route eksplisit untuk karyawans
- Setiap route memiliki komentar penjelasan lengkap

---

## 🎨 Teknologi Frontend

### Tailwind CSS (CDN)

Aplikasi menggunakan **Tailwind CSS via CDN** untuk styling:

```html
<script src="https://cdn.tailwindcss.com"></script>
```

**Keuntungan:**
- ✅ Tidak perlu build process
- ✅ Mudah digunakan
- ✅ Styling yang modern dan responsif
- ✅ Utility-first CSS framework

**Komponen yang digunakan:**
- Cards dengan shadow dan rounded corners
- Buttons dengan hover effects dan transitions
- Forms dengan focus states
- Tables dengan hover effects
- Badges untuk status
- Responsive grid layout

---

## 🔄 Alur Kerja Aplikasi

### Create (Tambah Data)
1. User klik tombol "Tambah Karyawan Baru" → `GET /karyawans/create`
2. Controller `create()` menampilkan view `create.blade.php`
3. User isi form dan submit → `POST /karyawans`
4. Controller `store()` validasi input
5. Jika valid, simpan ke database menggunakan Model
6. Redirect ke `karyawans.index` dengan pesan sukses

### Read (Baca Data)
1. User akses `/karyawans` → `GET /karyawans`
2. Controller `index()` mengambil data dari database
3. Filter dan sorting diterapkan jika ada
4. Data di-paginate sesuai pilihan user (5, 10, atau 50 per halaman)
5. Menampilkan view `index.blade.php`

### Update (Edit Data)
1. User klik tombol "Edit" → `GET /karyawans/{id}/edit`
2. Controller `edit()` mengambil data berdasarkan ID
3. Menampilkan view `edit.blade.php` dengan data terisi
4. User edit form dan submit → `PUT /karyawans/{id}`
5. Controller `update()` validasi dan update data
6. Redirect ke `karyawans.index` dengan pesan sukses

### Delete (Hapus Data)
1. User klik tombol "Hapus" → `DELETE /karyawans/{id}`
2. Konfirmasi dialog muncul (JavaScript)
3. Jika dikonfirmasi, Controller `destroy()` menghapus data
4. Redirect ke `karyawans.index` dengan pesan sukses

---

## 🔍 Fitur Search & Filter

### Search (Pencarian)
- **Parameter**: `search`
- **Fungsi**: Mencari karyawan berdasarkan nama
- **Metode**: LIKE dengan wildcard (`%keyword%`)
- **Case-insensitive**: Default MySQL
- **Contoh**: `/karyawans?search=john`

### Filter
- **Divisi**: Filter berdasarkan divisi karyawan
- **Pendidikan**: Filter berdasarkan pendidikan (S1, S2, S3)
- **Kombinasi**: Search dan filter bisa dikombinasikan
- **Contoh**: `/karyawans?search=john&divisi=IT&pendidikan=S1`

### Sorting
- **Parameter**: `sort_by` dan `sort_direction`
- **Kolom yang bisa di-sort**: id, created_at, pendidikan, divisi
- **Arah sorting**: asc (ascending) atau desc (descending)
- **Contoh**: `/karyawans?sort_by=nama&sort_direction=asc`

---

## 📄 Pagination

### Opsi Pagination
Aplikasi mendukung 3 opsi pagination:
- **5 baris** per halaman
- **10 baris** per halaman (default)
- **50 baris** per halaman

### Cara Kerja
1. User memilih jumlah data per halaman dari dropdown
2. Parameter `per_page` dikirim ke controller
3. Controller validasi `per_page` (hanya 5, 10, atau 50)
4. Data di-paginate sesuai pilihan
5. Query parameters (search, filter, sorting) tetap dipertahankan

### Contoh URL
```
/karyawans?per_page=5&search=john&divisi=IT
```

---

## 🎯 Cara Menggunakan Route di Blade Template

### Menampilkan URL
```blade
{{ route('karyawans.index') }}
<!-- Output: http://localhost:8000/karyawans -->

{{ route('karyawans.show', 1) }}
<!-- Output: http://localhost:8000/karyawans/1 -->

{{ route('karyawans.edit', $karyawan->id) }}
<!-- Output: http://localhost:8000/karyawans/1/edit -->
```

### Link dengan Route
```blade
<a href="{{ route('karyawans.index') }}">Daftar Karyawan</a>
<a href="{{ route('karyawans.create') }}">Tambah Karyawan</a>
<a href="{{ route('karyawans.show', $karyawan->id) }}">Detail</a>
<a href="{{ route('karyawans.edit', $karyawan->id) }}">Edit</a>
```

### Form dengan Route
```blade
<!-- Form Create -->
<form action="{{ route('karyawans.store') }}" method="POST">
    @csrf
    <!-- fields -->
</form>

<!-- Form Update -->
<form action="{{ route('karyawans.update', $karyawan->id) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- fields -->
</form>

<!-- Form Delete -->
<form action="{{ route('karyawans.destroy', $karyawan->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Hapus</button>
</form>
```

---

## 🎨 Styling Button

### Button di Tabel (Index)
- **Lihat**: Background biru muda (`bg-blue-100`), teks biru (`text-blue-700`), dengan ikon mata
- **Edit**: Background indigo muda (`bg-indigo-100`), teks indigo (`text-indigo-700`), dengan ikon edit
- **Hapus**: Background merah solid (`bg-red-600`), teks putih, dengan ikon trash

### Button di Halaman Show
- **Edit Data**: Background biru (`bg-blue-600`), teks putih
- **Lihat Daftar**: Background abu-abu (`bg-gray-200`), teks abu-abu
- **Hapus**: Background merah (`bg-red-600`), teks putih

### Fitur Button
- ✅ Hover effects dengan perubahan warna
- ✅ Transitions untuk animasi halus
- ✅ Icons di setiap button
- ✅ Rounded corners (`rounded-lg`)
- ✅ Proper padding dan spacing

---

## 🔍 Query Parameter Lengkap

Route `karyawans.index` mendukung query parameter berikut:

```
/karyawans?search=nama&divisi=IT&pendidikan=S1&sort_by=nama&sort_direction=asc&per_page=10
```

| Parameter | Tipe | Keterangan | Contoh |
|-----------|------|------------|--------|
| `search` | string | Pencarian berdasarkan nama | `search=john` |
| `divisi` | string | Filter berdasarkan divisi | `divisi=IT` |
| `pendidikan` | string | Filter berdasarkan pendidikan | `pendidikan=S1` |
| `sort_by` | string | Kolom untuk sorting | `sort_by=id` |
| `sort_direction` | string | Arah sorting (asc/desc) | `sort_direction=asc` |
| `per_page` | integer | Jumlah data per halaman (5/10/50) | `per_page=10` |
| `page` | integer | Nomor halaman | `page=2` |

---

## ✅ Validasi Input

### Nama
- **Required**: Wajib diisi
- **String**: Harus berupa teks
- **Min**: Minimal 3 karakter
- **Max**: Maksimal 255 karakter

### Pendidikan
- **Required**: Wajib dipilih
- **In**: Harus salah satu dari: S1, S2, S3

### Divisi
- **Required**: Wajib dipilih
- **In**: Harus salah satu dari: Marketing, Produksi, SDM, IT, HRD, Finance, Operations, Quality Control, Research & Development, Legal, Procurement, Customer Service

### Pesan Error
- Pesan error ditampilkan di setiap field yang invalid
- Old input tetap tersimpan menggunakan `old()` helper
- Error messages dalam bahasa Indonesia

---

## 🚀 Cara Menjalankan Aplikasi

1. **Jalankan Migration**
   ```bash
   php artisan migrate
   ```

2. **Jalankan Server**
   ```bash
   php artisan serve
   ```

3. **Akses Aplikasi**
   ```
   http://localhost:8000/karyawans
   ```

4. **Akses Halaman Beranda**
   ```
   http://localhost:8000/
   ```

---

## 📝 Catatan Penting

1. **Route Eksplisit**: Route didefinisikan satu per satu untuk kejelasan dan kontrol yang lebih baik
2. **Route Model Binding**: Laravel otomatis melakukan model binding berdasarkan nama parameter
3. **CSRF Protection**: Semua form POST/PUT/DELETE harus menyertakan `@csrf`
4. **Method Spoofing**: Untuk PUT/PATCH/DELETE di HTML form, gunakan `@method('PUT')` atau `@method('DELETE')`
5. **Pagination**: Data di-paginate dengan opsi 5, 10, atau 50 per halaman
6. **Tailwind CSS**: Menggunakan Tailwind CSS via CDN untuk styling yang modern
7. **Search & Filter**: Bisa dikombinasikan dengan pagination dan sorting
8. **Validasi**: Semua input divalidasi dengan pesan error yang jelas

---

## 📚 Referensi

- [Laravel Controllers](https://laravel.com/docs/controllers)
- [Laravel Routing](https://laravel.com/docs/routing)
- [Laravel Validation](https://laravel.com/docs/validation)
- [Laravel Eloquent ORM](https://laravel.com/docs/eloquent)
- [Tailwind CSS](https://tailwindcss.com/docs)

---

## 📄 Dokumentasi Tambahan

- **ALGORITMA_CRUD.md**: Dokumentasi lengkap algoritma untuk setiap operasi CRUD
- **DOCUMENTASI_KARYAWAN.md**: Dokumentasi lengkap aplikasi (file ini)

---

**Dibuat untuk**: Praktikum Pemrograman Tingkat Lanjut  
**Mata Kuliah**: MKSIW31 / 3 SKS  
**Framework**: Laravel 12  
**Frontend**: Tailwind CSS (CDN)  
**Versi**: 2.0 (Updated dengan Tailwind CSS & Pagination)
