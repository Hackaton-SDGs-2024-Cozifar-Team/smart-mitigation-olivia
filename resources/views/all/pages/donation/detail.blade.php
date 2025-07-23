@extends('all.layout.index')

@section('title', 'Detail Donasi')
@section('landing')
    <style>
        .fixed-top {
            position: fixed;
            top: 85px;
            z-index: 50;
            height: auto !important;
        }
        
        /* Preserve original sidebar dimensions when fixed */
        #boxDonasi.fixed-top {
            max-height: calc(100vh - 100px);
            overflow-y: auto;
        }
        
        /* Remove transition to prevent layout shift */
        #boxDonasi {
            transition: none;
            will-change: auto;
        }
        
        /* Sidebar container for consistent width */
        .sidebar-container {
            width: 100%;
            flex-shrink: 0;
        }
        
        @media (min-width: 1024px) {
            .sidebar-container {
                width: 400px;
            }
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .progress-bar {
            background: linear-gradient(90deg, #4ade80, #22c55e);
            box-shadow: 0 0 20px rgba(34, 197, 94, 0.3);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }
        
        .share-modal {
            backdrop-filter: blur(10px);
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
        
        @media (max-width: 1024px) {
            #boxDonasi.fixed-top {
                position: relative !important;
                top: auto !important;
                width: 100% !important;
                max-width: none !important;
            }
        }
    </style>

<!-- Hero Section -->
<section class="bg-white py-8 mt-20">
    <div class="px-4 sm:px-6 lg:px-36">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-gray-600">
            <a href="/" class="hover:text-blue-600 transition-colors">
                <i class="fas fa-home mr-1"></i>
                Beranda
            </a>
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <a href="/#donasi" class="hover:text-blue-600 transition-colors">
                Donasi
            </a>
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <span class="text-gray-800 font-medium">Detail Donasi</span>
        </nav>
    </div>
</section>

<section class="px-4 sm:px-6 lg:px-36 py-10">
    @php
        $pathImg1 = $bencana->foto_bencana ?? 'Frame 1397.png';
    @endphp

    <!-- Image Gallery -->
    <div class="flex flex-col lg:flex-row gap-6 mb-10 animate-fadeInUp">
        <div class="w-full lg:w-[800px]">
            <img src="{{ asset("uploads/bencana/$pathImg1") }}" 
                 alt="Main Image" 
                 class="w-full h-[400px] lg:h-[500px] object-cover rounded-2xl shadow-2xl card-hover">
        </div>
        <div class="w-full lg:w-[500px] flex flex-col gap-4">
            <img src="{{ asset('/img/donasi/detail-donasi.png') }}" 
                 alt="Image 2" 
                 class="h-[190px] lg:h-[240px] object-cover rounded-2xl shadow-lg card-hover">
            <img src="{{ asset('/img/donasi/detail-donasi2.png') }}" 
                 alt="Image 3" 
                 class="h-[190px] lg:h-[240px] object-cover rounded-2xl shadow-lg card-hover">
        </div>
    </div>



    <div class="flex flex-col lg:flex-row gap-8 justify-between">
        <div class="w-full lg:w-[850px]">
                <!-- Title and Info Section -->
    <div class="mb-10 animate-fadeInUp">
        <!-- Emergency Badge -->
        <div class="inline-flex items-center px-3 py-1 bg-red-50 border border-red-200 rounded-full text-red-700 text-sm mb-4">
            <div class="w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse"></div>
            Status Darurat
        </div>
        
        <!-- Title -->
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
            {{ $bencana->nama_bencana }}
        </h1>
        
        <!-- Info -->
        <div class="flex flex-wrap gap-6 items-center text-gray-600 mb-6">
            <div class="flex items-center">
                <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                <span>{{ $bencana->desa->nama_desa }}, {{ $bencana->desa->kecamatan->nama_kecamatan }}</span>
            </div>
            <div class="flex items-center">
                <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>
                <span>{{ \Carbon\Carbon::parse($bencana->tanggal_kejadian)->translatedFormat('d F Y') }}</span>
            </div>
            @php
                $progresBar = ($bencana->total_donasi_uang / $bencana->target_uang_donasi) * 100;
                use App\Util\FormatRupiah;
            @endphp
            <div class="flex items-center">
                <i class="fas fa-chart-line mr-2 text-green-500"></i>
                <span>{{ number_format($progresBar, 1) }}% Tercapai</span>
            </div>
        </div>
        
        <!-- Quick Action Buttons -->
        <div class="flex gap-4">
            <!-- Removed share button from here -->
        </div>
    </div>
            <!-- Description -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 card-hover animate-fadeInUp">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Deskripsi Bencana</h2>
                <p class="text-gray-700 leading-relaxed text-lg">{{ $bencana->deskripsi_bencana }}</p>
            </div>


            <!-- Donation Stats -->
            <div class="grid md:grid-cols-2 gap-6 mb-8 animate-fadeInUp">
                <div class="bg-gradient-to-br from-green-50 to-emerald-100 border border-green-200 rounded-2xl shadow-lg p-8 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-money-bill-wave text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg text-green-700 font-medium">Donasi Terkumpul</p>
                            <p class="text-3xl font-bold text-green-600">Rp {{ FormatRupiah::rupiah($bencana->total_donasi_uang ?? 0) }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-blue-50 to-cyan-100 border border-blue-200 rounded-2xl shadow-lg p-8 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-box text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg text-blue-700 font-medium">Barang Terkumpul</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $bencana->total_donasi_barang ?? 0 }} Barang</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Disaster Info Cards -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 animate-fadeInUp">
                @php
                    $info = [
                        ['icon' => 'house-chimney-crack', 'color' => 'text-red-500', 'bg' => 'bg-red-50', 'label' => 'Tingkat Kerusakan', 'value' => $bencana->informasiBencana->dampak_kerusakan ?? ''],
                        ['icon' => 'person-falling-burst', 'color' => 'text-red-600', 'bg' => 'bg-red-50', 'label' => 'Korban Meninggal', 'value' => $bencana->informasiBencana->korban_meninggal ?? ''],
                        ['icon' => 'person-hiking', 'color' => 'text-yellow-500', 'bg' => 'bg-yellow-50', 'label' => 'Korban Mengungsi', 'value' => $bencana->informasiBencana->korban_mengungsi ?? ''],
                        ['icon' => 'user-injured', 'color' => 'text-orange-500', 'bg' => 'bg-orange-50', 'label' => 'Korban Terluka', 'value' => $bencana->informasiBencana->korban_terluka ?? ''],
                        ['icon' => 'location-dot', 'color' => 'text-blue-500', 'bg' => 'bg-blue-50', 'label' => 'Lokasi', 'value' => $bencana->desa->nama_desa],
                    ];
                @endphp
                @foreach ($info as $i)
                <div class="flex items-center p-6 {{ $i['bg'] }} border border-gray-200 rounded-2xl shadow-lg card-hover">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-4 shadow-md">
                        <i class="fa-solid fa-{{ $i['icon'] }} text-xl {{ $i['color'] }}"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 font-medium">{{ $i['label'] }}</p>
                        <p class="font-bold text-gray-800 text-lg">{{ $i['value'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Requirements Table -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 card-hover animate-fadeInUp">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-list-check mr-3 text-blue-500"></i>
                    Kebutuhan Barang
                </h2>
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-xl overflow-hidden">
                        <thead class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white">
                            <tr>
                                <th class="p-4 text-left font-semibold">No</th>
                                <th class="p-4 text-left font-semibold">Nama Kebutuhan</th>
                                <th class="p-4 text-left font-semibold">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($kebutuhanKorban as $item)
                            <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors duration-200">
                                <td class="p-4 font-medium">{{ $loop->iteration }}</td>
                                <td class="p-4">{{ $item->nama_kebutuhan }}</td>
                                <td class="p-4 font-semibold text-blue-600">{{ $item->jumlah_kebutuhan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Map Section -->
            <div class="bg-white rounded-2xl shadow-lg p-8 card-hover animate-fadeInUp">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-map-marked-alt mr-3 text-red-500"></i>
                    Peta Lokasi Bencana
                </h2>
                <div id="map" class="h-[400px] rounded-xl border-2 border-gray-200 shadow-inner"></div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar-container">
            <div id="boxDonasi" class="lg:sticky lg:top-24 border border-gray-200 shadow-2xl rounded-2xl bg-white w-full">
                <div class="sidebar-content p-8">
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">💝 Donasi Tersedia</h3>
                        @php
                            $progresBar = ($bencana->total_donasi_uang / $bencana->target_uang_donasi) * 100;
                            $sisaDonasi = $bencana->target_uang_donasi - $bencana->total_donasi_uang;
                        @endphp
                        <p class="text-3xl font-bold text-green-600">
                            Rp {{ FormatRupiah::Rupiah($sisaDonasi) }}
                        </p>
                        <p class="text-sm text-gray-500">dari target Rp {{ FormatRupiah::Rupiah($bencana->target_uang_donasi) }}</p>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-600">Progress</span>
                            <span class="text-sm font-bold text-green-600">{{ number_format($progresBar, 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div class="progress-bar h-4 rounded-full transition-all duration-1000" 
                                 style="width: {{ min($progresBar, 100) }}%"></div>
                        </div>
                    </div>

                    <!-- Items needed -->
                    <div class="text-center mb-6 p-4 bg-blue-50 rounded-xl">
                        <p class="text-lg font-semibold text-blue-800 mb-2">📦 Kebutuhan Barang</p>
                        <p class="text-2xl font-bold text-blue-600">{{ count($kebutuhanKorban) }} <span class="text-base">jenis</span></p>
                    </div>

                    <!-- Donation Button -->
                    <a href="{{ route('user.donasi.tambah', $bencana->id_laporan_bencana) }}"
                       class="btn-primary text-white block w-full text-center py-4 rounded-xl text-lg font-semibold mb-4">
                        <i class="fas fa-heart mr-2"></i>
                        Donasi Sekarang
                    </a>

                    <!-- Share Button -->
                    <button onclick="openShareModal()" 
                            class="bg-gray-600 hover:bg-gray-700 text-white block w-full py-3 rounded-xl font-semibold transition-colors mb-4">
                        <i class="fas fa-share-alt mr-2"></i>
                        Bagikan Donasi
                    </button>

                    <!-- Quick amounts -->
                    <div class="grid grid-cols-2 gap-2 mb-6">
                        <button class="bg-gray-100 hover:bg-blue-100 py-2 px-4 rounded-lg text-sm font-medium transition-colors duration-200">50K</button>
                        <button class="bg-gray-100 hover:bg-blue-100 py-2 px-4 rounded-lg text-sm font-medium transition-colors duration-200">100K</button>
                        <button class="bg-gray-100 hover:bg-blue-100 py-2 px-4 rounded-lg text-sm font-medium transition-colors duration-200">250K</button>
                        <button class="bg-gray-100 hover:bg-blue-100 py-2 px-4 rounded-lg text-sm font-medium transition-colors duration-200">500K</button>
                    </div>

                    <p class="text-sm text-gray-500 text-center">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Dikelola Oleh Relawan & BPBD Jember
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Share Modal -->
<div id="shareModal" class="fixed inset-0 bg-black bg-opacity-50 share-modal z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 transform transition-all duration-300 scale-95" id="shareModalContent">
        <div class="text-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-2">📢 Bagikan Donasi</h3>
            <p class="text-gray-600">Ajak teman dan keluarga untuk ikut berdonasi</p>
        </div>
        
        <div class="space-y-4">
            <button onclick="shareToWhatsApp()" 
                    class="w-full flex items-center justify-center gap-3 bg-green-500 hover:bg-green-600 text-white py-3 px-6 rounded-xl font-semibold transition-colors duration-200">
                <i class="fab fa-whatsapp text-xl"></i>
                WhatsApp
            </button>
            
            <button onclick="shareToFacebook()" 
                    class="w-full flex items-center justify-center gap-3 bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-xl font-semibold transition-colors duration-200">
                <i class="fab fa-facebook text-xl"></i>
                Facebook
            </button>
            
            <button onclick="shareToTwitter()" 
                    class="w-full flex items-center justify-center gap-3 bg-blue-400 hover:bg-blue-500 text-white py-3 px-6 rounded-xl font-semibold transition-colors duration-200">
                <i class="fab fa-twitter text-xl"></i>
                Twitter
            </button>
            
            <button onclick="copyLink()" 
                    class="w-full flex items-center justify-center gap-3 bg-gray-600 hover:bg-gray-700 text-white py-3 px-6 rounded-xl font-semibold transition-colors duration-200">
                <i class="fas fa-link text-xl"></i>
                Salin Link
            </button>
        </div>
        
        <button onclick="closeShareModal()" 
                class="w-full mt-6 bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 px-6 rounded-xl font-semibold transition-colors duration-200">
            Tutup
        </button>
    </div>
</div>

<script>
    var map = L.map('map').setView([{{ $bencana->latitude }}, {{ $bencana->longitude }}], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var markerBencana = L.marker([{{ $bencana->latitude }}, {{ $bencana->longitude }}]).addTo(map)
        .bindPopup("<b>Pusat Bencana</b>").openPopup();

    $.ajax({
        url: "/api/posko/" + {{ $bencana->id_laporan_bencana }},
        method: "GET",
        success: function(response) {
            response.forEach(function(element) {
                L.marker([element.latitude, element.longitude]).addTo(map)
                    .bindPopup("<b>Posko " + element.nama_posko + "</b><br><a href='/detail-distribusi/" + element.id_posko + "' class='text-blue-600 underline'>Lihat Detail</a>");
            });
        }
    });

    // Share functionality
    function openShareModal() {
        const modal = document.getElementById('shareModal');
        const content = document.getElementById('shareModalContent');
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
        }, 10);
    }

    function closeShareModal() {
        const modal = document.getElementById('shareModal');
        const content = document.getElementById('shareModalContent');
        content.classList.add('scale-95');
        content.classList.remove('scale-100');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function shareToWhatsApp() {
        const text = `Mari bantu saudara kita yang terkena ${encodeURIComponent('{{ $bencana->nama_bencana }}')} di {{ $bencana->desa->nama_desa }}. Donasi sekarang: ${window.location.href}`;
        window.open(`https://wa.me/?text=${text}`, '_blank');
    }

    function shareToFacebook() {
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`, '_blank');
    }

    function shareToTwitter() {
        const text = `Mari bantu saudara kita yang terkena bencana di {{ $bencana->desa->nama_desa }}`;
        window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(window.location.href)}`, '_blank');
    }

    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link berhasil disalin ke clipboard!');
            closeShareModal();
        });
    }

    // Close modal when clicking outside
    document.getElementById('shareModal').addEventListener('click', (e) => {
        if (e.target.id === 'shareModal') {
            closeShareModal();
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        const boxDonasi = document.getElementById("boxDonasi");
        const sidebarContainer = boxDonasi.parentElement;
        let originalWidth, originalHeight, originalOffset, originalLeft;
        
        // Store original dimensions and position
        function storeOriginalDimensions() {
            const containerRect = sidebarContainer.getBoundingClientRect();
            const boxRect = boxDonasi.getBoundingClientRect();
            
            originalWidth = containerRect.width;
            originalHeight = boxRect.height;
            originalOffset = boxDonasi.offsetTop - 85;
            originalLeft = containerRect.left;
        }
        
        // Initial measurement
        storeOriginalDimensions();

        function handleScroll() {
            const isDesktop = window.innerWidth >= 1024;

            if (!isDesktop) {
                if (boxDonasi.classList.contains("fixed-top")) {
                    boxDonasi.classList.remove("fixed-top");
                    boxDonasi.style.width = '';
                    boxDonasi.style.left = '';
                    
                    // Remove placeholder
                    const placeholder = document.getElementById('sidebar-placeholder');
                    if (placeholder) {
                        placeholder.remove();
                    }
                }
                return;
            }

            if (window.pageYOffset > originalOffset) {
                if (!boxDonasi.classList.contains("fixed-top")) {
                    // Add placeholder to maintain layout
                    const placeholder = document.createElement('div');
                    placeholder.id = 'sidebar-placeholder';
                    placeholder.style.width = originalWidth + 'px';
                    placeholder.style.height = originalHeight + 'px';
                    placeholder.style.visibility = 'hidden';
                    
                    sidebarContainer.appendChild(placeholder);
                    
                    // Get current container position for fixed positioning
                    const currentRect = sidebarContainer.getBoundingClientRect();
                    
                    boxDonasi.classList.add("fixed-top");
                    boxDonasi.style.width = originalWidth + 'px';
                    boxDonasi.style.left = currentRect.left + 'px';
                }
            } else {
                if (boxDonasi.classList.contains("fixed-top")) {
                    boxDonasi.classList.remove("fixed-top");
                    boxDonasi.style.width = '';
                    boxDonasi.style.left = '';
                    
                    // Remove placeholder
                    const placeholder = document.getElementById('sidebar-placeholder');
                    if (placeholder) {
                        placeholder.remove();
                    }
                }
            }
        }

        // Update fixed position on scroll to handle horizontal scrolling
        function updateFixedPosition() {
            if (boxDonasi.classList.contains("fixed-top")) {
                const currentRect = sidebarContainer.getBoundingClientRect();
                boxDonasi.style.left = currentRect.left + 'px';
            }
        }

        // Recalculate on resize
        function handleResize() {
            // Reset everything first
            if (boxDonasi.classList.contains("fixed-top")) {
                boxDonasi.classList.remove("fixed-top");
                boxDonasi.style.width = '';
                boxDonasi.style.left = '';
                
                const placeholder = document.getElementById('sidebar-placeholder');
                if (placeholder) {
                    placeholder.remove();
                }
            }
            
            // Recalculate after a short delay
            setTimeout(() => {
                storeOriginalDimensions();
                handleScroll();
            }, 100);
        }

        window.addEventListener("scroll", () => {
            handleScroll();
            updateFixedPosition();
        });
        window.addEventListener("resize", handleResize);
    });
</script>

@endsection
