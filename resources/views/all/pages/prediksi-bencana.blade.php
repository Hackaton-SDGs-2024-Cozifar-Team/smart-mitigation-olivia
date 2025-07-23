@extends('all.layout.index')

@section('title', 'Analisis Banjir')
@section('landing')
<div class="min-h-screen bg-gradient-to-b mt-24 from-gray-50 to-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-blue1 mb-4">
                <i class="ri-flood-fill text-blue1 me-2"></i>Sistem Analisis & Prediksi Banjir
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Visualisasi dan analisis real-time untuk prediksi banjir menggunakan teknologi AI dan data satelit</p>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Main Map -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">Peta Analisis Banjir</h2>
                            <div class="flex items-center space-x-2">
                                <span class="px-3 py-1 bg-blue-100 text-blue1 rounded-full text-sm font-medium">
                                    <i class="ri-map-pin-line mr-1"></i>Live View
                                </span>
                            </div>
                        </div>
                        <div id="map" class="h-[600px] w-full rounded-xl z-0 overflow-hidden border border-gray-200"></div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Analytics -->
            <div class="space-y-6">
                <!-- Current Status -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Siaga Banjir</h3>
                    <div class="flex items-center justify-between p-4 bg-red-50 rounded-xl border border-red-100">
                        <div>
                            <p class="text-red-600 font-bold text-2xl">SIAGA I</p>
                            <p class="text-gray-600 text-sm">Update: 2 jam lalu</p>
                        </div>
                        <div class="h-16 w-16 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="ri-alarm-warning-fill text-3xl text-red-500"></i>
                        </div>
                    </div>
                </div>

                <!-- Water Level Monitoring -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Monitoring Tinggi Air</h3>
                    <div class="space-y-4">
                        @foreach ($prediksi as $pred)      
                 
                        <div class="p-4 rounded-xl bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-semibold text-gray-800">{{ $pred->nama_desa }}</h4>
                                <span class="px-2 py-1 bg-yellow-200 text-yellow-700 rounded-lg text-xs">{{ $pred->tanggal_prediksi }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white rounded-xl shadow-lg p-4">
                        <div class="flex items-center space-x-3">
                            <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="ri-water-flash-fill text-2xl text-blue1"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Cuaca</p>
                                <p id="cuaca-info" class="text-lg font-bold text-gray-800">Loading...</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-lg p-4">
                        <div class="flex items-center space-x-3">
                            <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="ri-drop-fill text-2xl text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Suhu</p>
                                <p id="suhu-info" class="text-lg font-bold text-gray-800">Loading...</p>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Kejadian Banjir</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Korban</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dampak</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($laporan_bencana as $lap)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $lap->tanggal_kejadian }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $lap->deskripsi_alamat }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $lap->informasiBencana->korban_terluka ?? 'Tidak tersedia' }} orang</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $lap->informasiBencana->dampak_kerusakan ?? 'Tidak tersedia' }}</td>
                                </tr>                              
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <!-- Historical Data -->
            

        </div>
    </div>
</div>

<script>

$.ajax({
    url: "https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=35.09.21.1002",
    method: "GET",
    success: function (response) {
        // Contoh struktur: response.data[0].weather atau response.data[0].temperature
        
        const data = response.data?.[0];
        
        if (data) {
            $('#cuaca-info').text(data.cuaca[0]?.[0].weather_desc ?? 'Tidak tersedia');
            $('#suhu-info').text(data.cuaca[0]?.[0].t + '°');
        } else {
            $('#cuaca-info').text('Data tidak ditemukan');
            $('#suhu-info').text('-');
        }
    },
    error: function (xhr, status, error) {
        console.error('Gagal memuat data cuaca:', error);
        $('#cuaca-info').text('Gagal mengambil');
        $('#suhu-info').text('Gagal mengambil');
    }
});

    // Initialize Leaflet map
    var map = L.map('map').setView([-6.2088, 106.8456], 11);

    // Add OpenStreetMap base layer
    var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    // Add flood analysis layer
    var floodAnalysisTileUrl = "https://earthengine.googleapis.com/v1/projects/ee-e41221681/maps/67b09bd6bf20d7d9f6d3df5fcc2a0ca8-34eb940a5c5f5331e5d267f19cf89118/tiles/{z}/{x}/{y}";
    var floodAnalysisLayer = L.tileLayer(floodAnalysisTileUrl, {
        attribution: '&copy; <a href="https://earthengine.google.com/">Google Earth Engine</a>',
        maxZoom: 18
    });

    // Layer control
    var baseLayers = {
        "OpenStreetMap": osmLayer
    };

    var overlayLayers = {
        "Analisis Banjir": floodAnalysisLayer
    };

    L.control.layers(baseLayers, overlayLayers).addTo(map);

    // Add custom map controls with modern styling
    var customControl = L.Control.extend({
        options: {
            position: 'bottomright'
        },
        onAdd: function(map) {
            var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
            container.style.backgroundColor = 'white';
            container.style.padding = '10px';
            container.style.borderRadius = '8px';
            container.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
            container.innerHTML = `
                <div class="flex flex-col space-y-2">
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-red-500 rounded-full"></div>
                        <span class="text-sm">Risiko Tinggi</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-yellow-500 rounded-full"></div>
                        <span class="text-sm">Risiko Sedang</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-green-500 rounded-full"></div>
                        <span class="text-sm">Risiko Rendah</span>
                    </div>
                </div>
            `;
            return container;
        }
    });

$.ajax({
    url: "/api/get-prediksi",
    method: "GET",
    success: function(data) {
        // console.log(data);

        data.forEach(element => {
            // Mengambil koordinat dari setiap elemen data
            var lat = element.latitude;
            var lng = element.longitude;

            // Menambahkan marker di posisi koordinat dari API
            var marker = L.marker([lat, lng]).addTo(map);

            // Mengikat popup dengan informasi yang sesuai untuk setiap marker
            var popupContent = "<b> Terdeteksi Banjir di tanggal " + element.tanggal_prediksi +
                "</b>";

            // Menambahkan popup secara langsung ke posisi yang diinginkan di peta
            L.popup()
                .setLatLng([lat, lng])
                .setContent(popupContent)
                .addTo(map);
            ///
            fetch('jember.geojson')
                .then(response => response.json())
                .then(data => {
                    // var searchValue = searchInput.value.toUpperCase();
                    var coordinates = [];
                    // console.log(data);

                    data.forEach(el => {
                        if (el.village == element.nama_desa) {
                            el.border.forEach(border => {
                                coordinates.push(border);
                            })
                        }
                    });
                    console.log(coordinates);
                    // Tambahkan data GeoJSON ke peta dengan gaya khusus
                    var geojsonData = {
                        "type": "FeatureCollection",
                        "features": [{
                            "type": "Feature",
                            "geometry": {
                                "type": "Polygon",
                                "coordinates": [coordinates]
                            },
                            "properties": {
                                "name": "Batas Daerah Contoh"
                            }
                        }]
                    };

                    // Tambahkan batas daerah menggunakan GeoJSON
                    L.geoJSON(geojsonData, {
                        style: function(feature) {
                            return {
                                color: "#CA3F51", // Warna garis batas
                                weight: 2,
                                opacity: 1,
                                fillColor: "#C13E48", // Warna isi
                                fillOpacity: 0.3 // Transparansi warna isi (0.0 - 1.0)
                            };
                        }
                    }).addTo(map);
                })
                .catch(error => console.log("Error loading GeoJSON file:", error));
            ///
        })
    },
})

    map.addControl(new customControl());
</script>
@endsection
