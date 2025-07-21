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
                var markers = L.marker([lat, lng]).addTo(mapLaporan);

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