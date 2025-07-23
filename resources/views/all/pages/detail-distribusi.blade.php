@extends('all.layout.index')

@section('title', 'Detail Distribusi Posko')
@section('landing')
<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
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
    
    .modal {
        backdrop-filter: blur(10px);
    }
</style>

<section class="px-4 sm:px-6 lg:px-36 mt-20 py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto">
             <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm mb-6 text-blue1">
            <a href="/" class="hover:text-blue1 transition-colors">
                <i class="fas fa-home mr-1"></i>
                Beranda
            </a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="/#donasi" class="hover:text-blue1 transition-colors">
                Donasi
            </a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-blue1 font-medium">Detail Distribusi</span>
        </nav>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Posko Information -->
                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover animate-fadeInUp">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-blue1 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-warehouse text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Posko Bantuan</h3>
                        <p class="text-gray-600">{{ $posko->nama_posko ?? 'Posko Darurat' }}</p>
                    </div>
                    
                    <!-- Posko Stats -->
                    <div class="space-y-4">
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-box text-white"></i>
                                </div>
                                <div>
                                    <p class="text-green-700 font-medium text-sm">Total Barang</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $distribusi->sum('jumlah') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-list text-white"></i>
                                </div>
                                <div>
                                    <p class="text-blue-700 font-medium text-sm">Jenis Barang</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ $distribusi->count() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-purple-50 border border-purple-200 rounded-xl p-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar text-white"></i>
                                </div>
                                <div>
                                    <p class="text-purple-700 font-medium text-sm">Terakhir Update</p>
                                    <p class="text-sm font-bold text-purple-600">{{ $distribusi->max('tanggal') ? \Carbon\Carbon::parse($distribusi->max('tanggal'))->format('d M Y') : 'Belum ada' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Location Map -->
                <div class="bg-white rounded-2xl shadow-lg p-6 card-hover animate-fadeInUp">
                    <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                        Lokasi Posko
                    </h4>
                    <div id="map" class="h-48 rounded-xl border-2 border-gray-200"></div>
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-map-pin mr-2 text-blue-500"></i>
                            <span>{{ $posko->alamat ?? 'Alamat belum tersedia' }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-phone mr-2 text-green-500"></i>
                            <span>{{ $posko->kontak ?? 'Kontak belum tersedia' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Distribution Table -->
                <div class="bg-white rounded-2xl shadow-lg p-8 card-hover animate-fadeInUp">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2 flex items-center">
                            <i class="fas fa-clipboard-list mr-3 text-blue-500"></i>
                            Data Distribusi Bantuan
                        </h2>
                        <p class="text-gray-600">Daftar barang yang telah didistribusikan di posko ini</p>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 rounded-xl overflow-hidden">
                            <thead class="bg-blue1 text-white">
                                <tr>
                                    <th class="p-4 text-left font-semibold">No</th>
                                    <th class="p-4 text-left font-semibold">Nama Kebutuhan</th>
                                    <th class="p-4 text-left font-semibold">Jumlah</th>
                                    <th class="p-4 text-left font-semibold">Tanggal</th>
                                    <th class="p-4 text-left font-semibold">Dokumentasi</th>
                                    <th class="p-4 text-left font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($distribusi as $key => $k)
                                <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors">
                                    <td class="p-4 font-medium">{{ $loop->iteration }}</td>
                                    <td class="p-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-box text-blue-600"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-800">{{ $k->nama_kebutuhan }}</div>
                                                <div class="text-sm text-gray-500">Bantuan kemanusiaan</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <span class=" text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $k->jumlah }} Unit
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <div class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($k->tanggal)->format('d M Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($k->tanggal)->format('H:i') }} WIB</div>
                                    </td>
                                    <td class="p-4">
                                        <button onclick="showImage('{{ asset('uploads/distribusi/' . $k->foto_keterangan) }}', '{{ $k->nama_kebutuhan }}')" class="group relative">
                                            <img src="{{ asset('uploads/distribusi/' . $k->foto_keterangan) }}" 
                                                 alt="Dokumentasi" 
                                                 class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200 group-hover:border-blue-400 transition-colors cursor-pointer">
                                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-lg transition-all flex items-center justify-center">
                                                <i class="fas fa-search-plus text-white opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                            </div>
                                        </button>
                                    </td>
                                    <td class="p-4">
                                        <span class=" text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                         
                                            Terdistribusi
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if($distribusi->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-box-open text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Data Distribusi</h3>
                        <p class="text-gray-600">Data distribusi barang akan muncul di sini setelah ada aktivitas distribusi.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 modal z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modalTitle" class="text-xl font-bold text-gray-800"></h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="text-center">
                <img id="modalImage" src="" alt="" class="max-w-full h-auto rounded-xl shadow-lg">
            </div>
        </div>
    </div>
</div>

<script>
// Initialize map
var map = L.map('map').setView([{{ $posko->latitude ?? -8.184486 }}, {{ $posko->longitude ?? 113.668076 }}], 15);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Add marker for posko location
L.marker([{{ $posko->latitude ?? -8.184486 }}, {{ $posko->longitude ?? 113.668076 }}], {
    icon: L.divIcon({
        className: 'custom-marker',
        html: '<div style="background-color: #3b82f6; width: 24px; height: 24px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.3);"></div>',
        iconSize: [24, 24],
        iconAnchor: [12, 12]
    })
}).addTo(map)
    .bindPopup("<b>{{ $posko->nama_posko ?? 'Posko Bantuan' }}</b>").openPopup();

// Image modal functions
function showImage(src, title) {
    document.getElementById('modalImage').src = src;
    document.getElementById('modalTitle').textContent = 'Dokumentasi: ' + title;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target.id === 'imageModal') {
        closeModal();
    }
});

// Animate elements on scroll
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fadeInUp');
            }
        });
    });

    document.querySelectorAll('.card-hover').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endsection