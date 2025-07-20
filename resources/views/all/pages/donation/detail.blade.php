@extends('all.layout.index')

@section('title', 'Detail Donasi')
@section('landing')
    <style>
        .fixed-top {
    position: fixed;
    top: 85px;
    width: 100%;
    max-width: 400px; /* Sesuaikan dengan lebar aslinya */
    z-index: 50;
}
    </style>

<section class="px-4 sm:px-6 lg:px-36 mt-28 mb-10">
    <p class="text-gray-600 text-sm sm:text-base"><i class="fa-solid fa-house"></i> Donasi > Detail Donasi</p>

    @php
        $pathImg1 = $bencana->foto_bencana ?? 'Frame 1397.png';
    @endphp

    <div class="flex flex-col lg:flex-row mt-5 gap-4">
        <div class="w-full lg:w-[800px]">
            <img src="{{ asset("uploads/bencana/$pathImg1") }}" alt="Main Image" class="w-full h-full object-cover rounded-lg shadow">
        </div>
        <div class="w-full lg:w-[500px] flex flex-col gap-3">
            <img src="{{ asset('/img/donasi/detail-donasi.png') }}" alt="Image 2" class="rounded-lg shadow">
            <img src="{{ asset('/img/donasi/detail-donasi2.png') }}" alt="Image 3" class="rounded-lg shadow">
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-6 justify-between mt-6">
        <div class="w-full lg:w-[850px]">
            <h1 class="text-2xl font-bold text-gray-800">{{ $bencana->nama_bencana }}</h1>
            <p class="mt-2 text-gray-700">{{ $bencana->deskripsi_bencana }}</p>

            @php
                use App\Util\FormatRupiah;
            @endphp

            <div class="flex flex-wrap gap-5 mt-4">
                <div class="flex-1 min-w-[150px] border rounded-lg shadow-md p-5 bg-white">
                    <p class="text-lg text-gray-600">Donasi Terkumpul</p>
                    <p class="text-2xl font-bold text-green-600">Rp. {{ FormatRupiah::rupiah($bencana->total_donasi_uang ?? 0) }}</p>
                </div>
                <div class="flex-1 min-w-[150px] border rounded-lg shadow-md p-5 bg-white">
                    <p class="text-lg text-gray-600">Barang Terkumpul</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $bencana->total_donasi_barang ?? 0 }} Barang</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                <!-- Info Bencana Cards -->
                @php
                    $info = [
                        ['icon' => 'house-chimney-crack', 'color' => 'text-red-500', 'label' => 'Tingkat Kerusakan', 'value' => $bencana->informasiBencana->dampak_kerusakan],
                        ['icon' => 'person-falling-burst', 'color' => 'text-red-600', 'label' => 'Korban Meninggal', 'value' => $bencana->informasiBencana->korban_meninggal],
                        ['icon' => 'person-hiking', 'color' => 'text-yellow-500', 'label' => 'Korban Mengungsi', 'value' => $bencana->informasiBencana->korban_mengungsi],
                        ['icon' => 'user-injured', 'color' => 'text-orange-500', 'label' => 'Korban Terluka', 'value' => $bencana->informasiBencana->korban_terluka],
                        ['icon' => 'location-dot', 'color' => 'text-blue-500', 'label' => 'Lokasi', 'value' => $bencana->desa->nama_desa],
                    ];
                @endphp
                @foreach ($info as $i)
                <div class="flex items-center p-4 bg-gray-100 rounded-lg shadow">
                    <i class="fa-solid fa-{{ $i['icon'] }} text-xl {{ $i['color'] }} mr-3"></i>
                    <div>
                        <p class="text-sm text-gray-600">{{ $i['label'] }}</p>
                        <p class="font-semibold text-gray-800">{{ $i['value'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-800">Kebutuhan Barang</h2>
                <div class="overflow-x-auto mt-3">
                    <table class="w-full border text-sm rounded-lg overflow-hidden min-w-[400px]">
                        <thead class="bg-[#567E93] text-white">
                            <tr>
                                <th class="p-3 text-left">No</th>
                                <th class="p-3 text-left">Nama Kebutuhan</th>
                                <th class="p-3 text-left">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($kebutuhanKorban as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $item->nama_kebutuhan }}</td>
                                <td class="p-3">{{ $item->jumlah_kebutuhan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-800">Peta Lokasi</h2>
                <div id="map" class="h-[300px] mt-2 z-0 rounded-lg border shadow w-full"></div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-full lg:w-[400px]">
            <div id="boxDonasi" class="lg:sticky lg:top-24 border shadow-md rounded-lg p-5 bg-white">
                <p class="text-xl font-semibold text-center text-gray-700">Donasi Tersedia</p>
                @php
                    $progresBar = ($bencana->total_donasi_uang / $bencana->target_uang_donasi) * 100;
                @endphp
                <p class="text-2xl font-bold text-center text-green-600 mt-2">
                    Rp. {{ FormatRupiah::Rupiah($bencana->target_uang_donasi - $bencana->total_donasi_uang) }}
                </p>

                <div class="w-full mt-4 bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-600 h-3 rounded-full transition-all duration-300" style="width: {{ $progresBar }}%"></div>
                </div>

                <p class="text-lg mt-4 font-medium text-center text-gray-700">Kebutuhan Barang</p>
                <p class="text-center text-xl font-semibold text-gray-800">50 <span class="text-base">jenis</span></p>

                <a href="{{ route('user.donasi.tambah', $bencana->id_laporan_bencana) }}"
                   class="bg-[#283F50] hover:bg-[#1f323f] transition duration-200 text-white mt-4 block w-full text-center py-2 rounded-lg text-lg font-medium">
                    Donasi Sekarang
                </a>
                <p class="mt-4 text-sm text-gray-500 text-center">Dikelola Oleh Relawan & BPDB Jember</p>
            </div>
        </div>
    </div>
</section>

    <script>
        var map = L.map('map').setView([{{ $bencana->latitude }}, {{ $bencana->longitude }}], 14);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var markerBencana = L.marker([{{ $bencana->latitude }}, {{ $bencana->longitude }}]).addTo(map)
            .bindPopup("<b>Pusat Bencana</b>").openPopup();

        $.ajax({
            url: "/api/posko/" + {{ $bencana->id_laporan_bencana }},
            method: "GET",
            success: function(response) {
                response.forEach(function(element) {
                    L.marker([element.latitude, element.longitude]).addTo(map)
                        .bindPopup("<b>Posko " + element.nama_posko + "</b><br><a href='/detail-distribusi/" + element.id_posko + "' class='text-blue-600 underline'>Lihat Detail</a>");
                });
            }
        });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const boxDonasi = document.getElementById("boxDonasi");
    const offsetTop = boxDonasi.offsetTop - 85;

    function handleScroll() {
        const isDesktop = window.innerWidth >= 1024;

        if (!isDesktop) {
            boxDonasi.classList.remove("fixed-top");
            return;
        }

        if (window.pageYOffset > offsetTop) {
            boxDonasi.classList.add("fixed-top");
        } else {
            boxDonasi.classList.remove("fixed-top");
        }
    }

    window.addEventListener("scroll", handleScroll);
    window.addEventListener("resize", handleScroll); // update saat resize
});

    </script>
@endsection
