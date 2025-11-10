<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Karyawan - Laravel CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-gray-800 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ url('/') }}" class="text-xl font-bold">
                    <i class="fas fa-users mr-2"></i>Sistem Karyawan
                </a>
                <div class="flex items-center space-x-4">
                    <a href="{{ url('/') }}" class="text-blue-400 font-semibold">Beranda</a>
                    <a href="{{ route('karyawans.index') }}" class="hover:text-gray-300">Karyawan</a>
                    <a href="{{ route('karyawans.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                        <i class="fas fa-plus mr-1"></i>Tambah Karyawan
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-purple-600 to-purple-800 text-white py-20 flex-grow">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-5xl font-bold mb-6">
                        Kelola Data Karyawan
                        <span class="text-white">Dengan Mudah</span>
                    </h1>
                    <p class="text-xl mb-8 text-purple-100">
                        Sistem manajemen karyawan yang sederhana dan powerful, dibangun dengan Laravel 12.
                        Kelola data karyawan dengan operasi CRUD (Create, Read, Update, Delete) secara efisien.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('karyawans.index') }}" class="bg-white text-purple-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold">
                            <i class="fas fa-list mr-2"></i>Lihat Daftar Karyawan
                        </a>
                        <a href="{{ route('karyawans.create') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-purple-600 px-6 py-3 rounded-lg font-semibold">
                            <i class="fas fa-user-plus mr-2"></i>Tambah Karyawan Baru
                        </a>
                    </div>
                </div>
                <div class="text-center">
                    <i class="fas fa-users-cog text-9xl opacity-75"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-3">Fitur Utama Sistem</h2>
                <p class="text-gray-600">Kelola data karyawan dengan fitur-fitur lengkap</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-plus text-5xl text-blue-600 mb-4 hover:scale-110 transition-transform"></i>
                    </div>
                    <h5 class="font-bold text-lg mb-3 text-center">Tambah Karyawan</h5>
                    <p class="text-gray-600 text-center">
                        Tambahkan data karyawan baru dengan mudah melalui formulir yang user-friendly.
                        Data karyawan meliputi nama, pendidikan, dan divisi.
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="text-center mb-4">
                        <i class="fas fa-search text-5xl text-blue-500 mb-4 hover:scale-110 transition-transform"></i>
                    </div>
                    <h5 class="font-bold text-lg mb-3 text-center">Pencarian & Filter</h5>
                    <p class="text-gray-600 text-center">
                        Cari karyawan berdasarkan nama, filter berdasarkan divisi dan pendidikan.
                        Sistem pencarian yang cepat dan akurat.
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="text-center mb-4">
                        <i class="fas fa-edit text-5xl text-green-600 mb-4 hover:scale-110 transition-transform"></i>
                    </div>
                    <h5 class="font-bold text-lg mb-3 text-center">Update Data</h5>
                    <p class="text-gray-600 text-center">
                        Perbarui informasi karyawan dengan mudah. Data dapat diubah kapan saja
                        melalui formulir edit yang intuitif.
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="text-center mb-4">
                        <i class="fas fa-eye text-5xl text-yellow-600 mb-4 hover:scale-110 transition-transform"></i>
                    </div>
                    <h5 class="font-bold text-lg mb-3 text-center">Detail Karyawan</h5>
                    <p class="text-gray-600 text-center">
                        Lihat informasi lengkap setiap karyawan termasuk tanggal pembuatan
                        dan pembaruan terakhir data.
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="text-center mb-4">
                        <i class="fas fa-sort text-5xl text-gray-600 mb-4 hover:scale-110 transition-transform"></i>
                    </div>
                    <h5 class="font-bold text-lg mb-3 text-center">Sorting Data</h5>
                    <p class="text-gray-600 text-center">
                        Urutkan data karyawan berdasarkan ID, pendidikan, divisi, atau tanggal.
                        Sort ascending atau descending sesuai kebutuhan.
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="text-center mb-4">
                        <i class="fas fa-trash-alt text-5xl text-red-600 mb-4 hover:scale-110 transition-transform"></i>
                    </div>
                    <h5 class="font-bold text-lg mb-3 text-center">Hapus Data</h5>
                    <p class="text-gray-600 text-center">
                        Hapus data karyawan dengan konfirmasi untuk mencegah kesalahan.
                        Sistem keamanan yang terjamin.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-gray-50 rounded-lg p-8 text-center">
                    <i class="fas fa-user-graduate text-5xl text-blue-600 mb-4"></i>
                    <p class="text-gray-600">Pendidikan: S1, S2, S3</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-8 text-center">
                    <i class="fas fa-building text-5xl text-green-600 mb-4"></i>
                    <p class="text-gray-600">12 Divisi Tersedia</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-8 text-center">
                    <i class="fas fa-shield-alt text-5xl text-blue-500 mb-4"></i>
                    <p class="text-gray-600">Validasi Data</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-8 text-center">
                    <i class="fas fa-file-alt text-5xl text-yellow-600 mb-4"></i>
                    <p class="text-gray-600">Pagination</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Siap Memulai?</h2>
            <p class="text-xl mb-8 text-blue-100">Mulai kelola data karyawan Anda hari ini dengan sistem yang sederhana, cepat, dan aman.</p>
            <div class="flex justify-center gap-4 flex-wrap">
                <a href="{{ route('karyawans.create') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold">
                    <i class="fas fa-user-plus mr-2"></i>Tambah Karyawan Pertama
                </a>
                <a href="{{ route('karyawans.index') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-lg font-semibold">
                    <i class="fas fa-list mr-2"></i>Lihat Daftar Karyawan
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="mb-2 md:mb-0">&copy; {{ date('Y') }} Sistem Manajemen Karyawan. Dibangun dengan Laravel 12.</p>
                <small class="text-gray-400">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} | PHP v{{ PHP_VERSION }}
                </small>
            </div>
        </div>
    </footer>
</body>
</html>
