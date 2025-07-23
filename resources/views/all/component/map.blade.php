<section id="tampilanMap" class="px-[15px] md:px-[150px] py-[100px] flex flex-col justify-center items-center">
    <ul class="flex border p-1 rounded-xl flex-wrap text-sm font-medium text-center text-gray-700 dark:text-gray-400">
        <li class="me-2">
            <button class="inline-block px-4 py-3 active-btn rounded-lg active" id="btnPrediksi"
                type="button">Prediksi Bencana</button>
        </li>
        <li class="me-2">
            <button class="inline-block px-4 py-3 rounded-lg dark:hover:bg-gray-800 dark:hover:text-white"
                id="btnLaporan" type="button">Laporan Bencana</button>
        </li>
        <li class="me-2">
            <button class="inline-block px-4 py-3 rounded-lg dark:hover:bg-gray-800 dark:hover:text-white"
                id="btnPemetaan" type="button">Cluster Resiko Banjir</button>
        </li>
    </ul>
    <div class="mt-10 w-full">
        <div id="mapPrediksi" class="h-[600px] w-full z-[10] mt-5"></div>
        <div id="mapLaporan" class="h-[600px] w-full z-[10] mt-5 "></div>
        <div id="mapPemetaan" class="h-[600px] w-full z-[10] mt-5 "></div>
    </div>
</section>

<script>
    var mapPrediksi = L.map('mapPrediksi').setView([-8.184486, 113.668076], 14); // Jakarta

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapPrediksi);

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
                // var marker = L.marker([lat, lng]).addTo(mapPrediksi);

                // // Mengikat popup dengan informasi yang sesuai untuk setiap marker
                // var popupContent = "<b> Terdeteksi Banjir di tanggal " + element.tanggal_prediksi +
                //     "</b>";

                // // Menambahkan popup secara langsung ke posisi yang diinginkan di peta
                // L.popup()
                //     .setLatLng([lat, lng])
                //     .setContent(popupContent)
                //     .addTo(mapPrediksi);
                // ///
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
                                    "name": element.nama_desa,
                                    "tanggal_prediksi": element.tanggal_prediksi
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
                            },
                            onEachFeature: function(feature, layer) {
                                layer.bindTooltip(feature.properties.name + ' - ' + feature.properties.tanggal_prediksi, {direction: "center", permanent: false});
                                layer.on('mouseover', function(e) {
                                    layer.setStyle({weight: 5});
                                    layer.openTooltip();
                                    // var bounds = layer.getBounds();
                                    // mapPrediksi.flyToBounds(bounds, {maxZoom: 15, duration: 0.4});
                                });
                                layer.on('mouseout', function(e) {
                                    layer.setStyle({weight: 2});
                                    layer.closeTooltip();
                                    // mapPrediksi.flyTo([-8.184486, 113.668076], 14, {duration: 0.4});
                                });
                            }
                        }).addTo(mapPrediksi);
                    })
                    .catch(error => console.log("Error loading GeoJSON file:", error));
                ///
            })
        },
    })

    var mapPemetaan = L.map('mapPemetaan').setView([-8.184486, 113.668076], 14); // Jakarta

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapPemetaan);
    $.ajax({
        url: "/api/get-cluster",
        method: "GET",
        success: function(data) {
            console.log(data);

            data.forEach(element => {
                // Mengambil koordinat dari setiap elemen data
                var lat = element.latitude;
                var lng = element.longitude;
                var cluster = '';
                if(element.cluster == 'tinggi') {
                    cluster = '#CA3F51';
                }else if(element.cluster == 'sedang') {
                    cluster = '#DACD38';
                }else if(element.cluster == 'rendah') {
                    cluster = '#24AA26';
                }
                ///
                fetch('jember.geojson')
                    .then(response => response.json())
                    .then(data => {
                        // var searchValue = searchInput.value.toUpperCase();
                        var coordinates = [];

                        data.forEach(el => {
                            if (el.village == element.desa.nama_desa) {
                       
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
                                    "name": element.desa.nama_desa,
                                    "cluster": element.cluster
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
                                    fillColor: cluster, // Warna isi
                                    fillOpacity: 0.3 // Transparansi warna isi (0.0 - 1.0)
                                };
                            },
                            onEachFeature: function(feature, layer) {
                                layer.bindTooltip(feature.properties.name + ' - ' + feature.properties.cluster, {direction: "center", permanent: false});
                                layer.on('mouseover', function(e) {
                                    layer.setStyle({weight: 5});
                                    layer.openTooltip();
                                    // var bounds = layer.getBounds();
                                    // mapPemetaan.flyToBounds(bounds, {maxZoom: 15, duration: 0.4});
                                });
                                layer.on('mouseout', function(e) {
                                    layer.setStyle({weight: 2});
                                    layer.closeTooltip();
                                    // mapPemetaan.flyTo([-8.184486, 113.668076], 14, {duration: 0.4});
                                });
                            }
                        }).addTo(mapPemetaan);
                    })
                    .catch(error => console.log("Error loading GeoJSON file:", error));
                ///
            })
        },
    })

    //laporannnnnn
    var mapLaporan = L.map('mapLaporan').setView([-8.184486, 113.668076], 13); // Jakarta

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapLaporan);

    // Custom icon for disaster markers
    var disasterIcon = L.divIcon({
        className: 'custom-disaster-marker',
        html: '<div class="marker-pin"><i class="fas fa-exclamation-triangle"></i></div>',
        iconSize: [30, 30],
        iconAnchor: [15, 30]
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

                // Menambahkan marker di posisi koordinat dari API dengan custom icon
                var markers = L.marker([lat, lng], {icon: disasterIcon}).addTo(mapLaporan);

                // Format tanggal
                var tanggalKejadian = new Date(element.tanggal_kejadian).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                // Tentukan warna berdasarkan tingkat bencana
                var badgeColor = '';
                var badgeText = '';
                switch(element.tingkat_bencana.toLowerCase()) {
                    case 'ringan':
                        badgeColor = 'bg-green-500';
                        badgeText = '🟢 Ringan';
                        break;
                    case 'sedang':
                        badgeColor = 'bg-yellow-500';
                        badgeText = '🟡 Sedang';
                        break;
                    case 'berat':
                        badgeColor = 'bg-red-500';
                        badgeText = '🔴 Berat';
                        break;
                    default:
                        badgeColor = 'bg-gray-500';
                        badgeText = '⚪ ' + element.tingkat_bencana;
                }

                // Popup content dengan styling yang lebih baik
                var popupContent = `
                    <div class="disaster-popup">
                        <div class="popup-header">
                            <h3 class="popup-title">
                                <i class="fas fa-exclamation-triangle text-red-500"></i>
                                ${element.nama_bencana}
                            </h3>
                            <span class="severity-badge ${badgeColor}">
                                ${badgeText}
                            </span>
                        </div>
                        
                        <div class="popup-content">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt text-blue-500"></i>
                                <span><strong>Lokasi:</strong> ${element.desa ? element.desa.nama_desa + ', ' + element.desa.kecamatan.nama_kecamatan : 'Lokasi tidak tersedia'}</span>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-calendar-alt text-green-500"></i>
                                <span><strong>Tanggal:</strong> ${tanggalKejadian}</span>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-users text-purple-500"></i>
                                <span><strong>Korban:</strong> ${element.korban_jiwa || 0} jiwa</span>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-home text-orange-500"></i>
                                <span><strong>Rumah Rusak:</strong> ${element.rumah_rusak || 0} unit</span>
                            </div>
                            
                            ${element.deskripsi ? `
                                <div class="info-item description">
                                    <i class="fas fa-info-circle text-gray-500"></i>
                                    <span><strong>Deskripsi:</strong><br>${element.deskripsi}</span>
                                </div>
                            ` : ''}
                        </div>
                        
                        <div class="popup-actions">
                            <a href="/detail-donasi/${element.id_laporan_bencana}" 
                               class="detail-button">
                                <i class="fas fa-heart mr-2"></i>
                                Donasi Sekarang
                            </a>
                            <button onclick="shareLocation(${lat}, ${lng}, '${element.nama_bencana}')" 
                                    class="share-button">
                                <i class="fas fa-share-alt mr-2"></i>
                                Bagikan
                            </button>
                        </div>
                    </div>
                `;

                // Menambahkan popup dengan custom styling
                markers.bindPopup(popupContent, {
                    maxWidth: 350,
                    className: 'custom-popup'
                });

                // Add hover effects
                markers.on('mouseover', function(e) {
                    this.openPopup();
                });
            })
        }
    });

    // Function to share location
    function shareLocation(lat, lng, name) {
        if (navigator.share) {
            navigator.share({
                title: 'Lokasi Bencana: ' + name,
                text: 'Lihat lokasi bencana ' + name,
                url: `https://www.google.com/maps?q=${lat},${lng}`
            });
        } else {
            // Fallback - copy to clipboard
            navigator.clipboard.writeText(`Lokasi Bencana: ${name} - https://www.google.com/maps?q=${lat},${lng}`);
            alert('Link lokasi telah disalin ke clipboard!');
        }
    }

    $(document).ready(function() {
        $("#mapPrediksi").show();
        $("#mapLaporan").hide();
        $("#mapPemetaan").hide();
        $("#btnPrediksi").click(function() {
            $("#mapPrediksi").show();
            $("#mapPemetaan").hide();
            $("#mapLaporan").hide();
            $("#btnPrediksi").addClass('active-btn');
            $("#btnLaporan").removeClass('active-btn');
            $("#btnPemetaan").removeClass('active-btn');
        });
        $("#btnLaporan").click(function() {
            $("#mapPrediksi").hide();
            $("#mapPemetaan").hide();
            $("#mapLaporan").show();
            $("#btnPrediksi").removeClass('active-btn');
            $("#btnPemetaan").removeClass('active-btn');
            $("#btnLaporan").addClass('active-btn');
        });
        $("#btnPemetaan").click(function() {
            $("#mapPrediksi").hide();
            $("#mapLaporan").hide();
            $("#mapPemetaan").show();
            $("#btnPrediksi").removeClass('active-btn');
            $("#btnLaporan").removeClass('active-btn');
            $("#btnPemetaan").addClass('active-btn');
        });
    })
</script>

<style>
/* Custom marker styling */
.custom-disaster-marker .marker-pin {
    width: 30px;
    height: 30px;
    border-radius: 50% 50% 50% 0;
    background: linear-gradient(45deg, #ff6b6b, #ff5252);
    position: relative;
    transform: rotate(-45deg);
    border: 3px solid #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
}

.custom-disaster-marker .marker-pin i {
    color: white;
    font-size: 14px;
    transform: rotate(45deg);
}

/* Custom popup styling */
.custom-popup .leaflet-popup-content-wrapper {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    padding: 0;
    overflow: hidden;
}

.custom-popup .leaflet-popup-tip {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.disaster-popup {
    font-family: 'Inter', sans-serif;
    width: 100%;
}

.popup-header {
    background: #283F50;
    color: white;
    padding: 15px;
    text-align: center;
}

.popup-title {
    font-size: 18px;
    font-weight: 700;
    margin: 0 0 10px 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.severity-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    color: white;
    text-transform: uppercase;
}

.popup-content {
    padding: 15px;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 12px;
    font-size: 14px;
    line-height: 1.4;
}

.info-item i {
    width: 16px;
    margin-top: 2px;
    flex-shrink: 0;
}

.info-item.description {
    flex-direction: column;
    align-items: flex-start;
}

.popup-actions {
    padding: 0 15px 15px 15px;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.detail-button {
    flex: 1;
    background: #6c757d;
    color: white !important;
    padding: 10px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    text-align: center;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 40px;
}

.detail-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

.share-button {
    flex: 1;
    background: #6c757d;
    color: white;
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 40px;
}

.share-button:hover {
    background: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .popup-actions {
        flex-direction: column;
    }
    
    .detail-button,
    .share-button {
        flex: none;
        width: 100%;
    }
}
</style>