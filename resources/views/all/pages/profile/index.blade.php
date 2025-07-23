@extends('all.layout.index')

@section('title', 'Profile Pengguna')
@section('landing')
    <style>
        .form-input {
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>

<!-- Hero Section -->
{{-- <section class="bg-blue1 py-12 mt-20">
    <div class="px-4 sm:px-6 lg:px-28">

        
        <!-- Title -->
        <div class="text-center">
            <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Profile Pengguna
            </h1>
        </div>
    </div>
</section> --}}

<section class="px-4 sm:px-6 mt-20 lg:px-28 py-10 bg-gray-50">
    <div class="max-w-6xl mx-auto">
                <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm mb-6 text-blue1">
            <a href="/" class="hover:text-black transition-colors">
                <i class="fas fa-home mr-1"></i>
                Beranda
            </a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-blue1 font-medium">Profile</span>
        </nav>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover animate-fadeInUp">
                    <!-- Profile Picture -->
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">{{ Auth::user()->nama ?? 'User' }}</h3>
                        <p class="text-gray-600">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                        <div class="mt-4">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                <i class="fas fa-check-circle mr-1"></i>
                                Aktif
                            </span>
                        </div>
                    </div>
                    
                    <!-- Navigation -->
                    <nav class="space-y-2">
                        <button onclick="showTab('profile')" id="profileTab" class="tab-btn w-full flex items-center px-4 py-3 text-left rounded-lg bg-blue-50 text-blue-600 font-medium transition-colors">
                            <i class="fas fa-user mr-3"></i>
                            Data Diri
                        </button>
                        <button onclick="showTab('donation')" id="donationTab" class="tab-btn w-full flex items-center px-4 py-3 text-left rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-heart mr-3"></i>
                            Riwayat Donasi
                        </button>
                        <button onclick="showTab('password')" id="passwordTab" class="tab-btn w-full flex items-center px-4 py-3 text-left rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-lock mr-3"></i>
                            Ubah Password
                        </button>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Profile Data Tab -->
                <div id="profileContent" class="tab-content bg-white rounded-2xl shadow-lg p-8 card-hover animate-fadeInUp">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2 flex items-center">
                            <i class="fas fa-user-edit mr-3 text-blue-500"></i>
                            Data Diri
                        </h2>
                        <p class="text-gray-600">Kelola informasi pribadi Anda</p>
                    </div>
                    
                    <form action="/profile/update" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-user text-blue-500 mr-2"></i>
                                    Nama Lengkap
                                </label>
                                <input type="text" name="nama" value="{{ Auth::user()->nama ?? '' }}" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan nama lengkap">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-envelope text-green-500 mr-2"></i>
                                    Email
                                </label>
                                <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan email">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-phone text-purple-500 mr-2"></i>
                                    Nomor Telepon
                                </label>
                                <input type="tel" name="no_telp" value="{{ Auth::user()->no_telp ?? '' }}" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Contoh: 08123456789">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                    Alamat
                                </label>
                                <input type="text" name="alamat" value="{{ Auth::user()->alamat ?? '' }}" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan alamat">
                            </div>
                        </div>
                        
                        <div class="pt-6">
                            <button type="submit" class="bg-blue1 hover:from-blue-700 hover:to-indigo-700 text-white py-3 px-8 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Donation History Tab -->
                <div id="donationContent" class="tab-content bg-white rounded-2xl shadow-lg p-8 card-hover animate-fadeInUp hidden">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2 flex items-center">
                            <i class="fas fa-heart mr-3 text-red-500"></i>
                            Riwayat Donasi
                        </h2>
                        <p class="text-gray-600">Lihat semua donasi yang pernah Anda berikan</p>
                    </div>
                    
                    <!-- Donation Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gradient-to-br from-green-50 to-emerald-100 border border-green-200 rounded-xl p-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-money-bill-wave text-white"></i>
                                </div>
                                <div>
                                    <p class="text-green-700 font-medium">Total Donasi Uang</p>
                                    <p class="text-2xl font-bold text-green-600">Rp 750.000</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-100 border border-blue-200 rounded-xl p-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-box text-white"></i>
                                </div>
                                <div>
                                    <p class="text-blue-700 font-medium">Total Donasi Barang</p>
                                    <p class="text-2xl font-bold text-blue-600">15 Item</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gradient-to-br from-purple-50 to-violet-100 border border-purple-200 rounded-xl p-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-hands-helping text-white"></i>
                                </div>
                                <div>
                                    <p class="text-purple-700 font-medium">Bencana Dibantu</p>
                                    <p class="text-2xl font-bold text-purple-600">8 Kasus</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Donation History Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 rounded-xl overflow-hidden">
                            <thead class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                                <tr>
                                    <th class="p-4 text-left">Tanggal</th>
                                    <th class="p-4 text-left">Bencana</th>
                                    <th class="p-4 text-left">Jenis Donasi</th>
                                    <th class="p-4 text-left">Jumlah</th>
                                    <th class="p-4 text-left">Status</th>
                                    <th class="p-4 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors">
                                    <td class="p-4">15 Des 2024</td>
                                    <td class="p-4">
                                        <div class="font-medium text-gray-800">Banjir Jember Selatan</div>
                                        <div class="text-sm text-gray-500">Jember, Jawa Timur</div>
                                    </td>
                                    <td class="p-4">
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-money-bill-wave mr-1"></i>
                                            Uang
                                        </span>
                                    </td>
                                    <td class="p-4 font-semibold text-green-600">Rp 250.000</td>
                                    <td class="p-4">
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Berhasil
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            <i class="fas fa-eye mr-1"></i>
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                                
                                <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors">
                                    <td class="p-4">10 Des 2024</td>
                                    <td class="p-4">
                                        <div class="font-medium text-gray-800">Longsor Gunung Semeru</div>
                                        <div class="text-sm text-gray-500">Malang, Jawa Timur</div>
                                    </td>
                                    <td class="p-4">
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-box mr-1"></i>
                                            Barang
                                        </span>
                                    </td>
                                    <td class="p-4 font-semibold text-blue-600">5 Selimut</td>
                                    <td class="p-4">
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Berhasil
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            <i class="fas fa-eye mr-1"></i>
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                                
                                <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors">
                                    <td class="p-4">5 Des 2024</td>
                                    <td class="p-4">
                                        <div class="font-medium text-gray-800">Gempa Bumi Lumajang</div>
                                        <div class="text-sm text-gray-500">Lumajang, Jawa Timur</div>
                                    </td>
                                    <td class="p-4">
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-money-bill-wave mr-1"></i>
                                            Uang
                                        </span>
                                    </td>
                                    <td class="p-4 font-semibold text-green-600">Rp 500.000</td>
                                    <td class="p-4">
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-clock mr-1"></i>
                                            Proses
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            <i class="fas fa-eye mr-1"></i>
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="flex justify-between items-center mt-6">
                        <div class="text-sm text-gray-500">
                            Menampilkan 1-3 dari 8 donasi
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-chevron-left mr-1"></i>
                                Sebelumnya
                            </button>
                            <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition-colors">
                                1
                            </button>
                            <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-colors">
                                2
                            </button>
                            <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition-colors">
                                Selanjutnya
                                <i class="fas fa-chevron-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Password Change Tab -->
                <div id="passwordContent" class="tab-content bg-white rounded-2xl shadow-lg p-8 card-hover animate-fadeInUp hidden">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2 flex items-center">
                            <i class="fas fa-shield-alt mr-3 text-green-500"></i>
                            Ubah Password
                        </h2>
                        <p class="text-gray-600">Pastikan akun Anda tetap aman dengan password yang kuat</p>
                    </div>
                    
                    <form action="/profile/change-password" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-lock text-gray-500 mr-2"></i>
                                Password Lama
                            </label>
                            <div class="relative">
                                <input type="password" name="current_password" id="currentPassword" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12" placeholder="Masukkan password lama">
                                <button type="button" onclick="togglePassword('currentPassword', this)" class="absolute right-4 top-4 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-key text-blue-500 mr-2"></i>
                                Password Baru
                            </label>
                            <div class="relative">
                                <input type="password" name="new_password" id="newPassword" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12" placeholder="Masukkan password baru">
                                <button type="button" onclick="togglePassword('newPassword', this)" class="absolute right-4 top-4 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="mt-2">
                                <div class="text-xs text-gray-500">
                                    Password harus minimal 8 karakter dan mengandung huruf & angka
                                </div>
                                <div id="passwordStrength" class="mt-1 h-1 bg-gray-200 rounded-full overflow-hidden">
                                    <div id="strengthBar" class="h-full transition-all duration-300"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                Konfirmasi Password Baru
                            </label>
                            <div class="relative">
                                <input type="password" name="new_password_confirmation" id="confirmPassword" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12" placeholder="Konfirmasi password baru">
                                <button type="button" onclick="togglePassword('confirmPassword', this)" class="absolute right-4 top-4 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div id="passwordMatch" class="mt-2 text-xs hidden">
                                <span class="text-red-500">
                                    <i class="fas fa-times mr-1"></i>
                                    Password tidak cocok
                                </span>
                            </div>
                        </div>
                        
                        <div class="pt-6">
                            <button type="submit" class="bg-blue1 hover:from-green-700 hover:to-green-800 text-white py-3 px-8 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Tab functionality
function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('bg-blue-50', 'text-blue-600');
        btn.classList.add('text-gray-600', 'hover:bg-gray-50');
    });
    
    // Show selected tab content
    document.getElementById(tabName + 'Content').classList.remove('hidden');
    
    // Add active class to selected tab button
    const activeTab = document.getElementById(tabName + 'Tab');
    activeTab.classList.add('bg-blue-50', 'text-blue-600');
    activeTab.classList.remove('text-gray-600', 'hover:bg-gray-50');
}

// Password visibility toggle
function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Password strength indicator
document.getElementById('newPassword').addEventListener('input', function(e) {
    const password = e.target.value;
    const strengthBar = document.getElementById('strengthBar');
    let strength = 0;
    
    if (password.length >= 8) strength += 25;
    if (/[a-z]/.test(password)) strength += 25;
    if (/[A-Z]/.test(password)) strength += 25;
    if (/[0-9]/.test(password)) strength += 25;
    
    strengthBar.style.width = strength + '%';
    
    if (strength < 50) {
        strengthBar.className = 'h-full bg-red-500 transition-all duration-300';
    } else if (strength < 75) {
        strengthBar.className = 'h-full bg-yellow-500 transition-all duration-300';
    } else {
        strengthBar.className = 'h-full bg-green-500 transition-all duration-300';
    }
});

// Password confirmation check
document.getElementById('confirmPassword').addEventListener('input', function(e) {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = e.target.value;
    const matchIndicator = document.getElementById('passwordMatch');
    
    if (confirmPassword && newPassword !== confirmPassword) {
        matchIndicator.classList.remove('hidden');
    } else {
        matchIndicator.classList.add('hidden');
    }
});

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    // Show success/error messages if any
    @if(session('success'))
        alert('{{ session('success') }}');
    @endif
    
    @if(session('error'))
        alert('{{ session('error') }}');
    @endif
});
</script>
@endsection
