<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Karyawan | Sistem Karyawan</title>
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
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-4">
                    <a href="{{ route('karyawans.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Detail Karyawan</h1>
                        <p class="text-gray-600 text-sm">Informasi lengkap karyawan</p>
                    </div>
                </div>
                <a href="{{ route('karyawans.edit', $karyawan->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-pencil-alt"></i> Edit
                </a>
            </div>

            <!-- Main Info Card -->
            <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                <div class="bg-blue-600 text-white px-6 py-4">
                    <h5 class="text-lg font-semibold">
                        <i class="fas fa-user-circle mr-2"></i>{{ $karyawan->nama }}
                    </h5>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-xs text-gray-500 uppercase mb-1 block">ID Karyawan</label>
                            <div class="text-lg font-bold text-gray-900">#{{ $karyawan->id }}</div>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase mb-1 block">Nama Lengkap</label>
                            <div class="text-lg font-bold text-gray-900">{{ $karyawan->nama }}</div>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase mb-1 block">Pendidikan Terakhir</label>
                            <div>
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">{{ $karyawan->pendidikan }}</span>
                            </div>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase mb-1 block">Divisi</label>
                            <div>
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">{{ $karyawan->divisi }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timestamp Info Card -->
            <div class="bg-white rounded-lg shadow-md mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-sm font-semibold text-gray-800">
                        <i class="fas fa-clock mr-2"></i>Informasi Waktu
                    </h6>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-xs text-gray-500 uppercase mb-1 block">Tanggal Dibuat</label>
                            <div class="font-semibold text-gray-900">
                                {{ $karyawan->created_at->format('d F Y') }}
                                <span class="text-gray-500 text-sm">({{ $karyawan->created_at->format('H:i') }})</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">{{ $karyawan->created_at->diffForHumans() }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase mb-1 block">Terakhir Diupdate</label>
                            <div class="font-semibold text-gray-900">
                                {{ $karyawan->updated_at->format('d F Y') }}
                                <span class="text-gray-500 text-sm">({{ $karyawan->updated_at->format('H:i') }})</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">{{ $karyawan->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h6 class="font-semibold text-gray-800 mb-4">Tindakan</h6>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('karyawans.edit', $karyawan->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i>Edit Data
                    </a>
                    <a href="{{ route('karyawans.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors">
                        <i class="fas fa-list mr-2"></i>Lihat Daftar Karyawan
                    </a>
                    <form action="{{ route('karyawans.destroy', $karyawan->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus karyawan {{ $karyawan->nama }}? Tindakan ini tidak dapat dibatalkan!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                            <i class="fas fa-trash mr-2"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>

            <!-- Additional Info Card -->
            <div class="bg-gray-50 rounded-lg shadow-md p-6">
                <h6 class="font-semibold text-gray-800 mb-3">Informasi</h6>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• Data karyawan dapat diubah kapan saja melalui tombol <strong>Edit</strong></li>
                    <li>• Untuk melihat daftar semua karyawan, klik tombol <strong>Lihat Daftar Karyawan</strong></li>
                    <li>• Penghapusan data karyawan bersifat permanen dan tidak dapat dibatalkan</li>
                </ul>
            </div>
        </div>
    </main>

    <footer class="bg-gray-100 border-t border-gray-200 py-4 mt-auto">
        <div class="container mx-auto px-4 text-center text-gray-600 text-sm">
            <small>&copy; {{ date('Y') }} Sistem Karyawan</small>
        </div>
    </footer>

    <!-- Success Toast -->
    @if (session('success'))
        <div id="toast" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
                <button onclick="document.getElementById('toast').remove()" class="ml-4 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast');
                if (toast) toast.remove();
            }, 3000);
        </script>
    @endif
</body>
</html>
