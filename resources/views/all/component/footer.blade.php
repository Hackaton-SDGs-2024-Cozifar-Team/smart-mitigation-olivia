<footer class="bg-blue1 text-white relative overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-cyan-400/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
    </div>
    
    <div class="relative px-[20px] md:px-[150px] pt-[80px] pb-[30px]">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- Brand Section -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-shield-alt text-blue1 text-xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
                        Smart Mitigation
                    </h3>
                </div>
                <p class="text-blue-100 text-lg leading-relaxed max-w-md">
                    Platform inovatif untuk mitigasi bencana berbasis teknologi AI dan machine learning, membantu masyarakat dalam pencegahan dan penanggulangan bencana alam.
                </p>
                
                <!-- Social Media -->
                <div class="flex space-x-4">
                    <a href="#" class="group bg-white/10 hover:bg-white w-12 h-12 flex items-center justify-center rounded-xl backdrop-blur-sm border border-white/20 transition-all duration-300 hover:scale-110 hover:shadow-xl">
                        <i class="fab fa-facebook text-white group-hover:text-blue1 text-xl transition-colors duration-300"></i>
                    </a>
                    <a href="#" class="group bg-white/10 hover:bg-white w-12 h-12 flex items-center justify-center rounded-xl backdrop-blur-sm border border-white/20 transition-all duration-300 hover:scale-110 hover:shadow-xl">
                        <i class="fab fa-twitter text-white group-hover:text-blue1 text-xl transition-colors duration-300"></i>
                    </a>
                    <a href="#" class="group bg-white/10 hover:bg-white w-12 h-12 flex items-center justify-center rounded-xl backdrop-blur-sm border border-white/20 transition-all duration-300 hover:scale-110 hover:shadow-xl">
                        <i class="fab fa-instagram text-white group-hover:text-blue1 text-xl transition-colors duration-300"></i>
                    </a>
                    <a href="#" class="group bg-white/10 hover:bg-white w-12 h-12 flex items-center justify-center rounded-xl backdrop-blur-sm border border-white/20 transition-all duration-300 hover:scale-110 hover:shadow-xl">
                        <i class="fab fa-youtube text-white group-hover:text-blue1 text-xl transition-colors duration-300"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="space-y-6">
                <h4 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-link mr-2 text-blue-300"></i>
                    Navigasi
                </h4>
                <ul class="space-y-3">
                    <li><a href="/" class="text-blue-100 hover:text-white hover:translate-x-2 transition-all duration-300 flex items-center group">
                        <i class="fas fa-home mr-2 text-blue-300 group-hover:text-white"></i>Beranda
                    </a></li>
                    <li><a href="/#about" class="text-blue-100 hover:text-white hover:translate-x-2 transition-all duration-300 flex items-center group">
                        <i class="fas fa-info-circle mr-2 text-blue-300 group-hover:text-white"></i>Tentang Kami
                    </a></li>
                    <li><a href="/#fitur" class="text-blue-100 hover:text-white hover:translate-x-2 transition-all duration-300 flex items-center group">
                        <i class="fas fa-cogs mr-2 text-blue-300 group-hover:text-white"></i>Fitur
                    </a></li>
                    <li><a href="/#donasi" class="text-blue-100 hover:text-white hover:translate-x-2 transition-all duration-300 flex items-center group">
                        <i class="fas fa-heart mr-2 text-blue-300 group-hover:text-white"></i>Donasi
                    </a></li>
                </ul>
            </div>
            
            <!-- Features -->
            <div class="space-y-6">
                <h4 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-star mr-2 text-yellow-400"></i>
                    Layanan
                </h4>
                <ul class="space-y-3">
                    <li><a href="/#prediksi-bencana" class="text-blue-100 hover:text-white hover:translate-x-2 transition-all duration-300 flex items-center group">
                        <i class="fas fa-brain mr-2 text-purple-300 group-hover:text-white"></i>Prediksi Bencana
                    </a></li>
                    <li><a href="/#clustering" class="text-blue-100 hover:text-white hover:translate-x-2 transition-all duration-300 flex items-center group">
                        <i class="fas fa-project-diagram mr-2 text-indigo-300 group-hover:text-white"></i>Clustering Risiko
                    </a></li>
                    <li><a href="{{ route('pelaporan-bencana') }}" class="text-blue-100 hover:text-white hover:translate-x-2 transition-all duration-300 flex items-center group">
                        <i class="fas fa-exclamation-triangle mr-2 text-orange-300 group-hover:text-white"></i>Laporan Bencana
                    </a></li>
                    <li><a href="/#articles" class=" hover:text-white hover:translate-x-2 transition-all duration-300 flex items-center group">
                        <i class="fas fa-newspaper mr-2  group-hover:text-white"></i>Berita Terkini
                    </a></li>
                </ul>
            </div>
        </div>
        
        <!-- Contact Info Section -->
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 mb-8 border border-white/20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-white"></i>
                    </div>
                    <div>
                        <p class="text-white font-semibold">Alamat</p>
                        <p class="text-blue-100 text-sm">Jember, Jawa Timur</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-envelope text-white"></i>
                    </div>
                    <div>
                        <p class="text-white font-semibold">Email</p>
                        <p class="text-blue-100 text-sm">info@smartmitigation.id</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-phone text-white"></i>
                    </div>
                    <div>
                        <p class="text-white font-semibold">Telepon</p>
                        <p class="text-blue-100 text-sm">+62 123 456 789</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Section -->
        <div class="border-t border-white/20 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex items-center space-x-2 text-blue-100">
                    <i class="fas fa-copyright"></i>
                    <span>Copyright 2025 Smart Mitigation.</span>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-blue-100 hover:text-white transition-colors duration-300 text-sm">
                        Kebijakan Privasi
                    </a>
                    <a href="#" class="text-blue-100 hover:text-white transition-colors duration-300 text-sm">
                        Syarat & Ketentuan
                    </a>
                    <a href="#" class="text-blue-100 hover:text-white transition-colors duration-300 text-sm">
                        Bantuan
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
/* Additional animations for footer */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.footer-float {
    animation: float 6s ease-in-out infinite;
}

/* Hover effects for links */
footer a:hover {
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
}

/* Gradient text for headings */
footer h4 {
    background: linear-gradient(135deg, #ffffff, #93c5fd);
    -webkit-background-clip: text;
    background-clip: text;
}
</style>
