@extends('all.layout.index')

@section('title', 'Pelaporan Bencana')
@section('landing')
<style>
    .form-input {
        transition: all 0.3s ease;
    }
    
    .form-input:focus {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .upload-area {
        transition: all 0.3s ease;
    }
    
    .upload-area:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
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

<section class="px-4 sm:px-6 lg:px-20 py-10 mt-28 bg-gray-50">
    <div class="max-w-6xl mx-auto">
    
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm mb-6 text-red-100">
            <a href="/" class="hover:text-blue1 transition-colors">
                <i class="fas fa-home mr-1"></i>
                Beranda
            </a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-blue1 font-medium">Pelaporan Bencana</span>
        </nav>
        <!-- Form Container -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 card-hover animate-fadeInUp">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Form Laporan Bencana</h2>
                <p class="text-gray-600">Isi form dengan data yang akurat untuk membantu proses penanganan bencana</p>
            </div>

            <form action="{{ route('pelaporan-bencana.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <input type="hidden" name="longitude" id="inpLongitude">
                <input type="hidden" name="latitude" id="inpLatitude">

                <!-- Basic Information -->
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center border-b border-gray-200 pb-3">
                        <i class="fas fa-info-circle mr-3 text-blue-500"></i>
                        Informasi Dasar Bencana
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                                Jenis Bencana
                            </label>
                            <select name="nama_bencana" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option value="">Pilih Jenis Bencana</option>
                                <option value="Banjir">🌊 Banjir</option>
                                <option value="Gempa Bumi">🏔️ Gempa Bumi</option>
                                <option value="Tanah Longsor">🏔️ Tanah Longsor</option>
                                <option value="Kebakaran">🔥 Kebakaran</option>
                                <option value="Angin Topan">🌪️ Angin Topan</option>
                            </select>
                            @error('nama_bencana')
                                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-chart-line text-orange-500 mr-2"></i>
                                Tingkat Bencana
                            </label>
                            <select name="tingkat_bencana" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option value="">Pilih Tingkat Bencana</option>
                                <option value="rendah">🟢 Rendah</option>
                                <option value="sedang">🟡 Sedang</option>
                                <option value="tinggi">🔴 Tinggi</option>
                            </select>
                            @error('tingkat_bencana')
                                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center border-b border-gray-200 pb-3">
                        <i class="fas fa-map-marker-alt mr-3 text-green-500"></i>
                        Informasi Lokasi
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-building text-purple-500 mr-2"></i>
                                Kecamatan
                            </label>
                            <select name="id_kecamatan" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatan as $item)
                                    <option value="{{ $item['id_kecamatan'] }}">{{ $item['nama_kecamatan'] }}</option>
                                @endforeach
                            </select>
                            @error('id_kecamatan')
                                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-map text-blue-500 mr-2"></i>
                                Desa
                            </label>
                            <select name="id_desa" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option value="">Pilih Desa</option>
                                @foreach ($desas as $desa)
                                    <option value="{{ $desa->id_desa }}">{{ $desa->nama_desa }}</option>
                                @endforeach
                            </select>
                            @error('id_desa')
                                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-map-pin text-indigo-500 mr-2"></i>
                            Deskripsi Alamat Detail
                        </label>
                        <textarea name="deskripsi_alamat" rows="4" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none" placeholder="Contoh: Jalan Mawar No. 15, dekat Masjid Al-Ikhlas, Kelurahan Sumbersari"></textarea>
                        @error('deskripsi_alamat')
                            <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description and Documentation -->
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center border-b border-gray-200 pb-3">
                        <i class="fas fa-file-alt mr-3 text-purple-500"></i>
                        Deskripsi dan Dokumentasi
                    </h3>
                    
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-comment-alt text-gray-500 mr-2"></i>
                            Deskripsi Kejadian
                        </label>
                        <textarea name="deskripsi_bencana" rows="5" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none" placeholder="Jelaskan secara detail kondisi bencana yang terjadi, dampak yang ditimbulkan, dan situasi terkini..."></textarea>
                        @error('deskripsi_bencana')
                            <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Photo Upload -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-camera text-indigo-500 mr-2"></i>
                                Dokumentasi Foto
                            </label>
                            <label class="upload-area flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-red-400 transition-colors relative overflow-hidden">
                                <input type="file" class="hidden" name="file" id="fileInput" accept="image/*" />
                                <div class="text-center" id="uploadPlaceholder">
                                    <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-4" id="uploadIcon"></i>
                                    <p class="text-gray-500 font-medium mb-2" id="uploadText">Klik untuk upload foto</p>
                                    <p class="text-xs text-gray-400">PNG, JPG hingga 5MB</p>
                                </div>
                                <img id="imagePreview" class="absolute inset-0 w-full h-full object-cover rounded-xl opacity-0 transition-opacity duration-300" alt="Preview">
                            </label>
                            @error('file')
                                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Map Selection -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-crosshairs text-red-500 mr-2"></i>
                                Titik Lokasi Bencana
                            </label>
                            <div class="relative">
                                <div id="map" class="h-64 w-full rounded-xl border-2 border-gray-200 z-[1]"></div>
                                <div class="absolute top-2 left-2 bg-white/90 backdrop-blur-sm rounded-lg p-2 text-xs text-gray-600 shadow-md z-[2]">
                                    <i class="fas fa-mouse-pointer mr-1"></i>
                                    Klik pada peta untuk menandai lokasi
                                </div>
                            </div>
                            @error('longitude')
                                <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-200">
                    <button type="submit" class="flex-1 bg-blue1 hover:from-red-700 hover:to-orange-700 text-white py-4 px-8 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Laporan
                    </button>
                    <button type="reset" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-4 px-8 rounded-xl font-semibold transition-all duration-300">
                        <i class="fas fa-undo mr-2"></i>
                        Reset Form
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
// Map initialization
var map = L.map('map').setView([-8.184486, 113.668076], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var lastMarker = null;

map.on('click', function(e) {
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;
    $("#inpLatitude").val(lat);
    $("#inpLongitude").val(lng);

    if (lastMarker) {
        map.removeLayer(lastMarker);
    }

    lastMarker = L.marker([lat, lng], {
        icon: L.divIcon({
            className: 'custom-marker',
            html: '<div style="background-color: #dc2626; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.3);"></div>',
            iconSize: [20, 20],
            iconAnchor: [10, 10]
        })
    }).addTo(map)
        .bindPopup(`<div class="text-center"><strong>📍 Lokasi Bencana</strong><br>Lat: ${lat.toFixed(6)}<br>Lng: ${lng.toFixed(6)}</div>`).openPopup();
});

// Image preview functionality
const fileInput = document.getElementById('fileInput');
const imagePreview = document.getElementById('imagePreview');
const uploadIcon = document.getElementById('uploadIcon');
const uploadText = document.getElementById('uploadText');
const uploadPlaceholder = document.getElementById('uploadPlaceholder');

fileInput.addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('opacity-0');
            imagePreview.classList.add('opacity-100');
            uploadPlaceholder.classList.add('hidden');
        };
        
        reader.readAsDataURL(file);
    } else {
        imagePreview.classList.add('opacity-0');
        imagePreview.classList.remove('opacity-100');
        uploadPlaceholder.classList.remove('hidden');
    }
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const latitude = document.getElementById('inpLatitude').value;
    const longitude = document.getElementById('inpLongitude').value;
    
    if (!latitude || !longitude) {
        e.preventDefault();
        alert('Silakan pilih lokasi bencana pada peta terlebih dahulu!');
        return false;
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
