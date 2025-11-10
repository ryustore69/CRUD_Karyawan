<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar karyawan dengan fitur search dan pagination
     */
    public function index(Request $request)
    {
        $query = Karyawan::query();

        // Filter berdasarkan search (nama)
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan divisi
        if ($request->has('divisi') && $request->divisi != '') {
            $query->where('divisi', $request->divisi);
        }

        // Filter berdasarkan pendidikan
        if ($request->has('pendidikan') && $request->pendidikan != '') {
            $query->where('pendidikan', $request->pendidikan);
        }

        // Sorting - default berdasarkan ID ascending
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        
        // Validasi kolom yang bisa di-sort
        $allowedSortColumns = ['id', 'created_at', 'pendidikan', 'divisi'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'id';
        }
        
        // Validasi direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        // Pagination - dengan opsi 5, 10, atau 50 data per halaman
        $perPage = $request->get('per_page', 10); // Default 10
        // Validasi per_page hanya boleh 5, 10, atau 50
        if (!in_array($perPage, [5, 10, 50])) {
            $perPage = 10;
        }
        
        $karyawans = $query->orderBy($sortBy, $sortDirection)->paginate($perPage)->appends($request->except('page'));

        return view('karyawans.index', compact('karyawans', 'sortBy', 'sortDirection', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk membuat karyawan baru
     */
    public function create()
    {
        return view('karyawans.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan karyawan baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|min:3|max:255',
            'pendidikan' => 'required|in:S1,S2,S3',
            'divisi' => 'required|in:Marketing,Produksi,SDM,IT,HRD,Finance,Operations,Quality Control,Research & Development,Legal,Procurement,Customer Service',
        ], [
            'nama.required' => 'Nama karyawan wajib diisi',
            'nama.min' => 'Nama karyawan minimal 3 karakter',
            'nama.max' => 'Nama karyawan maksimal 255 karakter',
            'pendidikan.required' => 'Pendidikan wajib dipilih',
            'pendidikan.in' => 'Pendidikan tidak valid. Pilih S1, S2, atau S3',
            'divisi.required' => 'Divisi wajib dipilih',
            'divisi.in' => 'Divisi tidak valid',
        ]);

        // Simpan data karyawan
        Karyawan::create($validated);

        return redirect()->route('karyawans.index')
            ->with('success', 'Data karyawan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail karyawan berdasarkan id
     */
    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawans.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form untuk edit karyawan
     */
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawans.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     * Memperbarui data karyawan di database
     */
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|min:3|max:255',
            'pendidikan' => 'required|in:S1,S2,S3',
            'divisi' => 'required|in:Marketing,Produksi,SDM,IT,HRD,Finance,Operations,Quality Control,Research & Development,Legal,Procurement,Customer Service',
        ], [
            'nama.required' => 'Nama karyawan wajib diisi',
            'nama.min' => 'Nama karyawan minimal 3 karakter',
            'nama.max' => 'Nama karyawan maksimal 255 karakter',
            'pendidikan.required' => 'Pendidikan wajib dipilih',
            'pendidikan.in' => 'Pendidikan tidak valid. Pilih S1, S2, atau S3',
            'divisi.required' => 'Divisi wajib dipilih',
            'divisi.in' => 'Divisi tidak valid',
        ]);

        // Update data karyawan
        $karyawan->update($validated);

        return redirect()->route('karyawans.index')
            ->with('success', 'Data karyawan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus karyawan dari database
     */
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $nama = $karyawan->nama;
        $karyawan->delete();

        return redirect()->route('karyawans.index')
            ->with('success', "Karyawan $nama berhasil dihapus!");
    }
}
