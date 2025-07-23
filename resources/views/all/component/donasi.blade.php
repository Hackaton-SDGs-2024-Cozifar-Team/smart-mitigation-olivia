<section class="bg-white py-20" id="donasi">
    <div class="max-w-7xl mx-auto text-center px-4">
        <div class="mb-8">
            <span class="inline-block px-6 py-3 bg-blue1 text-white rounded-full text-lg font-bold shadow-lg">
                🤝 Donasi Terkini
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mt-6 mb-4">
                Mari Wujudkan Kepedulian
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Bersama-sama kita dapat membantu saudara kita yang terdampak bencana. Setiap donasi Anda sangat berarti untuk pemulihan mereka.
            </p>
        </div>
    </div>
    
    @php
        use App\Util\FormatRupiah;
    @endphp
    
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($bencana as $index => $item)
                @php
                    $progresBar = ($item->total_donasi / $item->target_uang_donasi) * 100;
                    $sisaDonasi = $item->target_uang_donasi - $item->total_donasi;
                @endphp
                
                <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 hover:scale-105 hover:-translate-y-2 animate-fadeInUp"
                     style="animation-delay: {{ $index * 0.1 }}s;">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('/img/donasi/Frame 1389 (1).png') }}" 
                             alt="Bencana {{ $item->nama_bencana }}" 
                             class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 left-4">
                            @if($progresBar >= 100)
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    ✅ Target Tercapai
                                </span>
                            @elseif($progresBar >= 50)
                                <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    🔥 Hampir Tercapai
                                </span>
                            @else
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    🚨 Butuh Bantuan
                                </span>
                            @endif
                        </div>
                        
                        <!-- Progress Badge -->
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1">
                            <span class="text-sm font-bold text-gray-800">{{ number_format($progresBar, 1) }}%</span>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                            {{ $item->nama_bencana }}
                        </h3>
                        
                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-600">Progress Donasi</span>
                                <span class="text-sm font-bold text-blue-600">{{ number_format($progresBar, 1) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-3 rounded-full transition-all duration-1000 ease-out shadow-lg" 
                                     style="width: {{ min($progresBar, 100) }}%">
                                    <div class="h-full bg-white/30 animate-pulse"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Donation Amount -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-1">Terkumpul</p>
                            <p class="text-2xl font-bold text-gray-900 mb-1">
                                Rp {{ FormatRupiah::Rupiah($item->total_donasi) }}
                            </p>
                            <p class="text-sm text-gray-500">
                                dari target Rp {{ FormatRupiah::Rupiah($item->target_uang_donasi) }}
                            </p>
                            @if($sisaDonasi > 0)
                                <p class="text-xs text-red-600 font-medium mt-1">
                                    Kurang Rp {{ FormatRupiah::Rupiah($sisaDonasi) }}
                                </p>
                            @endif
                        </div>
                        
                        <!-- Details -->
                        <div class="space-y-2 mb-6">
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fa-solid fa-location-dot text-red-500 text-xs"></i>
                                </div>
                                <span>{{ $item->desa->nama_desa }}, {{ $item->desa->kecamatan->nama_kecamatan }}</span>
                            </div>
                            
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fa-solid fa-calendar-days text-blue-500 text-xs"></i>
                                </div>
                                <span>{{ \Carbon\Carbon::parse($item->tanggal_kejadian)->translatedFormat('d F Y') }}</span>
                            </div>
                            
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fa-solid fa-users text-green-600 text-xs"></i>
                                </div>
                                <span>5 Kebutuhan Logistik</span>
                            </div>
                        </div>
                        
                        <!-- Action Button -->
                        <a href="{{ route('user.donasi.detail', $item->id_laporan_bencana) }}"
                           class="block w-full text-center bg-blue1 hover:from-blue-700 hover:to-cyan-700 text-white py-3 px-6 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            <i class="fa-solid fa-heart mr-2"></i>
                            Donasi Sekarang
                        </a>
                        
                    </div>
                </div>
                
            @endforeach
        </div>
        
        <!-- Show More Button -->
        @if(count($bencana) > 6)
            <div class="text-center mt-12">
                <button class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-50 text-gray-800 font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Lihat Lebih Banyak
                </button>
            </div>
        @endif
    </div>
</section>

<style>
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
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Progress bar glow effect */
.bg-gradient-to-r.from-blue-500.to-cyan-500 {
    box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
}

/* Hover effects for quick donation buttons */
.cursor-pointer:hover {
    transform: scale(1.05);
}
</style>