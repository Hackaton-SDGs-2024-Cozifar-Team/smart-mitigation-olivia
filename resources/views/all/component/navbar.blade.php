<nav class="bg-blue1 text-blue4 border-gray-200 dark:bg-gray-900 z-[999] shadow-lg">
    <div class="w-full px-[30px] md:px-[150px] flex flex-wrap items-center justify-between mx-auto py-5">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse group">

            <span class="self-center text-2xl font-bold whitespace-nowrap dark:text-white">Smart Mitigation</span>
        </a>
        
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-blue4 rounded-lg md:hidden focus:outline-none focus:ring-2 focus:ring-blue-300 transition-colors duration-300"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-2 rtl:space-x-reverse md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                
                <!-- Home Dropdown -->
                <li class="relative group">
                    <button class="flex items-center justify-between w-full py-2 px-4 text-blue4 md md:border-0 md:hover:text-white md:p-3 md:w-auto rounded-lg transition-all duration-300 group-hover:scale-105">
                        {{-- <i class="fas fa-home mr-2"></i> --}}
                        Home
                        <svg class="w-2.5 h-2.5 ms-2.5 group-hover:rotate-180 transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    
                    <div class="absolute top-full left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 z-50">
                        <div class="py-2">
                            <a href="/#about-page" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-info-circle mr-3 text-blue-500"></i>
                                <span>Tentang Kami</span>
                            </a>
                            <a href="/#fitur-page" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-cogs mr-3 text-green-500"></i>
                                <span>Fitur</span>
                            </a>
                            <a href="/#donasi" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-heart mr-3 text-red-500"></i>
                                <span>Donasi</span>
                            </a>
                            <a href="/#tampilanMap" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-map-marked-alt mr-3 text-purple-500"></i>
                                <span>Peta Bencana</span>
                            </a>
                            <a href="/#articles" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-newspaper mr-3 text-orange-500"></i>
                                <span>Berita</span>
                            </a>
                        </div>
                    </div>
                </li>
                
                <!-- Fitur Dropdown -->
                <li class="relative group">
                    <button class="flex items-center justify-between w-full py-2 px-4 text-blue4 md md:border-0 md:hover:text-white md:p-3 md:w-auto rounded-lg transition-all duration-300 group-hover:scale-105">
                        {{-- <i class="fas fa-cogs mr-2"></i> --}}
                        Fitur
                        <svg class="w-2.5 h-2.5 ms-2.5 group-hover:rotate-180 transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    
                    <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 z-50">
                        <div class="py-2">
                            <a href="{{ route('prediksi-bencana') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-brain mr-3 text-purple-500"></i>
                                <span>Prediksi Bencana</span>
                            </a>
                            <a href="{{ route('clustering-banjir') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-project-diagram mr-3 text-indigo-500"></i>
                                <span>Clustering Banjir</span>
                            </a>
                            <a href="/#peta-sebaran" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-map-marked-alt mr-3 text-red-500"></i>
                                <span>Peta Sebaran Bencana</span>
                            </a>
                            <a href="{{ route('tutupan-lahan') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-leaf mr-3 text-green-500"></i>
                                <span>Tutupan Lahan</span>
                            </a>
                            
                            <a href="{{ route('pelaporan-bencana') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors duration-200">
                                <i class="fas fa-exclamation-triangle mr-3 text-orange-500"></i>
                                <span>Laporan Bencana</span>
                            </a>
                            <a href="/#donasi" class="flex items-center px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-colors duration-200">
                                <i class="fas fa-heart mr-3 text-pink-500"></i>
                                <span>Donasi Bencana</span>
                            </a>
                        </div>
                    </div>
                </li>

                 <!-- riwayat Dropdown -->
                <li class="relative group">
                    <button class="flex items-center justify-between w-full py-2 px-4 text-blue4 md md:border-0 md:hover:text-white md:p-3 md:w-auto rounded-lg transition-all duration-300 group-hover:scale-105">
                         {{-- <i class="fas fa-project-diagram mr-3 "></i> --}}
                        Riwayat
                        <svg class="w-2.5 h-2.5 ms-2.5 group-hover:rotate-180 transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    
                    <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 z-50">
                        <div class="py-2">
                            <a href="{{ route('riwayat-bencana') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-map-marked-alt mr-3 text-red-500"></i>
                                <span>Riwayat Bencana</span>
                            </a>
                            <a href="{{ route('riwayat-donasi') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-colors duration-200">
                                <i class="fas fa-heart mr-3 text-pink-500"></i>
                                <span>Riwayat Donasi</span>
                            </a>
                        </div>
                    </div>
                </li>
                
                <!-- Pelaporan Bencana -->
                <li>
                    <a href="{{ route('pelaporan-bencana') }}" class="flex items-center py-2 px-4 text-blue4 md md:border-0 md:hover:text-white md:p-3 rounded-lg transition-all duration-300 hover:scale-105">
                        {{-- <i class="fas fa-exclamation-triangle mr-2"></i> --}}
                        Laporan Bencana
                    </a>
                </li>
                
                <!-- Login/Logout -->
                @auth
                <li class="relative group">
                    <button class="flex items-center py-2 px-4 text-blue4 hover:bg-blue-700 md:hover:bg-blue-700 md:border-0 md:hover:text-white md:p-3 rounded-lg transition-all duration-300 hover:scale-105">
                        <div class="w-8 h-8 bg-blue4 rounded-full flex items-center justify-center mr-2">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="font-medium">{{ Auth::user()->name ?? 'User' }}</span>
                        <svg class="w-2.5 h-2.5 ms-2.5 group-hover:rotate-180 transition-transform duration-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    
                    <div class="absolute top-full right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 z-50">
                        <div class="py-2">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm text-gray-500">Signed in as</p>
                                <p class="text-sm font-medium text-gray-800 truncate">{{ Auth::user()->nama ?? 'User' }}</p>
                                @if(Auth::user()->email)
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                @endif
                            </div>
                            <a href="/profile" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-user-circle mr-3 text-blue-500"></i>
                                <span>Profile</span>
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="/logout" class="flex items-center px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                                <i class="fas fa-sign-out-alt mr-3 text-red-500"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </li>
                @else
                <li>
                    <a href="/login" class="flex items-center py-2 px-4 bg-blue4 hover:bg-blue-300 text-blue1 rounded-lg transition-all duration-300 hover:scale-105 shadow-md">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
/* Enhanced dropdown styles */
.group:hover .group-hover\:opacity-100 {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Mobile menu improvements */
@media (max-width: 768px) {
    .group .absolute {
        position: static;
        opacity: 1;
        visibility: visible;
        transform: none;
        box-shadow: none;
        border: none;
        background: transparent;
        margin: 0;
        width: 100%;
    }
    
    .group .absolute .py-2 {
        padding: 0;
    }
    
    .group .absolute a {
        padding-left: 2rem;
        border-left: 2px solid #3B82F6;
        margin-left: 1rem;
    }
    
    /* Hide dropdown by default on mobile */
    .group .absolute {
        display: none;
    }
    
    /* Show dropdown when parent is clicked on mobile */
    .group.active .absolute {
        display: block;
    }
}

/* Smooth transitions */
* {
    scroll-behavior: smooth;
}

/* Active state indicator */
.nav-active {
    background-color: rgba(59, 130, 246, 0.1);
    color: #3B82F6 !important;
    border-left: 3px solid #3B82F6;
}
</style>

<script>
// Mobile dropdown toggle
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuButton = document.querySelector('[data-collapse-toggle="navbar-default"]');
    const mobileMenu = document.getElementById('navbar-default');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // Mobile dropdown functionality
    const dropdownButtons = document.querySelectorAll('.group button');
    dropdownButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (window.innerWidth < 768) {
                e.preventDefault();
                const parent = this.closest('.group');
                parent.classList.toggle('active');
                
                // Close other dropdowns
                dropdownButtons.forEach(otherButton => {
                    if (otherButton !== this) {
                        otherButton.closest('.group').classList.remove('active');
                    }
                });
            }
        });
    });
    
    // Highlight active section
    function highlightActiveSection() {
        const sections = ['about', 'fitur', 'donasi', 'tampilanMap', 'articles'];
        const navLinks = document.querySelectorAll('a[href^="/#"]');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.id;
                    navLinks.forEach(link => {
                        link.classList.remove('nav-active');
                        if (link.getAttribute('href') === `/#${id}`) {
                            link.classList.add('nav-active');
                        }
                    });
                }
            });
        }, { threshold: 0.3 });
        
        sections.forEach(section => {
            const element = document.getElementById(section);
            if (element) {
                observer.observe(element);
            }
        });
    }
    
    // Initialize active section highlighting
    if (window.location.pathname === '/') {
        highlightActiveSection();
    }
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('nav') && !mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.add('hidden');
        }
    });
});
</script>
