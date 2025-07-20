@extends('all.layout.index')

@section('title', 'Landing Page')
@section('landing')
    <div class="container p-6 mx-auto">
        <div id="indicators-carousel" class="relative h-full mt-24" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-[600px] overflow-hidden rounded-lg md:h-[500px]">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img src="{{ asset('/img/donasi/bantumakan 1.png') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('/img/donasi/bantumakan 1.png') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('/img/donasi/bantumakan 1.png') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>

            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                    data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                    data-carousel-slide-to="3"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                    data-carousel-slide-to="4"></button>
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </div>

    <section class="bg-[#CFDDE4] mt-24 py-20">
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
                <div class="bg-white p-3 w-[300px]">
                    <img src="{{ asset('/img/donasi/Frame 1389 (1).png') }}" class="" alt="">
                    <p class="text-[20px] mt-4 font-[600]">{{ $item->nama_bencana }}</p>

                    <div class="w-full mt-2 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progresBar }}%"></div>
                    </div>

                    <p class="mt-2">Terkumpul</p>
                    <p class="mt-1 font-bold text-[23px]">Rp. {{ FormatRupiah::Rupiah($item->total_donasi) }}</p>
                    <p class="mt-2 text-[13px] text-[#6b6b6b]"><i class="fa-solid fa-location-dot"></i>
                        {{ $item->desa->nama_desa }}, {{ $item->desa->kecamatan->nama_kecamatan }} |
                        {{ \Carbon\Carbon::parse($item->tanggal_kejadian)->translatedFormat('d F Y') }}</p>
                    <p class="mt-2 text-[13px] text-[#6b6b6b]"><i class="fa-solid fa-users"></i>  5 Kebutuhan
                        logistik</p>

                    <a href="{{ route('user.donasi.detail', $item->id_laporan_bencana) }}"
                        class="bg-[#283F50] p-2 w-full text-center text-[18px] inline-block mt-4 text-white">Donasi</a>
                </div>
            @endforeach

        </div>
    </section>

    <section class="py-20">
        <div class=" mx-auto text-center px-4">
            <h1 class=" p-3 inline-block text-[20px] font-bold text-white bg-[#283F50]">Peta Donasi Bencana Jember</h1>
        </div>

        <div id="map" class="h-[600px] mx-28 z-[1] mt-5"></div>
    </section>
    <script>
        $(document).ready(function() {
            var map = L.map('map').setView([-8.184486, 113.668076], 13); // Jakarta

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            $.ajax({
                url: "/api/bencana",
                method: "GET",
                success: function(data) {
                    console.log(data);

                    data.forEach(element => {
                        // Mengambil koordinat dari setiap elemen data
                        var lat = element.latitude;
                        var lng = element.longitude;

                        // Menambahkan marker di posisi koordinat dari API
                        var marker = L.marker([lat, lng]).addTo(map);

                        // Mengikat popup dengan informasi yang sesuai untuk setiap marker
                        var popupContent = "<b>" + element.nama_bencana + "</b><br>" +
                            "Kerusakan: " + element.tingkat_bencana + "<br>" +
                            "Tanggal: " + element.tanggal_kejadian + "<br>" +
                            "<a href='/detail-donasi/" + element.id_laporan_bencana +
                            "' class='bg-[#dddddd] p-2 w-full text-center text-[16px] inline-block mt-4'>Lihat Detail</a>";

                        // Menambahkan popup secara langsung ke posisi yang diinginkan di peta
                        L.popup()
                            .setLatLng([lat, lng])
                            .setContent(popupContent)
                            .addTo(map);
                    })
                }
            })
        })



        // // Marker pertama
        // var marker1 = L.marker([-8.184486, 113.668076]).addTo(map);
        // marker1.bindPopup(
        //     "<b>Banjir</b><br>Kerusakan : Sedang<br>Meninggal : 0<br>Luka - luka : 0<br> <a href='' class='bg-[#dddddd] p-2 w-full text text-center text-[16px] inline-block mt-4'>Lihat Detail</a>"
        // );
        // var popup1 = L.popup()
        //     .setLatLng([-8.184486, 113.668076])
        //     .setContent(
        //         "<b>Banjir</b><br>Kerusakan : Sedang<br>Meninggal : 0<br>Luka - luka : 0<br> <a href='' class='bg-[#dddddd] p-2 w-full text text-center text-[16px] inline-block mt-4'>Lihat Detail</a>"
        //     )
        //     .addTo(map);

        // // Marker kedua
        // var marker2 = L.marker([-8.169572, 113.698498]).addTo(map);
        // marker2.bindPopup(
        //     "<b>Banjir</b><br>Kerusakan : Sedang<br>Meninggal : 0<br>Luka - luka : 0<br> <a href='' class='bg-[#dddddd] p-2 w-full text text-center text-[16px] inline-block mt-4'>Lihat Detail</a>"
        // );
        // var popup2 = L.popup()
        //     .setLatLng([-8.169572, 113.698498])
        //     .setContent(
        //         "<b>Banjir</b><br>Kerusakan : Sedang<br>Meninggal : 0<br>Luka - luka : 0<br> <a href='' class='bg-[#dddddd] p-2 w-full text text-center text-[16px] inline-block mt-4'>Lihat Detail</a>"
        //     )
        //     .addTo(map);

        // // Tampilkan popup yang sudah digabungkan
        // map.openPopup(combinedPopup);
    </script>
@endsection
