@extends('bpbd.layout.bpbd')

@section('content')
    <style>
        .active-btn {
            background-color: #283F50;
            color: #fff;
        }
    </style>
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="container mx-auto px-4 py-6">
            <form action="{{ route('posko.store') }}" method="POST">
                @csrf
                <input type="hidden" name="latitude" id="inpLatitude">
                <input type="hidden" name="longitude" id="inpLongitude">
                <input type="hidden" name="id_laporan_bencana" value="{{ $id_laporan_bencana }}">

                <div class="mb-5">
                    <label for="korban_terluka" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Posko</label>
                    <input type="text" id="korban_terluka" name="nama_posko"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                         />
                    @error('nama_posko')
                        <small class="text-red-500">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="korban_meninggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih
                        Peta</label>
                    <div id="map" class="h-[350px] z-[1] w-full"></div>
                    @error('latitude')
                    <small class="text-red-500">{{$message}}</small>
                @enderror
                </div>

                {{-- </div> --}}
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                <a href="{{ route('bpbd.informasi-bencana') }}"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Kembali</a>
            </form>

            <h1 class="text text-[23px] font-bold mt-5">Daftar Posko</h1>
            <div class="flex my-4">
                <button class="px-6 active-btn  py-3 border" id="btnSebaran">Peta Sebaran</button>
                <button class="px-6 py-3 border" id="btnTabel">Daftar Tabel</button>
            </div>
            <div id="sebaran">
                <div id="mapTampilan" class="h-[250px] z-[1] w-full"></div>
            </div>
            <div id="tabel">
                <table id="myTable" class="display w-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Posko</th>
                            <th>Latitude</th>
                            <th>longitude</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posko as $p)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">
                                <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4">{{ $p->nama_posko }}</td>
                                <td class="py-2 px-4">{{ $p->latitude }}</td>
                                <td class="py-2 px-4">{{ $p->longitude }}</td>
                                <td class="py-2 px-4 flex gap-2 items-center">
                                    <form action="{{ route('posko.destroy', $p->id_posko) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-green-700 px-4 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-green-300 rounded-lg p-2">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        var map = L.map('map').setView([-8.184486, 113.668076], 12); // Jakarta

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Variabel untuk menyimpan marker terakhir
        var lastMarker = null;

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            $("#inpLatitude").val(lat);
            $("#inpLongitude").val(lng);

            // Hapus marker sebelumnya jika ada
            if (lastMarker) {
                map.removeLayer(lastMarker);
            }

            // Tambahkan marker baru dan simpan ke variabel lastMarker
            lastMarker = L.marker([lat, lng]).addTo(map)
                .bindPopup("Latitude: " + lat + "<br>Longitude: " + lng).openPopup();
        });

        var mapTampilan = L.map('mapTampilan').setView([-8.184486, 113.668076], 12); // Jakarta

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapTampilan);

        $.ajax({
                url: "/api/posko/id_laporan_bencana/{{ $id_laporan_bencana }}",
                method: "GET",
                success: function(data) {
                    console.log(data);

                    data.forEach(element => {
                        // Mengambil koordinat dari setiap elemen data
                        var lat = element.latitude;
                        var lng = element.longitude;

                        // Menambahkan marker di posisi koordinat dari API
                        var marker = L.marker([lat, lng]).addTo(mapTampilan);

                        // Mengikat popup dengan informasi yang sesuai untuk setiap marker
                        var popupContent = "<b>" + element.nama_posko + "</b>";

                        // Menambahkan popup secara langsung ke posisi yang diinginkan di peta
                        L.popup()
                            .setLatLng([lat, lng])
                            .setContent(popupContent)
                            .addTo(mapTampilan);
                    })
                }
            })

        $("#btnSebaran").click(function() {
            $("#sebaran").show();
            $("#tabel").hide();
            $("#btnTabel").removeClass("active-btn");
            $("#btnSebaran").addClass("active-btn");
        });

        $("#btnTabel").click(function() {
            $("#sebaran").hide();
            $("#tabel").show();
            $("#btnTabel").addClass("active-btn");
            $("#btnSebaran").removeClass("active-btn");
        })

        $(document).ready(function() {
            $("#tabel").hide();
        })
    </script>
@endsection
