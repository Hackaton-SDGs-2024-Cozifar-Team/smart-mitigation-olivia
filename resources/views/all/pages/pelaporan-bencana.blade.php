@extends('all.layout.index')

@section('title', 'Landing Page')
@section('landing')
<section class="mx-5 sm:mx-10 md:mx-20 lg:mx-36 mt-20 md:mt-28 mb-10">
    <p class="text-sm sm:text-base"><i class="fa-solid fa-house"></i> Donasi > Pelaporan Bencana</p>

    <div class="border rounded shadow-lg mt-5 p-5 sm:p-8 md:p-10">
        <div id="formUang">
            <h1 class="text-[20px] sm:text-[23px] font-bold text-center mb-5">Form Laporan Bencana</h1>
            <form action="{{ route('pelaporan-bencana.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="longitude" id="inpLongitude">
                <input type="hidden" name="latitude" id="inpLatitude">

                <div class="flex justify-center items-start gap-y-5 gap-x-7 flex-wrap">
                    <div class="grid w-full sm:w-80">
                        <label class="text-[15px] sm:text-[16px] mb-2">Jenis Bencana</label>
                        <select name="nama_bencana" class="rounded border-slate-400 text-[15px] p-2">
                            <option value="">Pilih Jenis Bencana</option>
                            <option value="Banjir">Banjir</option>
                            <option value="Gempa Bumi">Gempa Bumi</option>
                            <option value="Tanah Longsor">Tanah Longsor</option>
                        </select>
                        @error('nama_bencana')
                            <small class="text-red-500">*{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="grid w-full sm:w-80">
                        <label class="text-[15px] sm:text-[16px] mb-2">Tingkat Bencana</label>
                        <select name="tingkat_bencana" class="rounded border-slate-400 text-[15px] p-2">
                            <option value="">Pilih Tingkat Bencana</option>
                            <option value="rendah">Rendah</option>
                            <option value="sedang">Sedang</option>
                            <option value="tinggi">Tinggi</option>
                        </select>
                        @error('tingkat_bencana')
                            <small class="text-red-500">*{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="grid w-full sm:w-80">
                        <label class="text-[15px] sm:text-[16px] mb-2">Kecamatan</label>
                        <select name="id_kecamatan" class="rounded border-slate-400 text-[15px] p-2">
                            <option value="">Pilih Tingkat Bencana</option>
                            @foreach ($kecamatan as $item)
                                <option value="{{ $item['id_kecamatan'] }}">{{ $item['nama_kecamatan'] }}</option>
                            @endforeach
                        </select>
                        @error('id_kecamatan')
                            <small class="text-red-500">*{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="grid w-full sm:w-80">
                        <label for="id_desa" class="text-[15px] sm:text-[16px] mb-2">Desa Bencana</label>
                        <select name="id_desa" class="rounded border-slate-400 text-[15px] p-2">
                            <option value="">-- Pilih Desa Bencana --</option>
                            @foreach ($desas as $desa)
                                <option value="{{ $desa->id_desa }}">{{ $desa->nama_desa }}</option>
                            @endforeach
                        </select>
                        @error('id_desa')
                            <small class="text-red-500">*{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="grid w-full sm:w-80">
                        <label class="text-[15px] sm:text-[16px] mb-2">Deskripsi Alamat</label>
                        <textarea name="deskripsi_alamat" class="rounded border-slate-400 text-[15px] p-2" rows="5"></textarea>
                        @error('deskripsi_alamat')
                            <small class="text-red-500">*{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="grid w-full sm:w-80">
                        <label class="text-[15px] sm:text-[16px] mb-2">Deskripsi Kejadian</label>
                        <textarea name="deskripsi_bencana" class="rounded border-slate-400 text-[15px] p-2" rows="5"></textarea>
                        @error('deskripsi_bencana')
                            <small class="text-red-500">*{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-center gap-5 mt-6">
                    <div class="w-full md:w-[380px]">
                        <label class="text-[15px] sm:text-[16px] mb-2 inline-block">Upload Foto</label>
                        <label
                            class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-400 rounded-lg cursor-pointer hover:border-gray-500 transition relative">
                            <input type="file" class="hidden" name="file" id="fileInput" accept="image/*" />
                            <i class="fas fa-cloud-upload-alt text-5xl text-gray-500" id="uploadIcon"></i>
                            <p class="mt-3 text-gray-500 font-semibold" id="uploadText">Upload Bencana</p>
                            <img id="imagePreview"
                                class="absolute inset-0 w-full h-full object-cover rounded-lg opacity-0 transition-opacity duration-300"
                                alt="Image Preview">
                        </label>
                        @error('file')
                            <small class="text-red-500">*{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="w-full md:w-[380px]">
                        <label class="text-[15px] sm:text-[16px] mb-2 inline-block">Pilih Detail Lokasi</label>
                        <div id="map" class="h-[200px] w-full rounded border z-[1]"></div>
                        @error('longitude')
                            <small class="text-red-500">*{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-5 mt-10 sm:mt-20">
                    <button type="submit"
                        class="bg-[#283F50] text-white px-4 py-3 w-full sm:w-[200px] rounded text-[15px]">Laporkan</button>
                    <button type="reset"
                        class="bg-[#567E93] text-white px-4 py-3 w-full sm:w-[200px] rounded text-[15px]">Batal</button>
                </div>
            </form>
        </div>
    </div>
</section>


    <script text="text/javascript">
        $(document).ready(function() {

        })
    </script>
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
    </script>
    <script>
        // Ambil elemen input file dan elemen pratinjau gambar
        const fileInput = document.getElementById('fileInput');
        const imagePreview = document.getElementById('imagePreview');
        const uploadIcon = document.getElementById('uploadIcon');
        const uploadText = document.getElementById('uploadText');

        // Event listener ketika file diunggah
        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];

            // Jika file ada dan merupakan gambar
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                // Saat file berhasil dibaca
                reader.onload = (e) => {
                    imagePreview.src = e.target.result; // Set sumber gambar pratinjau
                    imagePreview.classList.add('opacity-100'); // Tampilkan gambar
                    uploadIcon.classList.add('hidden'); // Sembunyikan ikon upload
                    uploadText.classList.add('hidden'); // Sembunyikan teks upload
                };

                // Mulai membaca file
                reader.readAsDataURL(file);
            } else {
                // Jika file bukan gambar, sembunyikan pratinjau
                imagePreview.classList.remove('opacity-100');
                uploadIcon.classList.remove('hidden');
                uploadText.classList.remove('hidden');
            }
        });
    </script>
@endsection
