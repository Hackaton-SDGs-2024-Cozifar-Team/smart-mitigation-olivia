@extends('all.layout.index')

@section('title', 'Landing Page')
@section('landing')
<section class="flex flex-col lg:flex-row items-start bg-grey2 px-5 sm:px-10 lg:px-[100px] py-10 lg:py-[100px] gap-8">
    <!-- Sidebar -->
    <div class="w-full lg:w-[25%] flex flex-col gap-8 rounded-lg shadow-lg">
        <div class="bg-white p-6 sm:p-8 rounded-lg">
            <div class="mb-5">
                <h2 class="text-center text-lg sm:text-xl text-gray-600 font-semibold">
                    <i class="ri-line-chart-fill me-2"></i>Statistika Lahan
                </h2>
                <p class="text-gray-400 text-sm">Detail presentase statistika lahan via satelit</p>
            </div>
            <div class="flex flex-col gap-y-8">
                <!-- Card Statistik -->
                <div class="card-statistik">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 bg-green-600 rounded-full"></div>
                            <p class="font-semibold text-gray-600 text-sm sm:text-base">Lahan Kosong</p>
                        </div>
                        <p class="font-semibold text-gray-600 text-sm sm:text-base">63.7%</p>
                    </div>
                    <div class="relative mt-3">
                        <div class="w-full h-3 bg-blue4 rounded-full"></div>
                        <div class="h-3 bg-blue1 rounded-l-full absolute top-0 left-0 w-[63.7%]"></div>
                    </div>
                </div>
                <div class="card-statistik">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 bg-red-600 rounded-full"></div>
                            <p class="font-semibold text-gray-600 text-sm sm:text-base">Tutupan Lahan</p>
                        </div>
                        <p class="font-semibold text-gray-600 text-sm sm:text-base">30%</p>
                    </div>
                    <div class="relative mt-3">
                        <div class="w-full h-3 bg-blue4 rounded-full"></div>
                        <div class="h-3 bg-blue1 rounded-l-full absolute top-0 left-0 w-[30%]"></div>
                    </div>
                </div>
                <div class="card-statistik">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 bg-blue-600 rounded-full"></div>
                            <p class="font-semibold text-gray-600 text-sm sm:text-base">Air</p>
                        </div>
                        <p class="font-semibold text-gray-600 text-sm sm:text-base">6.3%</p>
                    </div>
                    <div class="relative mt-3">
                        <div class="w-full h-3 bg-blue4 rounded-full"></div>
                        <div class="h-3 bg-blue1 rounded-l-full absolute top-0 left-0 w-[6.3%]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map & Table -->
    <div class="w-full lg:w-[75%] p-5 sm:p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-center text-lg sm:text-xl text-gray-600 font-semibold mb-5">
            <i class="ri-tree-fill me-2"></i>Peta Tutupan Lahan
        </h2>
        <div id="map" class="h-[300px] sm:h-[400px] lg:h-[600px] z-[1] w-full mb-8 rounded"></div>
        <h1 class="text-center text-[18px] sm:text-[20px] mt-2 font-bold mb-5">Data Tutupan Lahan</h1>
        <div class="overflow-auto">
            <table class="min-w-[500px] w-full text-sm my-5 text-left border">
                <thead class="text-sm uppercase bg-[#567E93] text-white">
                    <tr>
                        <th class="p-4">No</th>
                        <th class="p-4">Kecamatan</th>
                        <th class="p-4">Persentase</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b">
                        <td class="p-4">1</td>
                        <td class="p-4">Sumbersari</td>
                        <td class="p-4">65.0%</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-4">2</td>
                        <td class="p-4">Antirogo</td>
                        <td class="p-4">12.0%</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-4">3</td>
                        <td class="p-4">Karangrejo</td>
                        <td class="p-4">32.7%</td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-4">4</td>
                        <td class="p-4">Kebonsari</td>
                        <td class="p-4">58%</td>
                    </tr>
                </tbody>
            </table>
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
        var geeTileUrl =" https://earthengine.googleapis.com/v1/projects/ee-e41221681/maps/57f8170a4867157d5b262bd36718bd16-393133a8a38f6c3ac538013c4fe75f55/tiles/{z}/{x}/{y}";

        // Layer Google Earth Engine
        var geeLayer = L.tileLayer(geeTileUrl, {
            attribution: '&copy; <a href="https://earthengine.google.com/">Google Earth Engine</a>',
            maxZoom: 18
        });
        // URL tile dari Google Earth Engine
        var sentineTileUrl =
            " https://earthengine.googleapis.com/v1/projects/ee-e41221681/maps/7680bfe66c9eb1ac0cb0a6671ccf9f9c-8ddcdcabec6e7ca2e7746dc58565cf5d/tiles/{z}/{x}/{y}";

        // Layer Google Earth Engine
        var sentineLayer = L.tileLayer(sentineTileUrl, {
            attribution: '&copy; <a href="https://earthengine.google.com/">Google Earth Engine</a>',
            maxZoom: 18
        });

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
@endsection
