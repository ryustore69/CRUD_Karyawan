# Algoritma CRUD - Sistem Manajemen Karyawan

## 3.1. CREATE (Tambah Data Karyawan)

### Algoritma:
1. **User mengakses form create**
   - User klik tombol "Tambah Karyawan Baru" di halaman index
   - Route: `GET /karyawans/create`
   - Controller: `KaryawanController@create()`
   - Menampilkan view `karyawans.create`

2. **User mengisi form**
   - Input field: Nama (min 3 karakter)
   - Select: Pendidikan (S1, S2, S3)
   - Select: Divisi (12 pilihan divisi)

3. **User submit form**
   - Method: `POST /karyawans`
   - Route: `karyawans.store`
   - Controller: `KaryawanController@store()`

4. **Validasi input**
   ```
   - Nama: required, string, min:3, max:255
   - Pendidikan: required, in:S1,S2,S3
   - Divisi: required, in:Marketing,Produksi,SDM,IT,HRD,Finance,Operations,Quality Control,Research & Development,Legal,Procurement,Customer Service
   ```

5. **Jika validasi gagal**
   - Kembali ke form dengan error messages
   - Menampilkan error di setiap field yang invalid
   - Old input tetap tersimpan (old() helper)

6. **Jika validasi berhasil**
   - Simpan data ke database menggunakan `Karyawan::create($validated)`
   - Model menggunakan `$fillable = ['nama', 'pendidikan', 'divisi']`
   - Timestamps otomatis diisi (created_at, updated_at)

7. **Redirect dengan pesan sukses**
   - Redirect ke `karyawans.index`
   - Flash message: "Data karyawan berhasil ditambahkan!"

### Flowchart:
```
START
  ↓
User klik "Tambah Karyawan"
  ↓
Tampilkan form create
  ↓
User isi form → Submit
  ↓
Validasi input
  ↓
[Valid?]
  ├─ NO → Tampilkan error → Kembali ke form
  └─ YES → Simpan ke database
            ↓
         Redirect ke index dengan pesan sukses
            ↓
         END
```

---

## 3.2. READ (Baca Data Karyawan)

### Algoritma:

#### A. Index (Daftar Karyawan)

1. **User mengakses halaman index**
   - Route: `GET /karyawans`
   - Controller: `KaryawanController@index()`

2. **Membuat query builder**
   ```php
   $query = Karyawan::query();
   ```

3. **Filter berdasarkan search (nama)**
   ```
   IF request memiliki parameter 'search' AND search tidak kosong:
       query->where('nama', 'like', '%' . search . '%')
   ```
   - Pencarian menggunakan LIKE dengan wildcard (%)
   - Case-insensitive (default MySQL)

4. **Filter berdasarkan divisi**
   ```
   IF request memiliki parameter 'divisi' AND divisi tidak kosong:
       query->where('divisi', divisi)
   ```

5. **Filter berdasarkan pendidikan**
   ```
   IF request memiliki parameter 'pendidikan' AND pendidikan tidak kosong:
       query->where('pendidikan', pendidikan)
   ```

6. **Sorting data**
   ```
   - Default: sort_by = 'id', sort_direction = 'asc'
   - Validasi kolom yang bisa di-sort: id, created_at, pendidikan, divisi
   - Validasi direction: asc atau desc
   - query->orderBy(sort_by, sort_direction)
   ```

7. **Pagination**
   ```
   - Default: per_page = 10
   - Opsi: 5, 10, atau 50 baris per halaman
   - Validasi per_page hanya boleh 5, 10, atau 50
   - query->paginate(per_page)
   - appends() untuk mempertahankan query parameters
   ```

8. **Menampilkan data**
   - Pass data ke view: `compact('karyawans', 'sortBy', 'sortDirection', 'perPage')`
   - View menampilkan tabel dengan data karyawan
   - Menampilkan pagination links

#### B. Show (Detail Karyawan)

1. **User klik tombol "Lihat"**
   - Route: `GET /karyawans/{id}`
   - Controller: `KaryawanController@show($id)`

2. **Mencari data karyawan**
   ```php
   $karyawan = Karyawan::findOrFail($id);
   ```
   - `findOrFail()` akan return 404 jika data tidak ditemukan

3. **Menampilkan detail**
   - Pass data ke view: `compact('karyawan')`
   - View menampilkan informasi lengkap karyawan

### Flowchart Index:
```
START
  ↓
User akses /karyawans
  ↓
Buat query builder
  ↓
[Ada filter search?]
  ├─ YES → Tambahkan where nama like '%search%'
  └─ NO
  ↓
[Ada filter divisi?]
  ├─ YES → Tambahkan where divisi = divisi
  └─ NO
  ↓
[Ada filter pendidikan?]
  ├─ YES → Tambahkan where pendidikan = pendidikan
  └─ NO
  ↓
Apply sorting
  ↓
Apply pagination (5/10/50)
  ↓
Tampilkan data di view
  ↓
END
```

---

## 3.3. UPDATE (Edit Data Karyawan)

### Algoritma:

1. **User mengakses form edit**
   - User klik tombol "Edit" di halaman index atau show
   - Route: `GET /karyawans/{id}/edit`
   - Controller: `KaryawanController@edit($id)`

2. **Mencari data karyawan**
   ```php
   $karyawan = Karyawan::findOrFail($id);
   ```
   - Jika tidak ditemukan, return 404

3. **Menampilkan form dengan data terisi**
   - Pass data ke view: `compact('karyawan')`
   - Form field diisi dengan `old('field', $karyawan->field)`
   - Old input untuk mempertahankan data jika validasi gagal

4. **User edit form dan submit**
   - Method: `PUT /karyawans/{id}`
   - Route: `karyawans.update`
   - Controller: `KaryawanController@update($id)`

5. **Mencari data karyawan lagi**
   ```php
   $karyawan = Karyawan::findOrFail($id);
   ```

6. **Validasi input**
   - Sama seperti validasi pada CREATE
   - Nama: required, string, min:3, max:255
   - Pendidikan: required, in:S1,S2,S3
   - Divisi: required, in:...

7. **Jika validasi gagal**
   - Kembali ke form edit dengan error messages
   - Old input tetap tersimpan

8. **Jika validasi berhasil**
   - Update data menggunakan `$karyawan->update($validated)`
   - Hanya field yang ada di `$fillable` yang bisa di-update
   - `updated_at` otomatis diupdate

9. **Redirect dengan pesan sukses**
   - Redirect ke `karyawans.index`
   - Flash message: "Data karyawan berhasil diperbarui!"

### Flowchart:
```
START
  ↓
User klik "Edit"
  ↓
Tampilkan form edit dengan data terisi
  ↓
User edit form → Submit
  ↓
Validasi input
  ↓
[Valid?]
  ├─ NO → Tampilkan error → Kembali ke form edit
  └─ YES → Update data di database
            ↓
         Redirect ke index dengan pesan sukses
            ↓
         END
```

---

## 3.4. DELETE (Hapus Data Karyawan)

### Algoritma:

1. **User klik tombol "Hapus"**
   - Route: `DELETE /karyawans/{id}`
   - Controller: `KaryawanController@destroy($id)`

2. **Konfirmasi penghapusan**
   - JavaScript confirm dialog muncul
   - Pesan: "Yakin ingin menghapus karyawan ini?"
   - Jika user klik "Cancel", proses dibatalkan

3. **Mencari data karyawan**
   ```php
   $karyawan = Karyawan::findOrFail($id);
   ```
   - Jika tidak ditemukan, return 404

4. **Menyimpan nama untuk pesan sukses**
   ```php
   $nama = $karyawan->nama;
   ```

5. **Menghapus data**
   ```php
   $karyawan->delete();
   ```
   - Hard delete (data benar-benar dihapus dari database)
   - Tidak ada soft delete (tidak ada kolom deleted_at)

6. **Redirect dengan pesan sukses**
   - Redirect ke `karyawans.index`
   - Flash message: "Karyawan {nama} berhasil dihapus!"

### Flowchart:
```
START
  ↓
User klik "Hapus"
  ↓
Konfirmasi dialog muncul
  ↓
[User konfirmasi?]
  ├─ NO → Batal → END
  └─ YES → Cari data karyawan
            ↓
         Simpan nama
            ↓
         Hapus data dari database
            ↓
         Redirect ke index dengan pesan sukses
            ↓
         END
```

---

## 4.1. SEARCH (Pencarian Data Karyawan)

### Algoritma:

1. **User memasukkan keyword di form search**
   - Input field: "Cari nama karyawan..."
   - Method: GET
   - Parameter: `search`

2. **Form submit ke halaman index**
   - Route: `GET /karyawans?search={keyword}`
   - Controller: `KaryawanController@index()`

3. **Cek parameter search**
   ```php
   if ($request->has('search') && $request->search != '') {
       $query->where('nama', 'like', '%' . $request->search . '%');
   }
   ```

4. **Query menggunakan LIKE dengan wildcard**
   - `%keyword%` = mencari di awal, tengah, atau akhir nama
   - Case-insensitive (default MySQL)
   - Contoh: search "john" akan menemukan "John Doe", "Johnny", "ajohn"

5. **Kombinasi dengan filter lain**
   - Search bisa dikombinasikan dengan filter divisi dan pendidikan
   - Query akan menggunakan AND untuk semua filter

6. **Hasil pencarian**
   - Data yang cocok ditampilkan di tabel
   - Pagination tetap berfungsi
   - Query parameter search tetap dipertahankan di pagination links

### Flowchart:
```
START
  ↓
User input keyword di form search
  ↓
Submit form (GET)
  ↓
Controller menerima parameter search
  ↓
[Search tidak kosong?]
  ├─ NO → Tampilkan semua data
  └─ YES → Tambahkan where nama like '%keyword%'
            ↓
         Eksekusi query dengan filter lain
            ↓
         Tampilkan hasil pencarian
            ↓
         END
```

---

## 4.2. PAGINATION (Pembagian Data per Halaman)

### Algoritma:

1. **User memilih jumlah data per halaman**
   - Dropdown: 5, 10, atau 50 baris per halaman
   - Parameter: `per_page`
   - Default: 10

2. **Validasi per_page**
   ```php
   $perPage = $request->get('per_page', 10);
   if (!in_array($perPage, [5, 10, 50])) {
       $perPage = 10; // Default jika invalid
   }
   ```

3. **Apply pagination**
   ```php
   $karyawans = $query->paginate($perPage)->appends($request->except('page'));
   ```
   - `paginate($perPage)` membagi data menjadi beberapa halaman
   - `appends()` mempertahankan query parameters (search, filter, sorting)

4. **Menampilkan informasi pagination**
   - Menampilkan: "Menampilkan X - Y dari Z data"
   - `$karyawans->firstItem()` = nomor record pertama di halaman ini
   - `$karyawans->lastItem()` = nomor record terakhir di halaman ini
   - `$karyawans->total()` = total semua data

5. **Pagination links**
   - Laravel otomatis generate pagination links
   - Link Previous, Next, dan nomor halaman
   - Query parameters tetap dipertahankan

6. **Dropdown per_page di view**
   ```html
   <select onchange="window.location.href='...&per_page='+this.value">
       <option value="5">5</option>
       <option value="10">10</option>
       <option value="50">50</option>
   </select>
   ```

### Flowchart:
```
START
  ↓
User pilih per_page (5/10/50)
  ↓
Validasi per_page
  ↓
[Valid?]
  ├─ NO → Set default = 10
  └─ YES → Gunakan nilai yang dipilih
  ↓
Apply paginate(per_page)
  ↓
Tampilkan data sesuai halaman
  ↓
Tampilkan pagination links
  ↓
END
```

---

## Ringkasan Algoritma

### CREATE:
1. Tampilkan form → 2. Validasi → 3. Simpan → 4. Redirect

### READ:
1. Filter → 2. Sort → 3. Paginate → 4. Tampilkan

### UPDATE:
1. Tampilkan form dengan data → 2. Validasi → 3. Update → 4. Redirect

### DELETE:
1. Konfirmasi → 2. Hapus → 3. Redirect

### SEARCH:
1. Input keyword → 2. Query LIKE → 3. Tampilkan hasil

### PAGINATION:
1. Pilih per_page → 2. Validasi → 3. Paginate → 4. Tampilkan

