@extends('all.layout.index')

@section('title', 'Landing Page')
@section('landing')

    <style>
        .active-btn {
            background-color: #283F50;
            color: #fff;
        }
    </style>
    <section id="main-page" class="w-full h-[800px] pt-[70px] flex flex-col md:flex-row">
        <div class="flex-1">
            <img src="/img/maps.png" alt="" class="w-[820px]">
        </div>
        <div class="flex-1 flex flex-col mt-[-150px] md:mt-0 justify-center items-start">
            <span class="text-[50px] md:text-[65px] font-[500] text-white">
                <h1>DETEKSI DINI</h1>
                <h1 class="mt-[-35px]">LINDUNGI DIRI</h1>
            </span>
            <p class="w-full md:w-[550px] text-white font-[300] text-[18px]">Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
            <a href="#tampilanMap" class="px-8 py-2 bg-blue4 text-blue1 block mt-4 rounded-full font-semibold">LIHAT
                PREDIKSI</a>
        </div>
        <div class="fixed bottom-5 right-5">
            <div
                class="bg-transparent border-2 border-blue-500 hover:bg-blue-400 transition duration-200 w-[60px] h-[60px] flex items-center justify-center rounded-full p-3 shadow-md cursor-pointer">
                <i class="ri-chat-3-line text-blue-500 text-[30px]" id="chat-icon"></i>
            </div>
        </div>
    </section>
    <section id="about-page" class="px-6 md:px-[150px] py-[100px] flex flex-col lg:flex-row gap-[40px] md:gap-[80px]">
        <div>
            <img src="/img/about/image1.png" alt="" class="w-full md:w-[450px]">
        </div>
        <div class="flex-1">
            <h2 class="text-[30px] md:text-[45px] font-[600] text-blue1">PREDIKSI BERBASIS ARTIFICIAL INTELEGENCE</h2>
            <p class="text-[16px] md:text-[18px] text-blue1">Lorem Ipsum is simply dummy text...</p>
            <div class="flex flex-row md:ml-[-200px] gap-4 mt-[30px]">
                <img src="/img/about/image2.png" alt="" class="w-[150px] md:w-[290px]">
                <img src="/img/about/image3.png" alt="" class="w-[150px] md:w-[290px]">
                <img src="/img/about/image4.png" alt="" class="w-[150px] md:w-[290px]">
            </div>
        </div>
    </section>
    <section id="fitur-page" class="flex flex-col justify-center items-center w-full bg-blue1 py-[100px] text-white">
        <h2 class="text-[40px] font-[700] text-blue4">TEMUKAN BERBAGAI FITUR</h2>
        <p class="text-blue4 text-[20px] font-[300]">Menyediakan berbagai fitur untuk mitigasi dan penanganan bencana alam
        </p>
        <div class="py-[30px] flex flex-wrap px-[15px] md:px-[100px] gap-4 mt-8 justify-center">
            {{-- card 1 --}}
            <div class="bg-blue4 text-black w-full md:w-[480px] rounded-xl">
                <p class="p-[15px] text-center bg-blue4 rounded-t-xl text-[24px] font-semibold text-blue1">Prediksi Bencana
                </p>
                <div class="bg-white rounded-xl flex h-[230px]">
                    <div class="px-[30px] py-[20px]">
                        <p class="text-[18px] font-[600]">Prediksi Bencana Banjir Berbasis Artificial Intellegence </p>
                        <div class="text-[12px] mt-2">
                            <p>Menggunakan parameter:</p>
                            <span class="flex items-center gap-2">
                                <img src="../img/fitur/triangle.png" alt="" class="w-2">
                                <p>Cuaca (cuaca, tutupan awan, dll)</p>
                            </span>
                            <span class="flex items-center gap-2">
                                <img src="../img/fitur/triangle.png" alt="" class="w-2">
                                <p>Iklim (suhu, kecepatan angin, dll)</p>
                            </span>
                            <span class="flex items-center gap-2">
                                <img src="../img/fitur/triangle.png" alt="" class="w-2">
                                <p>Jarak Terhadap Sungai</p>
                            </span>
                            <span class="flex items-center gap-2">
                                <img src="../img/fitur/triangle.png" alt="" class="w-2">
                                <p>Tutupan Lahan</p>
                            </span>
                        </div>
                    </div>
                    <div class="pe-6 py-[20px]">
                        <img src="/img/fitur/prediksi-bencana.png" alt="" class="w-[350px]">
                        <a href="{{ route('prediksi-bencana') }}"
                            class="w-full tex-center py-2 block text-center bg-blue1 mt-3 text-white font-[300] rounded-lg text-[12px]">Lihat
                            Prediksi</a>
                    </div>
                </div>
            </div>
            {{-- card 2 --}}
            <div class="bg-blue4 text-black w-full md:w-[480px] rounded-xl">
                <p class="p-[15px] text-center bg-blue4 rounded-t-xl text-[24px] font-semibold text-blue1">Peta Sebaran
                    Bencana</p>
                <div class="bg-white rounded-xl flex h-[230px]">
                    <div class="px-[30px] py-[20px]">
                        <p class="text-[18px] font-[600]">Visualisasi Peta Sebaran Bencana Berdasarkan Laporan Bencana</p>
                        <div class="text-[12px] mt-2">
                            <span class="flex items-center gap-2">
                                <p>Menampilkan daerah yang terkena bencana berdasarkan hasil laporan bencana</p>
                            </span>
                        </div>
                    </div>
                    <div class="pe-6 py-[20px]">
                        <img src="/img/fitur/sebaran-bencana.png" alt="" class="w-[400px]">
                        <a href="{{ route('persebaran-bencana') }}"
                            class="w-full tex-center py-2 block text-center bg-blue1 mt-3 text-white font-[300] rounded-lg text-[12px]">Lihat
                            Peta Sebaran</a>
                    </div>
                </div>
            </div>
            {{-- card 3 --}}
            <div class="bg-blue4 text-black w-full md:w-[480px] rounded-xl">
                <p class="p-[15px] text-center bg-blue4 rounded-t-xl text-[24px] font-semibold text-blue1">Tutupan Lahan</p>
                <div class="bg-white rounded-xl flex h-[230px]">
                    <div class="px-[30px] py-[20px]">
                        <p class="text-[18px] font-[600]">Visualisasi Tutupan Lahan Menggunakan Google Earth Engine (GEE)
                        </p>
                        <div class="text-[12px] mt-2">
                            <span class="flex items-center gap-2">
                                <p>Menampilkan tutupan lahan menggunakan Google Earth Engine</p>
                            </span>
                        </div>
                    </div>
                    <div class="pe-6 py-[20px]">
                        <img src="/img/fitur/tutupan-lahan.png" alt="" class="w-[400px]">
                        <a href="{{ route('tutupan-lahan') }}"
                            class="w-full tex-center py-2 block text-center bg-blue1 mt-3 text-white font-[300] rounded-lg text-[12px]">Lihat
                            Tutupan Lahan</a>
                    </div>
                </div>
            </div>
            {{-- card 4 --}}
            <div class="bg-blue4 text-black w-full md:w-[480px] rounded-xl">
                <p class="p-[15px] text-center bg-blue4 rounded-t-xl text-[24px] font-semibold text-blue1">Laporan Bencana
                </p>
                <div class="bg-white rounded-xl flex">
                    <div class="px-[30px] py-[20px]">
                        <p class="text-[18px] font-[600]">Laporan Bencana Terintegrasi Dengan Tim Respon Cepat</p>
                        <div class="text-[12px] mt-2">
                            <span class="flex items-center gap-2">
                                <p>Fitur laporan yang terhubung langsung dengan tim respon cepat dari Badan Penanggulanan
                                    Bencana Daerah atau BPDB sekitar</p>
                            </span>
                        </div>
                    </div>
                    <div class="pe-6 py-[20px]">
                        <img src="/img/fitur/laporan-bencana.png" alt="" class="w-[400px]">
                        <a href="{{ route('pelaporan-bencana') }}"
                            class="w-full tex-center py-2 block text-center bg-blue1 mt-2 text-white font-[300] rounded-lg text-[12px]">Laporan
                            Bencana</a>
                    </div>
                </div>
            </div>
            {{-- card 5 --}}
            <div class="bg-blue4 text-black w-full md:w-[480px] rounded-xl">
                <p class="p-[15px] text-center bg-blue4 rounded-t-xl text-[24px] font-semibold text-blue1">Donasi Bencana
                </p>
                <div class="bg-white rounded-xl flex">
                    <div class="px-[30px] py-[20px]">
                        <p class="text-[18px] font-[600]">Donasi Bencana Sesuai Dengan Kebutuhan di Lapangan</p>
                        <div class="text-[12px] mt-2">
                            <span class="flex items-center gap-2">
                                <p>Fitur laporan yang terhubung langsung dengan tim respon cepat dari Badan Penanggulanan
                                    Bencana Daerah atau BPDB sekitar</p>
                            </span>
                        </div>
                    </div>
                    <div class="pe-6 py-[20px]">
                        <img src="/img/fitur/donasi-bencana.png" alt="" class="w-[400px]">
                        <a href="{{ route('user.donasi') }}"
                            class="w-full tex-center py-2 block text-center bg-blue1 mt-2 text-white font-[300] rounded-lg text-[12px]">Laporan
                            Bencana</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <section class="bg-[#CFDDE4] py-20"  id="donasi">
        <div class=" mx-auto text-center px-4">
            <h1 class=" p-3 inline-block text-[20px] font-bold text-white bg-[#283F50]">Donasi Terkini</h1>
            <p class="p-4">Mari wujudkan kepedulian kita dengan membantu sesama !</p>
        </div>
        @php
            use App\Util\FormatRupiah;
        @endphp
        <div class="flex p-10 gap-8 flex-wrap justify-center">
            @foreach ($bencana as $item)
                @php
                    $progresBar = ($item->total_donasi  / $item->target_uang_donasi) * 100;
                @endphp
           <div class="bg-white rounded-2xl shadow-lg overflow-hidden w-[300px] hover:shadow-xl transition duration-300">
            <img src="{{ asset('/img/donasi/Frame 1389 (1).png') }}" alt="" class="w-full h-48 object-cover">
        
            <div class="p-4">
                <p class="text-xl font-semibold text-gray-800 mb-2">{{ $item->nama_bencana }}</p>
        
                <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                    <div class="bg-blue-600 h-3 rounded-full transition-all duration-300" style="width: {{ $progresBar }}%"></div>
                </div>
        
                <p class="text-sm text-gray-600 mb-1">Terkumpul</p>
                <p class="text-xl font-bold text-gray-900 mb-3">Rp. {{ FormatRupiah::Rupiah($item->total_donasi) }}</p>
        
                <div class="text-xs text-gray-600 space-y-1">
                    <p>
                        <i class="fa-solid fa-location-dot text-red-500 mr-1"></i>
                        {{ $item->desa->nama_desa }}, {{ $item->desa->kecamatan->nama_kecamatan }}
                    </p>
                    <p>
                        <i class="fa-solid fa-calendar-days text-blue-500 mr-1"></i>
                        {{ \Carbon\Carbon::parse($item->tanggal_kejadian)->translatedFormat('d F Y') }}
                    </p>
                    <p>
                        <i class="fa-solid fa-users text-green-600 mr-1"></i>
                        5 Kebutuhan logistik
                    </p>
                </div>
        
                <a href="{{ route('user.donasi.detail', $item->id_laporan_bencana) }}"
                   class="block mt-4 text-center bg-[#283F50] hover:bg-[#1f323f] text-white py-2 px-4 rounded-lg text-sm font-medium transition duration-200">
                    Donasi Sekarang
                </a>
            </div>
        </div>
        
            @endforeach

        </div>
    </section>
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
    <section id="articles" class="px-[150px] py-[100px]">
        <h2 class="text-[45px] font-[600] text-blue1 text-center mb-10">Artikel Terbaru</h2>
        <div class="flex flex-wrap justify-center gap-10">
            <!-- Article Card 1 -->
            @foreach ($artikel as $data)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden w-[300px]">
                    <img src="{{ asset('uploads/foto-artikel/' . $data->foto_artikel) }}" alt="Judul Artikel 1"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-blue1">{{ $data->judul_artikel }}</h3>
                        <p class="text-gray-600 text-sm mb-2">Tanggal: <span
                                class="font-semibold">{{ $data->tanggal }}</span>
                        </p>
                        <p class="text-gray-700 text-base">{{ $data->isi_artikel }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    <!-- Chatbot Modal -->
 
<!-- Chatbot Modal -->
<div id="chat-modal" class="fixed bottom-20 right-5 w-80 bg-white rounded-lg shadow-xl border hidden z-50">
    <div class="bg-[#283F50] text-white flex justify-between items-center px-4 py-3 rounded-t-lg">
        <h2 class="text-lg font-semibold">Bantuan</h2>
        <button id="close-modal" class="hover:text-gray-300 text-white text-xl">&times;</button>
    </div>
    <div id="chatbox" class="p-4 space-y-2 h-80 overflow-y-auto text-sm bg-gray-50">
    </div>
    <div class="p-3 border-t bg-white">
        <input type="text" id="user-input" class="w-full border rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Ketik pesan...">
        <button id="send-button" class="w-full mt-2 bg-[#283F50] text-white p-2 rounded-md text-sm">Kirim</button>
    </div>
</div>

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
                    var marker = L.marker([lat, lng]).addTo(mapPrediksi);

                    // Mengikat popup dengan informasi yang sesuai untuk setiap marker
                    var popupContent = "<b> Terdeteksi Banjir di tanggal " + element.tanggal_prediksi +
                        "</b>";

                    // Menambahkan popup secara langsung ke posisi yang diinginkan di peta
                    L.popup()
                        .setLatLng([lat, lng])
                        .setContent(popupContent)
                        .addTo(mapPrediksi);
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

                            // console.log(data);

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
                                        fillColor: cluster, // Warna isi
                                        fillOpacity: 0.3 // Transparansi warna isi (0.0 - 1.0)
                                    };
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

    <script>
        // Function to toggle the modal visibility
        const chatModal = document.getElementById('chat-modal');
        const chatIcon = document.getElementById('chat-icon');
        const closeModal = document.getElementById('close-modal');

        chatIcon.onclick = function() {
            chatModal.classList.remove('hidden');
        }

        closeModal.onclick = function() {
            chatModal.classList.add('hidden');
            document.getElementById('chatbox').innerHTML = "";
        }

        // Chat functionality
        function sendMessage() {
    var userInput = document.getElementById('user-input').value;
    if (userInput.trim() !== "") {
        var chatbox = document.getElementById('chatbox');

        // User message (kanan)
        var userMessage = document.createElement('div');
        userMessage.className = 'mb-2 flex justify-end';
        userMessage.innerHTML = `
            <div class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg max-w-[75%] text-sm">
                ${userInput}
            </div>`;
        chatbox.appendChild(userMessage);
        chatbox.scrollTop = chatbox.scrollHeight;

        // Kirim ke API
        fetch('http://127.0.0.1:8000/api/chatbot', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                message: userInput
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network error');
            }
            return response.json();
        })
        .then(data => {
            // Bot message (kiri)
            var botMessage = document.createElement('div');
            botMessage.className = 'mb-2 flex justify-start';
            botMessage.innerHTML = `
                <div class="bg-blue-500 text-white px-4 py-2 rounded-lg max-w-[75%] text-sm">
                    ${data.response}
                </div>`;
            chatbox.appendChild(botMessage);
            chatbox.scrollTop = chatbox.scrollHeight;
        })
        .catch(error => {
            console.error('Error:', error);
            var errorMessage = document.createElement('div');
            errorMessage.className = 'mb-2 flex justify-start';
            errorMessage.innerHTML = `
                <div class="bg-red-500 text-white px-4 py-2 rounded-lg max-w-[75%] text-sm">
                    Gagal mengirim pesan.
                </div>`;
            chatbox.appendChild(errorMessage);
            chatbox.scrollTop = chatbox.scrollHeight;
        });

        // Kosongkan input
        document.getElementById('user-input').value = "";
    }
}


        document.getElementById('send-button').addEventListener('click', sendMessage);

        // Handle enter key for input
        document.getElementById('user-input').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                sendMessage();
                event.preventDefault(); // Prevent form submit if in form
            }
        });
    </script>
@endsection
