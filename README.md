# Sistem Manajemen Karyawan - Laravel CRUD

Aplikasi web untuk mengelola data karyawan perusahaan dengan operasi CRUD (Create, Read, Update, Delete) lengkap. Dibangun menggunakan Laravel 12 dengan Tailwind CSS untuk tampilan yang modern dan responsif.

## 🚀 Fitur Utama

- ✅ **CRUD Lengkap**: Create, Read, Update, Delete data karyawan
- ✅ **Pencarian**: Pencarian karyawan berdasarkan nama
- ✅ **Filter**: Filter berdasarkan divisi dan pendidikan
- ✅ **Sorting**: Pengurutan data berdasarkan ID, pendidikan, divisi, atau tanggal
- ✅ **Pagination**: Tampilkan 5, 10, atau 50 data per halaman
- ✅ **Validasi**: Validasi input dengan pesan error yang jelas
- ✅ **UI Modern**: Menggunakan Tailwind CSS untuk tampilan yang menarik
- ✅ **Responsive**: Tampilan yang responsif untuk berbagai ukuran layar

## 📋 Persyaratan Sistem

- PHP 8.1+ (disarankan PHP 8.2)
- Composer
- MySQL / MariaDB
- Node.js & npm (opsional, untuk build assets)

## 🛠️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/ryustore69/CRUD_Karyawan.git
cd CRUD_Karyawan
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crud
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Migration

```bash
php artisan migrate
```

### 6. Jalankan Server

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 📁 Struktur Database

### Tabel: `karyawans`

| Kolom | Tipe Data | Keterangan |
|-------|-----------|------------|
| id | bigint | Primary key, auto increment |
| nama | string(255) | Nama lengkap karyawan (min 3 karakter) |
| pendidikan | enum | Pilihan: S1, S2, S3 |
| divisi | enum | Pilihan: Marketing, Produksi, SDM, IT, HRD, Finance, Operations, Quality Control, Research & Development, Legal, Procurement, Customer Service |
| created_at | timestamp | Waktu data dibuat |
| updated_at | timestamp | Waktu data terakhir diupdate |

## 🎯 Cara Menggunakan

### Menambah Karyawan Baru

1. Klik tombol **"Tambah Karyawan Baru"** di halaman index
2. Isi form dengan data karyawan:
   - Nama (minimal 3 karakter)
   - Pendidikan (S1, S2, atau S3)
   - Divisi (pilih dari 12 divisi yang tersedia)
3. Klik **"Simpan Karyawan"**

### Mencari Karyawan

1. Gunakan form pencarian di halaman index
2. Masukkan nama karyawan yang ingin dicari
3. Klik tombol **"Cari"**

### Filter Karyawan

1. Gunakan dropdown **Divisi** atau **Pendidikan** di form filter
2. Pilih divisi atau pendidikan yang diinginkan
3. Klik tombol **"Cari"**

### Mengurutkan Data

1. Klik header kolom di tabel untuk mengurutkan
2. Klik sekali untuk ascending, klik lagi untuk descending
3. Kolom yang bisa diurutkan: ID, Pendidikan, Divisi, Tanggal Dibuat

### Mengubah Jumlah Data per Halaman

1. Gunakan dropdown **"Tampilkan"** di bagian pagination
2. Pilih jumlah data: 5, 10, atau 50
3. Halaman akan otomatis refresh dengan jumlah data yang dipilih

### Mengedit Karyawan

1. Klik tombol **"Edit"** pada baris karyawan yang ingin diedit
2. Ubah data yang diperlukan
3. Klik **"Update Karyawan"**

### Menghapus Karyawan

1. Klik tombol **"Hapus"** pada baris karyawan yang ingin dihapus
2. Konfirmasi penghapusan di dialog yang muncul
3. Data akan dihapus secara permanen

## 🛣️ Routes

Aplikasi menggunakan route eksplisit untuk operasi CRUD:

| Method | URL | Keterangan |
|--------|-----|------------|
| GET | `/karyawans` | Daftar karyawan |
| GET | `/karyawans/create` | Form tambah karyawan |
| POST | `/karyawans` | Simpan karyawan baru |
| GET | `/karyawans/{id}` | Detail karyawan |
| GET | `/karyawans/{id}/edit` | Form edit karyawan |
| PUT | `/karyawans/{id}` | Update karyawan |
| DELETE | `/karyawans/{id}` | Hapus karyawan |

## 📚 Dokumentasi

- **DOCUMENTASI_KARYAWAN.md**: Dokumentasi lengkap aplikasi
- **ALGORITMA_CRUD.md**: Dokumentasi algoritma untuk setiap operasi CRUD

## 🎨 Teknologi yang Digunakan

- **Backend**: Laravel 12
- **Frontend**: Tailwind CSS (CDN)
- **Database**: MySQL / MariaDB
- **ORM**: Eloquent ORM
- **Icons**: Font Awesome 6.0

## 📝 Validasi Input

### Nama
- Wajib diisi
- Minimal 3 karakter
- Maksimal 255 karakter

### Pendidikan
- Wajib dipilih
- Harus salah satu dari: S1, S2, S3

### Divisi
- Wajib dipilih
- Harus salah satu dari 12 divisi yang tersedia

## 🔒 Keamanan

- CSRF Protection pada semua form
- Validasi input di server-side
- Route Model Binding untuk keamanan parameter
- Sanitasi input otomatis oleh Laravel

## 📦 File Penting

- `app/Http/Controllers/KaryawanController.php`: Controller untuk operasi CRUD
- `app/Models/Karyawan.php`: Model untuk tabel karyawans
- `database/migrations/xxxx_create_karyawans_table.php`: Migration untuk tabel karyawans
- `resources/views/karyawans/`: Views untuk operasi CRUD
- `routes/web.php`: Definisi routes

## 🐛 Troubleshooting

### Error: "Route not found"
- Pastikan sudah menjalankan `php artisan route:list` untuk melihat semua routes
- Pastikan route sudah didefinisikan di `routes/web.php`

### Error: "Table not found"
- Pastikan sudah menjalankan `php artisan migrate`
- Pastikan database sudah dibuat dan dikonfigurasi di `.env`

### Error: "Class not found"
- Jalankan `composer dump-autoload`
- Pastikan semua dependencies sudah terinstall dengan `composer install`

## 📄 Lisensi

Proyek ini dibuat untuk keperluan pembelajaran dan praktikum.

## 👤 Author

Dibuat untuk Praktikum Pemrograman Tingkat Lanjut - MKSIW31

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- Font Awesome

---

**Happy Coding! 🚀**
