<section id="articles" class="px-6 md:px-[150px] py-[120px] bg-gradient-to-br from-gray-50 to-white">
    <div class="text-center mb-16">
        <h2 class="text-[35px] md:text-[45px] font-[700] text-blue1 mb-4">Artikel Terkini</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">
            Dapatkan informasi terbaru seputar mitigasi bencana dan teknologi prediksi dari sumber terpercaya
        </p>
    </div>
    
    <div id="articles-container" class="flex flex-wrap justify-center gap-8">
        <!-- Loading placeholder -->
        <div id="loading-articles" class="text-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
            <p class="text-gray-600">Memuat Artikel terbaru...</p>
        </div>
    </div>
    
    <!-- Refresh button -->
    <div class="text-center mt-12">
        <button id="refresh-articles" 
                class="inline-flex items-center px-6 py-3 bg-blue1 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 hover:from-blue-700 hover:to-blue-800">
            <i class="fas fa-sync-alt mr-2"></i>
            Muat Artikel Baru
        </button>
    </div>
</section>

<script>
const CACHE_KEY = 'smart_mitigation_articles';
const CACHE_EXPIRY_KEY = 'smart_mitigation_articles_expiry';
const CACHE_DURATION = 30 * 60 * 1000; // 30 minutes in milliseconds

async function loadArticlesFromGemini() {
    console.log('Starting loadArticlesFromGemini...');
    
    let loadingElement = document.getElementById('loading-articles');
    const containerElement = document.getElementById('articles-container');
    
    console.log('Loading element:', loadingElement);
    console.log('Container element:', containerElement);
    
    // Check if container exists
    if (!containerElement) {
        console.error('Articles container not found');
        return;
    }
    
    // If loading element doesn't exist, create it
    if (!loadingElement) {
        console.log('Creating loading element...');
        loadingElement = document.createElement('div');
        loadingElement.id = 'loading-articles';
        loadingElement.className = 'text-center py-12';
        loadingElement.innerHTML = `
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
            <p class="text-gray-600">Memuat Artikel terbaru...</p>
        `;
        containerElement.appendChild(loadingElement);
    }
    
    try {
        loadingElement.style.display = 'block';
        
        // Check if cache exists and is not expired
        const cachedArticles = getCachedArticles();
        if (cachedArticles) {
            console.log('Loading articles from cache');
            displayArticles(cachedArticles);
            if (loadingElement) loadingElement.style.display = 'none';
            return;
        }
        
        console.log('Cache not found or expired, fetching from API');
        
        const response = await fetch('/gemini-articles', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                topic: 'mitigasi bencana alam, prediksi banjir, teknologi AI untuk bencana',
                count: 6
            })
        });
        console.log('Response status:', response);
        
        if (!response.ok) {
            throw new Error('Failed to fetch articles');
        }
        
        const data = await response.json();
        
        // Cache the articles
        setCachedArticles(data.articles);
        
        displayArticles(data.articles);
        
    } catch (error) {
        console.error('Error loading articles:', error);
        
        // Try to load from cache as fallback
        const cachedArticles = localStorage.getItem(CACHE_KEY);
        if (cachedArticles) {
            console.log('Loading from cache as fallback');
            displayArticles(JSON.parse(cachedArticles));
        } else {
            if (containerElement) {
                containerElement.innerHTML = `
                    <div class="text-center py-12 w-full">
                        <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                        <p class="text-red-600 mb-4">Gagal memuat Artikel</p>
                        <button onclick="forceRefreshArticles()" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-300 mr-2">
                            Coba Lagi
                        </button>
                        <button onclick="clearCache()" 
                                class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-300">
                            Hapus Cache
                        </button>
                    </div>
                `;
            }
        }
    } finally {
        if (loadingElement) loadingElement.style.display = 'none';
    }
}

function getCachedArticles() {
    try {
        const cachedData = localStorage.getItem(CACHE_KEY);
        const cacheExpiry = localStorage.getItem(CACHE_EXPIRY_KEY);
        
        if (!cachedData || !cacheExpiry) {
            return null;
        }
        
        const now = new Date().getTime();
        const expiryTime = parseInt(cacheExpiry);
        
        if (now > expiryTime) {
            // Cache has expired
            clearCache();
            return null;
        }
        
        return JSON.parse(cachedData);
    } catch (error) {
        console.error('Error reading cache:', error);
        clearCache();
        return null;
    }
}

function setCachedArticles(articles) {
    try {
        const now = new Date().getTime();
        const expiryTime = now + CACHE_DURATION;
        
        localStorage.setItem(CACHE_KEY, JSON.stringify(articles));
        localStorage.setItem(CACHE_EXPIRY_KEY, expiryTime.toString());
        
        console.log('Articles cached successfully');
    } catch (error) {
        console.error('Error caching articles:', error);
    }
}

function clearCache() {
    localStorage.removeItem(CACHE_KEY);
    localStorage.removeItem(CACHE_EXPIRY_KEY);
    console.log('Cache cleared');
}

function forceRefreshArticles() {
    clearCache();
    loadArticlesFromGemini();
}

function getCacheInfo() {
    const cachedData = localStorage.getItem(CACHE_KEY);
    const cacheExpiry = localStorage.getItem(CACHE_EXPIRY_KEY);
    
    if (!cachedData || !cacheExpiry) {
        return { hasCache: false };
    }
    
    const now = new Date().getTime();
    const expiryTime = parseInt(cacheExpiry);
    const timeLeft = Math.max(0, expiryTime - now);
    const minutesLeft = Math.floor(timeLeft / (1000 * 60));
    
    return {
        hasCache: true,
        isExpired: now > expiryTime,
        minutesLeft: minutesLeft,
        articlesCount: JSON.parse(cachedData).length
    };
}

function getIconByCategory(category) {
    const icons = {
        'AI': 'fas fa-brain',
        'Teknologi': 'fas fa-microchip',
        'Prediksi': 'fas fa-chart-line',
        'Mitigasi': 'fas fa-shield-alt',
        'IoT': 'fas fa-wifi',
        'Sensor': 'fas fa-satellite-dish',
        'Banjir': 'fas fa-water',
        'Cuaca': 'fas fa-cloud-rain',
        'GIS': 'fas fa-map-marked-alt',
        'default': 'fas fa-newspaper'
    };
    
    for (let key in icons) {
        if (category && category.toLowerCase().includes(key.toLowerCase())) {
            return icons[key];
        }
    }
    return icons.default;
}

function getColorByCategory(category) {
    const colors = {
        'AI': 'from-[#283F50] to-[#1f323f]',
        'Teknologi': 'from-[#283F50] to-[#1f323f]',
        'Prediksi': 'from-[#283F50] to-[#1f323f]',
        'Mitigasi': 'from-[#283F50] to-[#1f323f]',
        'IoT': 'from-[#283F50] to-[#1f323f]',
        'Sensor': 'from-[#283F50] to-[#1f323f]',
        'Banjir': 'from-[#283F50] to-[#1f323f]',
        'Cuaca': 'from-[#283F50] to-[#1f323f]',
        'GIS': 'from-[#283F50] to-[#1f323f]',
        'default': 'from-[#283F50] to-[#1f323f]'
    };
    
    for (let key in colors) {
        if (category && category.toLowerCase().includes(key.toLowerCase())) {
            return colors[key];
        }
    }
    return colors.default;
}

function displayArticles(articles) {
    const container = document.getElementById('articles-container');
    
    if (!container) {
        console.error('Articles container not found');
        return;
    }
    
    console.log('Displaying articles:', articles);
    
    // Store articles in global cache for detail page access
    window.currentArticles = articles;
    
    // Clear container first
    container.innerHTML = '';
    
    // Add articles
    const articlesHTML = articles.map((article, index) =>
    `
        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden w-full md:w-[350px] transition-all duration-500 hover:scale-105 hover:-translate-y-2 opacity-0 animate-fadeInUp" 
             style="animation-delay: ${index * 0.1}s;">
            <!-- Icon header instead of image -->
            <div class="relative h-32 bg-gradient-to-br ${getColorByCategory(article.category)} flex items-center justify-center">
                <i class="${getIconByCategory(article.category)} text-6xl text-white opacity-90 group-hover:scale-110 transition-transform duration-300"></i>
                <div class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs font-semibold">
                    ${article.category || 'Mitigasi Bencana'}
                </div>
                <!-- Decorative elements -->
                <div class="absolute top-2 right-2 w-8 h-8 border-2 border-white/30 rounded-full"></div>
                <div class="absolute bottom-2 left-2 w-6 h-6 border-2 border-white/20 rounded-full"></div>
            </div>
            
            <div class="p-6">
                <div class="flex items-center text-xs text-gray-500 mb-3">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span>${formatDate(article.publishedDate || new Date())}</span>
                    <span class="mx-2">•</span>
                    <i class="fas fa-clock mr-1"></i>
                    <span>${article.readTime || '5'} min baca</span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                    ${article.title}
                </h3>
                 <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                    ${article.summary || article.content}
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-xs text-gray-500">
                        <div class="w-6 h-6 bg-[#283F50] rounded-full flex items-center justify-center mr-2">
                            <i class="fas fa-user text-white text-xs"></i>
                        </div>
                        <span>${article.author || 'Admin Smart Mitigation'}</span>
                    </div>
                    <a href="/artikel/detail?id=${index + 1}" 
                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-sm transition-colors duration-300 group/link">
                        Baca Selengkapnya
                        <i class="fas fa-arrow-right ml-2 transform group-hover/link:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>
        </div>
    `).join('');
    
    container.innerHTML = articlesHTML;
}

function formatDate(date) {
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        timeZone: 'Asia/Jakarta'
    };
    return new Date(date).toLocaleDateString('id-ID', options);
}

// Add CSS for line-clamp and animations
const style = document.createElement('style');
style.textContent = `
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
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
        animation: fadeInUp 0.8s ease-out forwards;
    }
`;
document.head.appendChild(style);

// Load articles when page loads
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM Content Loaded');
    console.log('Document ready state:', document.readyState);
    
    // Wait a bit to ensure all elements are rendered
    setTimeout(() => {
        console.log('Attempting to load articles after timeout');
        loadArticlesFromGemini();
        
        // Show cache info in console for debugging
        const cacheInfo = getCacheInfo();
        if (cacheInfo.hasCache) {
            console.log(`Cache info: ${cacheInfo.articlesCount} articles, ${cacheInfo.minutesLeft} minutes left`);
        }
        
        // Setup refresh button event listener after DOM is loaded
        const refreshButton = document.getElementById('refresh-articles');
        console.log('Refresh button found:', refreshButton);
        
        if (refreshButton) {
            refreshButton.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Refresh button clicked');
                
                const cacheInfo = getCacheInfo();
                
                if (cacheInfo.hasCache && !cacheInfo.isExpired) {
                    // Show confirmation dialog if cache is still valid
                    if (confirm(`Cache masih valid (${cacheInfo.minutesLeft} menit tersisa). Tetap refresh dari server?`)) {
                        forceRefreshArticles();
                    } else {
                        // Just reload from cache
                        loadArticlesFromGemini();
                    }
                } else {
                    // Cache is expired or doesn't exist, fetch new data
                    forceRefreshArticles();
                }
            });
            
            // Add cache status indicator
            setInterval(() => {
                const cacheInfo = getCacheInfo();
                
                if (cacheInfo.hasCache && !cacheInfo.isExpired) {
                    refreshButton.title = `Cache tersedia (${cacheInfo.minutesLeft} menit tersisa)`;
                    refreshButton.classList.add('opacity-75');
                } else {
                    refreshButton.title = 'Tidak ada cache atau cache sudah expired';
                    refreshButton.classList.remove('opacity-75');
                }
            }, 10000); // Update every 10 seconds
        } else {
            console.error('Refresh button not found');
        }
    }, 200); // Increased timeout to 200ms
});

// Additional fallback - try to load articles when window loads
window.addEventListener('load', () => {
    console.log('Window loaded');
    const loadingElement = document.getElementById('loading-articles');
    const containerElement = document.getElementById('articles-container');
    
    if (!loadingElement || !containerElement) {
        console.log('Elements still not found on window load, trying again...');
        setTimeout(() => {
            loadArticlesFromGemini();
        }, 300);
    }
});
</script>