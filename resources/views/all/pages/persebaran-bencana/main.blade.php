@extends('all.layout.index')

@section('title', 'Landing Page')
@section('landing')
<section class="flex flex-col lg:flex-row items-start bg-grey2 px-6 md:px-12 lg:px-[100px] py-12 lg:py-[100px] gap-8">
    <!-- Sidebar -->
    <div class="w-full lg:w-1/4 flex flex-col gap-8 rounded-lg">
        <!-- Statistika Lahan -->
        <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg">
            <div class="mb-5">
                <h2 class="text-center text-lg md:text-xl text-gray-600 font-semibold">
                    <i class="ri-line-chart-fill me-2"></i>Statistika Lahan
                </h2>
                <p class="text-gray-400 text-sm">Detail presentase statistika lahan via satelit</p>
            </div>
            <div>
                <div class="text-center border border-red-700 py-4 rounded-lg bg-red-50">
                    <p class="text-lg font-semibold text-red-800">{{ $jumlah_laporan }}</p>
                    <p class="text-sm text-red-800">Kejadian Aktif</p>
                </div>
                <div class="flex flex-col sm:flex-row justify-between mt-4 gap-4">
                    <div class="w-full text-center border border-yellow-400 py-4 rounded-lg bg-yellow-50">
                        <p class="text-lg font-semibold text-yellow-400">{{ $jumlah_posko }}</p>
                        <p class="text-sm text-yellow-400">Posko</p>
                    </div>
                    <div class="w-full text-center border border-blue-700 py-4 rounded-lg bg-blue-50">
                        <p class="text-lg font-semibold text-blue-800">{{ $jumlah_donasi }}</p>
                        <p class="text-sm text-blue-800">Jumlah Donasi</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kejadian Terbaru -->
        <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg">
            <div class="mb-5">
                <h2 class="text-center text-lg md:text-xl text-gray-600 font-semibold">
                    <i class="ri-line-chart-fill me-2"></i>Kejadian Terbaru
                </h2>
                <p class="text-gray-400 text-sm">Detail presentase statistika lahan via satelit</p>
            </div>
            <div>
                <div class="flex justify-start px-4 text-center border border-grey-700 py-4 rounded-lg bg-gray-50">
                    {{-- @foreach ($laporan as $lap)
                        
                    @endforeach --}}
                    <div class="flex items-center justify-between w-full gap-3">
                        <div class="flex items-center gap-3">
                            <i class="ri-flood-fill text-lg"></i>
                            <div class="flex flex-col items-start">
                                <p class="font-semibold">{{ $laporan[0]->nama_bencana }}</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($laporan[0]->tanggal_kejadian)->format('j/n/Y') }}</p>

                            </div>
                        </div>
                        <div class="px-4 py-1 bg-red-600 rounded-lg text-white text-sm">{{ $laporan[0]->tingkat_bencana }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full lg:w-3/4">
        <div class="flex flex-col p-6 md:p-8 bg-white shadow-lg rounded-lg text-center mb-5">
            <h2 class="text-lg md:text-xl text-gray-600 font-semibold">
                <i class="ri-tree-fill me-2"></i>Peta Persebaran Bencana
            </h2>
            <p class="text-gray-400 text-sm">Visualisasi real-time kejadian bencana alam di seluruh Indonesia</p>
            <div id="map" class="h-[300px] md:h-[400px] lg:h-[600px] z-0 mt-4 w-full"></div>
        </div>

        <!-- Button Group -->
        <div class="flex flex-wrap justify-center gap-2 text-sm font-medium text-gray-700 mt-2">
            <button class="px-4 py-2 border rounded-lg active-btn active" id="btnPrediksi" type="button">
                Analisis Bencana
            </button>
            <button class="px-4 py-2 border rounded-lg hover:bg-gray-100" id="btnLaporan" type="button">
                Respon Bencana
            </button>
        </div>

        <!-- Timeline & Statistik -->
        <div class="mt-6 space-y-6">
            <!-- Map Prediksi -->
            <div id="mapPrediksi" class="h-[300px] md:h-[400px] lg:h-[600px] p-6 bg-white rounded-lg shadow-lg">
                <p class="font-bold text-gray-700 text-xl">Timeline Kejadian Bencana</p>
                <p class="text-sm text-gray-500">Kronologi kejadian bencana dalam 30 hari terakhir</p>
            </div>

            <!-- Map Laporan -->
            <div id="mapLaporan" class="flex flex-col lg:flex-row gap-6">
                <!-- Statistik Kiri -->
                <div class="bg-white rounded-lg w-full lg:w-1/2 p-6 shadow-lg">
                    <div class="mb-5">
                        <h2 class="text-center text-lg text-gray-600 font-semibold">
                            <i class="ri-line-chart-fill me-2"></i>Statistika Lahan
                        </h2>
                        <p class="text-gray-400 text-sm">Detail presentase statistika lahan via satelit</p>
                    </div>
                    <div class="flex flex-col gap-6">
                        <!-- Ulangi card-statistik -->
                        <template id="stat-card">
                            <div class="card-statistik">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-4 h-4 bg-green-600 rounded-full"></div>
                                        <p class="font-semibold text-gray-600">Hutan</p>
                                    </div>
                                    <p class="font-semibold text-gray-600">45.2%</p>
                                </div>
                                <div class="relative w-full mt-4 h-3 bg-blue4 rounded-full overflow-hidden">
                                    <div class="absolute left-0 top-0 h-3 bg-blue1 rounded-l-full w-[200px]"></div>
                                </div>
                            </div>
                        </template>
                        <!-- kamu bisa duplikat stat-card ini dengan warna/icon berbeda -->
                    </div>
                </div>

                <!-- Grafik Users -->
                <div class="bg-white rounded-lg w-full lg:w-1/2 p-6 shadow-lg">
                    <div class="max-w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4">
                        <div class="flex justify-between">
                            <div>
                                <h5 class="text-3xl font-bold text-gray-900 dark:text-white pb-2">32.4k</h5>
                                <p class="text-base text-gray-500 dark:text-gray-400">Users this week</p>
                            </div>
                            <div class="flex items-center text-green-500 text-base font-semibold">
                                12%
                                <svg class="w-3 h-3 ms-1" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M5 13V1M5 1L1 5M5 1L9 5"/>
                                </svg>
                            </div>
                        </div>
                        <div id="area-chart" class="mt-4"></div>
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-5 flex justify-between items-center">
                            <button class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900">
                                Last 7 days
                                <svg class="w-3 h-3 ml-1" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M1 1l4 4 4-4" />
                                </svg>
                            </button>
                            <a href="#" class="uppercase text-sm font-semibold text-blue-600 hover:text-blue-700">
                                Users Report
                                <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="m1 9 4-4-4-4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>

<script>
    // Inisialisasi peta Leaflet
        var map = L.map('map').setView([-8.1845, 113.7023], 13); // Koordinat Jember, Indonesia

        // Layer OpenStreetMap (default base layer)
        var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        // URL tile dari Google Earth Engine
        var geeTileUrl ="https://earthengine.googleapis.com/v1/projects/ee-e41221681/maps/67b09bd6bf20d7d9f6d3df5fcc2a0ca8-34eb940a5c5f5331e5d267f19cf89118/tiles/{z}/{x}/{y}";

        // Layer Google Earth Engine
        var geeLayer = L.tileLayer(geeTileUrl, {
            attribution: '&copy; <a href="https://earthengine.google.com/">Google Earth Engine</a>',
            maxZoom: 18
        });
        // URL tile dari Google Earth Engine
        var sentineTileUrl =
            "https://earthengine.googleapis.com/v1/projects/ee-e41221681/maps/512731c07594250020230278aedb8b22-e306804e3e850fa31ba11e06453a37f5/tiles/{z}/{x}/{y}";

        // Layer Google Earth Engine
        var sentineLayer = L.tileLayer(sentineTileUrl, {
            attribution: '&copy; <a href="https://earthengine.google.com/">Google Earth Engine</a>',
            maxZoom: 18
        });

$.ajax({
    url: "/api/bencana",
    method: "GET",
    success: function(data) {
        // console.log(data);

        data.forEach(element => {
            // Mengambil koordinat dari setiap elemen data
            var lat = element.latitude;
            var lng = element.longitude;

            // Menambahkan marker di posisi koordinat dari API
            var markers = L.marker([lat, lng]).addTo(map);

            // Mengikat popup dengan informasi yang sesuai untuk setiap marker
            var popupContent = "<b>" + element.nama_bencana + "</b><br>" +
                "Kerusakan: " + element.tingkat_bencana + "<br>" +
                "<a href='/detail-donasi/" + element.id_laporan_bencana +
                "' class='bg-[#dddddd] p-2 w-full text-center text-[16px] inline-block mt-4'>Lihat Detail</a>";

            // Menambahkan popup secara langsung ke posisi yang diinginkan di peta
            markers.bindPopup(popupContent);
        })
    }
})

        // Tambahkan layer OpenStreetMap sebagai layer dasar default
        osmLayer.addTo(map);

        // Opsi untuk mengontrol layer
        var baseLayers = {
            "OpenStreetMap": osmLayer // Layer dasar,
        };

        var overlayLayers = {
            "Klasifikasi GEE": geeLayer, // Layer GEE sebagai overlay
            "Klasifikasi Sentine": sentineLayer
        };
        // Tambahkan kontrol layer ke peta
        L.control.layers(baseLayers, overlayLayers).addTo(map);

        // Opsional: Menambahkan marker atau elemen lain ke peta
        // var marker = L.marker([-8.1845, 113.7023]).addTo(map);
        // marker.bindPopup("<b>Ini adalah Jember!</b>").openPopup();
</script>
<script>
    $(document).ready(function() {
        $("#mapPrediksi").show();
        $("#mapLaporan").hide();
        $("#btnPrediksi").addClass('bg-blue1 text-white');

        $("#btnPrediksi").click(function() {
            $("#btnPrediksi").addClass('bg-blue1 text-white');
            $("#btnLaporan").removeClass('bg-blue1 text-white');
            $("#mapPrediksi").show();
            $("#mapLaporan").hide();
        });
        $("#btnLaporan").click(function() {
            $("#btnLaporan").addClass('bg-blue1 text-white');
            $("#btnPrediksi").removeClass('bg-blue1 text-white');
            $("#mapPrediksi").hide();
            $("#mapLaporan").show();
        });
    });
</script>
@endsection
