@extends('all.layout.index')

@section('title', 'Detail Artikel - Smart Mitigation')

@section('landing')
<div class="min-h-screen bg-gray-50 pt-16">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue1 to-blue1 text-white py-14">
        <div class="max-w-4xl mx-auto px-6">
            <div class="flex items-center mb-4">
                <a href="/" class="text-white hover:text-blue-200 mr-4">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <span class="text-blue-200">Kembali ke Beranda</span>
            </div>
            <div id="article-header" class="opacity-0">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="max-w-4xl mx-auto px-6 py-12">
        <div id="article-content" class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Loading state -->
            <div id="loading-content" class="flex items-center justify-center py-20">
                <div class="text-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                    <p class="text-gray-600">Memuat artikel...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Get article ID from URL parameters
const urlParams = new URLSearchParams(window.location.search);
const articleId = urlParams.get('id');

// Use same cache keys as main article component
const CACHE_KEY = 'smart_mitigation_articles';
const CACHE_EXPIRY_KEY = 'smart_mitigation_articles_expiry';

async function loadArticleDetail() {
    const headerElement = document.getElementById('article-header');
    const contentElement = document.getElementById('article-content');
    const loadingElement = document.getElementById('loading-content');
    
    try {
        let article;
        
        // First try to get from cache
        const cachedArticles = getCachedArticles();
        if (cachedArticles && cachedArticles[articleId - 1]) {
            console.log('Loading article from cache');
            article = cachedArticles[articleId - 1];
        } else {
            console.log('Article not in cache, fetching from API');
            
            // Fetch articles from API
            const response = await fetch('/gemini-articles', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    topic: 'bencana alam di Jember',
                    count: 10
                })
            });
            
            if (response.ok) {
                const data = await response.json();
                const articles = data.articles || [];
                
                // Cache the articles
                setCachedArticles(articles);
                
                article = articles[articleId - 1] || articles[0];
            }
        }
        
        // Fallback to sample data if API fails and no cache
        if (!article) {
            const sampleArticles = [
                {
                    title: 'Banjir Melanda 3 Kecamatan di Jember, Ratusan Rumah Terendam',
                    summary: 'Hujan deras yang terjadi sejak kemarin malam menyebabkan banjir di Kecamatan Sumbersari, Kaliwates, dan Patrang. Ketinggian air mencapai 50-80 cm.',
                    content: 'Banjir kembali melanda Kabupaten Jember setelah hujan deras terjadi selama 8 jam berturut-turut sejak Selasa (15/1/2024) malam. Tiga kecamatan yang paling terdampak adalah Sumbersari, Kaliwates, dan Patrang dengan ketinggian air mencapai 50-80 cm di pemukiman warga.\n\nBPBD Jember telah mengerahkan tim SAR dan perahu karet untuk evakuasi warga yang terdampak. Sebanyak 150 kepala keluarga telah dievakuasi ke posko pengungsian yang disiapkan di gedung sekolah dan balai desa. Pihak berwenang juga mendirikan dapur umum untuk memenuhi kebutuhan makan para pengungsi.\n\nBanjir ini disebabkan oleh intensitas curah hujan yang tinggi dalam waktu singkat, ditambah dengan kondisi drainase yang kurang memadai di beberapa titik. Pemerintah daerah telah mengalokasikan bantuan darurat berupa makanan, obat-obatan, dan peralatan kebersihan untuk para korban.',
                    author: 'Tim Liputan Radar Jember',
                    publishedDate: new Date().toISOString().split('T')[0],
                    category: 'Banjir',
                    url: 'https://news-jember.com/banjir-melanda-3-kecamatan-jember'
                },
                {
                    title: 'Longsor Terjadi di Lereng Gunung Argopuro, Akses Jalan Terputus',
                    summary: 'Tanah longsor akibat hujan deras menutup jalan penghubung Kecamatan Sukorambi dengan Kecamatan Jelbuk. Tidak ada korban jiwa.',
                    content: 'Tanah longsor terjadi di lereng Gunung Argopuro, tepatnya di perbatasan Kecamatan Sukorambi dan Jelbuk, Kabupaten Jember pada Rabu (16/1/2024) dini hari. Longsor dipicu oleh hujan deras yang melanda kawasan tersebut selama beberapa hari terakhir.\n\nMaterial tanah dan batuan menutupi jalan sepanjang 200 meter dengan ketebalan mencapai 2 meter, sehingga akses transportasi antara kedua kecamatan terputus total. Meskipun tidak ada korban jiwa, kejadian ini berdampak pada aktivitas ekonomi warga karena jalur distribusi barang terhambat.\n\nTim BPBD Jember bekerja sama dengan Dinas PU sedang melakukan pembersihan material longsor menggunakan alat berat. Pembersihan diprediksi akan memakan waktu 2-3 hari karena volume material yang cukup besar dan akses yang terbatas.',
                    author: 'Koresponden Jember Post',
                    publishedDate: new Date(Date.now() - 86400000).toISOString().split('T')[0],
                    category: 'Longsor',
                    url: 'https://jember-news.com/longsor-gunung-argopuro-jalan-terputus'
                }
            ];
            article = sampleArticles[articleId - 1] || sampleArticles[0];
        }
        
        // Update header
        headerElement.innerHTML = `
            <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold mb-6">
                <i class="${getIconByCategory(article.category)} mr-2"></i>
                ${article.category}
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">${article.title}</h1>
            <div class="flex items-center space-x-6 text-blue-200">
                <div class="flex items-center">
                    <i class="fas fa-user mr-2"></i>
                    <span>${article.author}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span>${formatDate(article.publishedDate)}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    <span>${article.readTime} menit baca</span>
                </div>
            </div>
        `;
        
        // Update content
        contentElement.innerHTML = `
            <div class="p-8">
                <!-- Summary -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-r-lg mb-8">
                    <h3 class="text-lg font-semibold text-blue-800 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>Ringkasan
                    </h3>
                    <p class="text-blue-700 leading-relaxed">${article.summary}</p>
                </div>
                
                <!-- Main Content -->
                <div class="prose prose-lg max-w-none mb-8">
                    <div class="text-gray-700 leading-relaxed space-y-4">
                        ${formatArticleContent(article.content)}
                    </div>
                </div>
                
                <!-- Emergency Contact -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
                    <h4 class="text-lg font-semibold text-yellow-800 mb-3 flex items-center">
                        <i class="fas fa-phone-alt mr-2"></i>Kontak Darurat
                    </h4>
                    <div class="grid md:grid-cols-3 gap-4 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-ambulance text-red-600 mr-2"></i>
                            <span class="text-gray-700">PMI: 112</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-fire-extinguisher text-red-600 mr-2"></i>
                            <span class="text-gray-700">Damkar: 113</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt text-blue-600 mr-2"></i>
                            <span class="text-gray-700">BPBD Jember: (0331) 123456</span>
                        </div>
                    </div>
                </div>
            
                
                <!-- Actions -->
                <div class="flex flex-wrap justify-center gap-4 pt-6 border-t border-gray-200">
                    <button onclick="shareArticle('${escapeQuotes(article.title)}')" 
                            class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-share-alt mr-2"></i>
                        Bagikan
                    </button>
                    <button onclick="printArticle()" 
                            class="flex items-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-print mr-2"></i>
                        Cetak
                    </button>
                    <button onclick="window.history.back()" 
                            class="flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </button>
                </div>
            </div>
        `;
        
        // Show content with animation
        headerElement.classList.add('animate-fadeInUp');
        loadingElement.style.display = 'none';
        
    } catch (error) {
        console.error('Error loading article:', error);
        contentElement.innerHTML = `
            <div class="text-center py-20">
                <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                <p class="text-red-600 mb-4">Gagal memuat artikel</p>
                <button onclick="window.history.back()" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                    Kembali
                </button>
            </div>
        `;
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
            return null;
        }
        
        return JSON.parse(cachedData);
    } catch (error) {
        console.error('Error reading cache:', error);
        return null;
    }
}

function setCachedArticles(articles) {
    try {
        const CACHE_DURATION = 30 * 60 * 1000; // 30 minutes
        const now = new Date().getTime();
        const expiryTime = now + CACHE_DURATION;
        
        localStorage.setItem(CACHE_KEY, JSON.stringify(articles));
        localStorage.setItem(CACHE_EXPIRY_KEY, expiryTime.toString());
        
        console.log('Articles cached successfully');
    } catch (error) {
        console.error('Error caching articles:', error);
    }
}

// Helper functions
function getIconByCategory(category) {
    const icons = {
        'Banjir': 'fas fa-water',
        'Longsor': 'fas fa-mountain',
        'Gempa': 'fas fa-house-crack',
        'Angin Kencang': 'fas fa-wind',
        'Kekeringan': 'fas fa-sun',
        'Kebakaran Hutan': 'fas fa-fire',
        'default': 'fas fa-newspaper'
    };
    return icons[category] || icons.default;
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

function formatArticleContent(content) {
    const paragraphs = content.split('\n').filter(p => p.trim() !== '');
    return paragraphs.map(paragraph => `<p class="mb-4 text-justify">${paragraph}</p>`).join('');
}

function generateImpactList(category) {
    const impacts = {
        'Banjir': [
            '<li>• Ratusan rumah terendam air</li>',
            '<li>• Akses jalan terputus</li>',
            '<li>• Gangguan listrik dan komunikasi</li>',
            '<li>• Warga mengungsi ke tempat aman</li>'
        ],
        'Longsor': [
            '<li>• Jalan utama tertutup material</li>',
            '<li>• Transportasi terganggu</li>',
            '<li>• Rumah warga terancam</li>',
            '<li>• Akses ekonomi terhambat</li>'
        ],
        'default': [
            '<li>• Kerusakan infrastruktur</li>',
            '<li>• Gangguan aktivitas masyarakat</li>',
            '<li>• Kerugian ekonomi</li>',
            '<li>• Dampak lingkungan</li>'
        ]
    };
    return (impacts[category] || impacts['default']).join('');
}

function generateResponseList(category) {
    const responses = {
        'Banjir': [
            '<li>• Tim SAR dikerahkan untuk evakuasi</li>',
            '<li>• Posko pengungsian disiapkan</li>',
            '<li>• Dapur umum beroperasi</li>',
            '<li>• Bantuan logistik disalurkan</li>'
        ],
        'Longsor': [
            '<li>• Alat berat diberdayakan</li>',
            '<li>• Jalur alternatif dibuka</li>',
            '<li>• Tim pembersihan bekerja</li>',
            '<li>• Monitoring lokasi rawan</li>'
        ],
        'default': [
            '<li>• Tim tanggap darurat diaktifkan</li>',
            '<li>• Koordinasi antar instansi</li>',
            '<li>• Bantuan darurat disalurkan</li>',
            '<li>• Monitoring situasi berkelanjutan</li>'
        ]
    };
    return (responses[category] || responses['default']).join('');
}

function escapeQuotes(text) {
    return text.replace(/'/g, '&#39;').replace(/"/g, '&quot;');
}

function shareArticle(title) {
    if (navigator.share) {
        navigator.share({
            title: title,
            text: 'Baca berita bencana terbaru di Smart Mitigation',
            url: window.location.href
        });
    } else {
        const url = window.location.href;
        const text = `${title} - ${url}`;
        navigator.clipboard.writeText(text).then(() => {
            alert('Link artikel telah disalin ke clipboard!');
        }).catch(() => {
            prompt('Salin link berikut:', `${title} - ${url}`);
        });
    }
}

function printArticle() {
    window.print();
}

// Load article when page loads
document.addEventListener('DOMContentLoaded', loadArticleDetail);
</script>

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

@media print {
    .no-print {
        display: none !important;
    }
}
</style>
@endsection
