<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan | Sistem Karyawan</title>
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
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Daftar Karyawan</h1>
                    <p class="text-gray-600 text-sm">Kelola data karyawan perusahaan</p>
                </div>
                <a href="{{ route('karyawans.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="fas fa-plus"></i> Tambah Karyawan Baru
                </a>
            </div>

            <!-- Search & Filter Form -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <form action="{{ route('karyawans.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div class="md:col-span-2">
                        <input type="text" name="search" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               placeholder="Cari nama karyawan..." value="{{ request('search') }}">
                    </div>
                    <div>
                        <select name="divisi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Divisi</option>
                            <option value="Marketing" {{ request('divisi') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="Produksi" {{ request('divisi') == 'Produksi' ? 'selected' : '' }}>Produksi</option>
                            <option value="SDM" {{ request('divisi') == 'SDM' ? 'selected' : '' }}>SDM</option>
                            <option value="IT" {{ request('divisi') == 'IT' ? 'selected' : '' }}>IT</option>
                            <option value="HRD" {{ request('divisi') == 'HRD' ? 'selected' : '' }}>HRD</option>
                            <option value="Finance" {{ request('divisi') == 'Finance' ? 'selected' : '' }}>Finance</option>
                            <option value="Operations" {{ request('divisi') == 'Operations' ? 'selected' : '' }}>Operations</option>
                            <option value="Quality Control" {{ request('divisi') == 'Quality Control' ? 'selected' : '' }}>Quality Control</option>
                            <option value="Research & Development" {{ request('divisi') == 'Research & Development' ? 'selected' : '' }}>Research & Development</option>
                            <option value="Legal" {{ request('divisi') == 'Legal' ? 'selected' : '' }}>Legal</option>
                            <option value="Procurement" {{ request('divisi') == 'Procurement' ? 'selected' : '' }}>Procurement</option>
                            <option value="Customer Service" {{ request('divisi') == 'Customer Service' ? 'selected' : '' }}>Customer Service</option>
                        </select>
                    </div>
                    <div>
                        <select name="pendidikan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Pendidikan</option>
                            <option value="S1" {{ request('pendidikan') == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ request('pendidikan') == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ request('pendidikan') == 'S3' ? 'selected' : '' }}>S3</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Cari</button>
                    </div>
                </form>
            </div>

            <!-- Statistics Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="text-gray-600 text-sm mb-2">Total Karyawan</div>
                <div class="text-3xl font-bold text-gray-800">{{ $karyawans->total() }}</div>
            </div>

            <!-- Pagination Options -->
            <div class="bg-white rounded-lg shadow-md p-4 mb-6 flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    Menampilkan {{ $karyawans->firstItem() ?? 0 }} - {{ $karyawans->lastItem() ?? 0 }} dari {{ $karyawans->total() }} data
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-600">Tampilkan:</span>
                    <select name="per_page" onchange="updatePerPage(this.value)" class="px-3 py-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <span class="text-sm text-gray-600">baris per halaman</span>
                </div>
            </div>

            <script>
                function updatePerPage(value) {
                    const url = new URL(window.location.href);
                    url.searchParams.set('per_page', value);
                    url.searchParams.delete('page'); // Reset ke halaman pertama
                    window.location.href = url.toString();
                }
            </script>

            <!-- Data Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($karyawans->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ route('karyawans.index', array_merge(request()->except(['sort_by', 'sort_direction']), ['sort_by' => 'id', 'sort_direction' => ($sortBy == 'id' && $sortDirection == 'asc') ? 'desc' : 'asc'])) }}" 
                                           class="hover:text-blue-600 cursor-pointer">
                                            ID 
                                            @if($sortBy == 'id')
                                                <span class="text-blue-600">{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ route('karyawans.index', array_merge(request()->except(['sort_by', 'sort_direction']), ['sort_by' => 'pendidikan', 'sort_direction' => ($sortBy == 'pendidikan' && $sortDirection == 'asc') ? 'desc' : 'asc'])) }}" 
                                           class="hover:text-blue-600 cursor-pointer">
                                            Pendidikan 
                                            @if($sortBy == 'pendidikan')
                                                <span class="text-blue-600">{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ route('karyawans.index', array_merge(request()->except(['sort_by', 'sort_direction']), ['sort_by' => 'divisi', 'sort_direction' => ($sortBy == 'divisi' && $sortDirection == 'asc') ? 'desc' : 'asc'])) }}" 
                                           class="hover:text-blue-600 cursor-pointer">
                                            Divisi 
                                            @if($sortBy == 'divisi')
                                                <span class="text-blue-600">{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ route('karyawans.index', array_merge(request()->except(['sort_by', 'sort_direction']), ['sort_by' => 'created_at', 'sort_direction' => ($sortBy == 'created_at' && $sortDirection == 'asc') ? 'desc' : 'asc'])) }}" 
                                           class="hover:text-blue-600 cursor-pointer">
                                            Tanggal Dibuat 
                                            @if($sortBy == 'created_at')
                                                <span class="text-blue-600">{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($karyawans as $karyawan)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $karyawan->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $karyawan->nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $karyawan->pendidikan }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ $karyawan->divisi }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $karyawan->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('karyawans.show', $karyawan->id) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-200 transition-colors">
                                                    <i class="fas fa-eye mr-1"></i> Lihat
                                                </a>
                                                <a href="{{ route('karyawans.edit', $karyawan->id) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-indigo-700 bg-indigo-100 rounded-lg hover:bg-indigo-200 transition-colors">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                                <form action="{{ route('karyawans.destroy', $karyawan->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus karyawan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                                                        <i class="fas fa-trash mr-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $karyawans->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-600 mb-4">Tidak ada data karyawan ditemukan.</p>
                        <a href="{{ route('karyawans.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Tambah Karyawan Pertama</a>
                    </div>
                @endif
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
