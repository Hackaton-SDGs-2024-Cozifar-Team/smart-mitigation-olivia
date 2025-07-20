@extends('all.layout.index')

@section('title', 'Analisis Banjir')
@section('landing')
<div class="min-h-screen bg-gradient-to-b pt-24 from-gray-50 to-gray-100">
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
           

                <!-- Quick Stats -->
                <div class="flex justify-center gap-5 flex-wrap">
                    <div class="grid grid-cols-2 w-full gap-4">
                        <div class="bg-white rounded-xl shadow-lg p-4">
                            <div class="flex items-center space-x-3">
                                <div class="h-12 w-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <i class="ri-water-flash-fill text-2xl text-red"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Tinggi</p>
                                    <p id="cluster-tinggi-count" class="text-lg font-bold text-gray-800">Loading...</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-xl shadow-lg p-4">
                            <div class="flex items-center space-x-3">
                                <div class="h-12 w-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                    <i class="ri-drop-fill text-2xl text-yellow-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Sedang</p>
                                    <p id="cluster-sedang-count" class="text-lg font-bold text-gray-800">Loading...</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
    
                        <div class="bg-white w-56 rounded-xl inline-block shadow-lg p-4">
                            <div class="flex items-center space-x-3">
                                <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="ri-drop-fill text-2xl text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Sedang</p>
                                    <p id="cluster-rendah-count" class="text-lg font-bold text-gray-800">Loading...</p>
                                </div>
                            </div>
                        </div>
                </div>

                <!-- High-Risk Villages Table -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Desa dengan Cluster Tinggi</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Desa</th>
                                </tr>
                            </thead>
                            <tbody id="high-risk-villages" class="divide-y divide-gray-200">
                                <!-- Rows will be dynamically added here -->
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
    var map = L.map('map').setView([-8.184486, 113.668076], 13);

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
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
$.ajax({
    url: "/api/get-cluster",
    method: "GET",
    success: function(data) {
        console.log(data);

        let clusterTinggiCount = 0;
        let clusterSedangCount = 0;
        let clusterRendahCount = 0;
        let highRiskVillagesHtml = '';

        data.forEach((element, index) => {
            if (element.cluster === 'tinggi') {
                clusterTinggiCount++;
                highRiskVillagesHtml += `
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-500">${index + 1}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">${element.desa.nama_desa}</td>
                    </tr>
                `;
            } else if (element.cluster === 'sedang') {
                clusterSedangCount++;
            } else if (element.cluster === 'rendah') {
                clusterRendahCount++;
            }
        });

        // Update cluster counts
        $('#cluster-tinggi-count').text(clusterTinggiCount);
        $('#cluster-sedang-count').text(clusterSedangCount);
        $('#cluster-rendah-count').text(clusterRendahCount);

        // Update high-risk villages table
        $('#high-risk-villages').html(highRiskVillagesHtml);

        data.forEach(element => {
            var lat = element.latitude;
            var lng = element.longitude;
            var cluster = '';
            if(element.cluster == 'tinggi') {
                cluster = '#CA3F51';
            } else if(element.cluster == 'sedang') {
                cluster = '#DACD38';
            } else if(element.cluster == 'rendah') {
                cluster = '#24AA26';
            }

            fetch('jember.geojson')
                .then(response => response.json())
                .then(data => {
                    var coordinates = [];

                    data.forEach(el => {
                        if (el.village == element.desa.nama_desa) {
                            el.border.forEach(border => {
                                coordinates.push(border);
                            });
                        }
                    });

                    var geojsonData = {
                        "type": "FeatureCollection",
                        "features": [{
                            "type": "Feature",
                            "geometry": {
                                "type": "Polygon",
                                "coordinates": [coordinates]
                            },
                            "properties": {
                                "name": element.desa.nama_desa,
                                "cluster": element.cluster
                            }
                        }]
                    };

                    L.geoJSON(geojsonData, {
                        style: function(feature) {
                            return {
                                color: "#CA3F51", // Default border color
                                weight: 2, // Default border thickness
                                opacity: 1,
                                fillColor: cluster,
                                fillOpacity: 0.3
                            };
                        },
                        onEachFeature: function(feature, layer) {
                            layer.on('mouseover', function(e) {
                                var popupContent = `<strong>Desa:</strong> ${feature.properties.name}<br>
                                                    <strong>Cluster:</strong> ${feature.properties.cluster}`;
                                var popup = L.popup()
                                    .setLatLng(e.latlng)
                                    .setContent(popupContent)
                                    .openOn(map);

                                // Add "outer glow" effect to the border
                                layer.setStyle({
                                    weight: 8, // Thicker border to simulate zoom-out effect
                                    color: "#FF0000", // Highlight color
                                    fillOpacity: 0.5, // Slightly increase fill opacity
                                    opacity: 0.8 // Make the border more prominent
                                });
                            });

                            layer.on('mouseout', function() {
                                map.closePopup();

                                // Reset the style of the region
                                layer.setStyle({
                                    weight: 2, // Reset border thickness
                                    color: "#CA3F51", // Reset border color
                                    fillOpacity: 0.3, // Reset fill opacity
                                    opacity: 1 // Reset border opacity
                                });
                            });
                        }
                    }).addTo(map);
                })
                .catch(error => console.log("Error loading GeoJSON file:", error));
        });
    },
    error: function(error) {
        console.error("Error fetching cluster data:", error);
    }
})


    map.addControl(new customControl());
</script>
@endsection
