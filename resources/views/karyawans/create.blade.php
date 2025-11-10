<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan | Sistem Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-gray-800 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('karyawans.index') }}" class="text-xl font-bold">Sistem Karyawan</a>
                <div class="flex space-x-4">
                    <a href="{{ url('/') }}" class="hover:text-gray-300">Beranda</a>
                    <a href="{{ route('karyawans.index') }}" class="text-blue-400 font-semibold">Karyawan</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow py-8">
        <div class="container mx-auto px-4 max-w-2xl">
            <!-- Header -->
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('karyawans.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Tambah Karyawan Baru</h1>
                    <p class="text-gray-600 text-sm">Isi form di bawah untuk menambah karyawan baru</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">Terjadi kesalahan!</p>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('karyawans.store') }}" method="POST">
                    @csrf

                    <!-- Nama Field -->
                    <div class="mb-6">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Karyawan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nama" 
                               name="nama" 
                               value="{{ old('nama') }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama') border-red-500 @enderror" 
                               placeholder="Masukkan nama lengkap karyawan" 
                               required 
                               autofocus>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Contoh: John Doe, Jane Smith</p>
                    </div>

                    <!-- Pendidikan Field -->
                    <div class="mb-6">
                        <label for="pendidikan" class="block text-sm font-medium text-gray-700 mb-2">
                            Pendidikan Terakhir <span class="text-red-500">*</span>
                        </label>
                        <select id="pendidikan" 
                                name="pendidikan" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('pendidikan') border-red-500 @enderror" 
                                required>
                            <option value="" disabled selected>-- Pilih Pendidikan --</option>
                            <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1 (Sarjana)</option>
                            <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2 (Magister)</option>
                            <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3 (Doktor)</option>
                        </select>
                        @error('pendidikan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Divisi Field -->
                    <div class="mb-6">
                        <label for="divisi" class="block text-sm font-medium text-gray-700 mb-2">
                            Divisi <span class="text-red-500">*</span>
                        </label>
                        <select id="divisi" 
                                name="divisi" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('divisi') border-red-500 @enderror" 
                                required>
                            <option value="" disabled selected>-- Pilih Divisi --</option>
                            <option value="Marketing" {{ old('divisi') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="Produksi" {{ old('divisi') == 'Produksi' ? 'selected' : '' }}>Produksi</option>
                            <option value="SDM" {{ old('divisi') == 'SDM' ? 'selected' : '' }}>SDM</option>
                            <option value="IT" {{ old('divisi') == 'IT' ? 'selected' : '' }}>IT (Information Technology)</option>
                            <option value="HRD" {{ old('divisi') == 'HRD' ? 'selected' : '' }}>HRD (Human Resources Development)</option>
                            <option value="Finance" {{ old('divisi') == 'Finance' ? 'selected' : '' }}>Finance</option>
                            <option value="Operations" {{ old('divisi') == 'Operations' ? 'selected' : '' }}>Operations</option>
                            <option value="Quality Control" {{ old('divisi') == 'Quality Control' ? 'selected' : '' }}>Quality Control</option>
                            <option value="Research & Development" {{ old('divisi') == 'Research & Development' ? 'selected' : '' }}>Research & Development</option>
                            <option value="Legal" {{ old('divisi') == 'Legal' ? 'selected' : '' }}>Legal</option>
                            <option value="Procurement" {{ old('divisi') == 'Procurement' ? 'selected' : '' }}>Procurement</option>
                            <option value="Customer Service" {{ old('divisi') == 'Customer Service' ? 'selected' : '' }}>Customer Service</option>
                        </select>
                        @error('divisi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                        <a href="{{ route('karyawans.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                            <i class="fas fa-check"></i> Simpan Karyawan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Card -->
            <div class="bg-gray-50 rounded-lg shadow-md p-6 mt-6">
                <h6 class="font-semibold text-gray-800 mb-3">Informasi</h6>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• Semua field yang bertanda <span class="text-red-500">*</span> wajib diisi</li>
                    <li>• Pastikan data yang dimasukkan sudah benar sebelum menyimpan</li>
                    <li>• Data karyawan dapat diubah kapan saja melalui menu edit</li>
                </ul>
            </div>
        </div>
    </main>

    <footer class="bg-gray-100 border-t border-gray-200 py-4 mt-auto">
        <div class="container mx-auto px-4 text-center text-gray-600 text-sm">
            <small>&copy; {{ date('Y') }} Sistem Karyawan</small>
        </div>
    </footer>
</body>
</html>
