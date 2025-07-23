@extends('all.layout.index')

@section('title', 'Landing Page')
@section('landing')

    <style>
        .active-btn {
            background-color: #283F50;
            color: #fff;
        }
        
    </style>

    <section id="main-page" class="relative w-full h-[900px] pt-[70px] flex flex-col md:flex-row hero-bg overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-32 h-32 bg-white/10 rounded-full blur-xl animate-pulse"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-blue-300/20 rounded-full blur-lg floating-animation"></div>
            <div class="absolute bottom-32 left-1/4 w-40 h-40 bg-blue-400/15 rounded-full blur-2xl"></div>
            <div class="absolute top-1/2 right-10 w-16 h-16 bg-white/20 rounded-full blur-md floating-animation" style="animation-delay: 2s;"></div>
        </div>
        
        <!-- Gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/20 via-transparent to-blue-800/30"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row w-full h-full">
            <!-- Left side - Map visualization -->
            <div class="flex-1 flex items-center justify-center relative group">
                <div class="relative">
                    <!-- Map container with enhanced effects -->
                    <div class="relative transform hover:scale-105 transition-all duration-700 floating-animation">
                        <img src="/img/maps.png" alt="Smart Disaster Prediction Map" 
                             class="w-[820px] max-w-full h-auto drop-shadow-2xl filter brightness-110 contrast-105">
                        
                        <!-- Interactive overlay elements -->
                        <div class="absolute top-1/4 left-1/4 w-4 h-4 bg-red-500 rounded-full pulse-glow opacity-80">
                            <div class="absolute inset-0 bg-red-500 rounded-full animate-ping"></div>
                        </div>
                        <div class="absolute top-1/2 right-1/3 w-3 h-3 bg-yellow-500 rounded-full animate-pulse opacity-70"></div>
                        <div class="absolute bottom-1/3 left-1/2 w-5 h-5 bg-green-500 rounded-full animate-bounce opacity-60"></div>
                    </div>
                    
                    <!-- Floating info cards -->
                    <div class="absolute -top-0 -right-8 bg-white/95 backdrop-blur-sm rounded-xl p-4 shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-4 group-hover:translate-x-0">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-sm font-semibold text-gray-700">Real-time Monitoring</span>
                        </div>
                        <p class="text-xs text-gray-600 mt-1">95% Accuracy</p>
                    </div>
                    
                    <div class="absolute top-96 -left-0 bg-white/95 backdrop-blur-sm rounded-xl p-4 shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-500 transform -translate-x-4 group-hover:translate-x-0" style="transition-delay: 0.2s;">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
                            <span class="text-sm font-semibold text-gray-700">AI Prediction</span>
                        </div>
                        <p class="text-xs text-gray-600 mt-1">24/7 Analysis</p>
                    </div>
                </div>
            </div>
            
            <!-- Right side - Hero content -->
            <div class="flex-1 flex flex-col mt-[-100px] md:mt-0 justify-center items-start px-6 md:px-12 relative">
                <!-- Hero badge -->
                <div class="mb-6 opacity-0 animate-fadeInUp" style="animation-delay: 0.2s;">
                    <span class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm font-semibold border border-white/30">
                        🚀 Smart Mitigation
                    </span>
                </div>
                
                <!-- Main heading -->
                <div class="mb-8 opacity-0 animate-fadeInUp" style="animation-delay: 0.4s;">
                    <h1 class="text-[50px] md:text-[72px] font-[800] text-white leading-tight tracking-tight">
                        <span class="block bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
                            DETEKSI DINI
                        </span>
                        <span class="block mt-[-20px] bg-gradient-to-r from-blue-200 to-white bg-clip-text text-transparent">
                            LINDUNGI DIRI
                        </span>
                    </h1>
                    <div class="w-24 h-1 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full mt-4"></div>
                </div>
                
                <!-- Description -->
                <div class="mb-8 opacity-0 animate-fadeInUp" style="animation-delay: 0.6s;">
                    <p class="w-full md:w-[550px] text-white/90 font-[400] text-[20px] leading-relaxed">
                        Sistem prediksi bencana berbasis <span class="font-semibold text-blue-200">Artificial Intelligence</span> 
                        yang memberikan peringatan dini dengan akurasi tinggi untuk melindungi masyarakat dari risiko bencana alam.
                    </p>
                </div>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mb-8 opacity-0 animate-fadeInUp" style="animation-delay: 0.8s;">
                    <a href="#tampilanMap" 
                       class="group inline-flex items-center px-8 py-4 bg-blue1 hover:from-blue-500 hover:to-blue-700 text-white rounded-2xl font-semibold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-chart-line mr-3 group-hover:animate-pulse"></i>
                        LIHAT PREDIKSI
                        <i class="fas fa-arrow-right ml-3 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                    
                    <a href="#fitur-page" 
                       class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white/30 hover:bg-white/20 text-white rounded-2xl font-semibold text-lg transition-all duration-300 hover:border-white/50">
                        <i class="fas fa-info-circle mr-3"></i>
                        Pelajari Lebih Lanjut
                    </a>
                </div>
                
            </div>
        </div>
        
    </section>
      <div class="fixed bottom-8 right-8 z-50 opacity-0 animate-fadeInUp" style="animation-delay: 1.2s;">
            <div class="relative group">
                <div class="absolute inset-0 shadow-lg shadow-cyan-100 bg-blue1 rounded-full blur opacity-75 group-hover:opacity-100 transition duration-300"></div>
                <div class="relative bg-blue1 hover:from-blue-600 hover:to-purple-600 transition-all duration-300 w-[70px] h-[70px] flex items-center justify-center rounded-full shadow-2xl cursor-pointer transform hover:scale-110 group">
                    <i class="ri-chat-3-line text-white text-[32px]" id="chat-icon"></i>
                    
                    <!-- Notification badge -->
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center animate-pulse">
                        <span class="text-white text-xs font-bold">!</span>
                    </div>
                    
                    <!-- Tooltip -->
                    <div class="absolute right-full mr-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-lg text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                        Butuh Bantuan?
                        <div class="absolute left-full top-1/2 transform -translate-y-1/2 border-4 border-transparent border-l-gray-800"></div>
                    </div>
                </div>
            </div>
        </div>

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
        }
    </style>

    @include('all.component.about')

    @include('all.component.fitur')

    @include('all.component.donasi')
   
    @include('all.component.map')

    @include('all.component.artikel')
    <!-- Chatbot Modal -->
    @include('all.component.chatbot')

@endsection
