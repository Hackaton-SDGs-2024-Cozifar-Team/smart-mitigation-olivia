@extends('admin.layout.admin')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">
    <div class="container mx-auto px-4 py-6">
        <form action="{{ route('distribusi.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="mb-5">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Bencana</label>
                    <select  name=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="laporan_bencana">
                        <option><--- Pilih Bencana Alam ---></option>
                        @foreach ($laporan_bencana as $data)
                            <option data-reg="{{ $data->id_laporan_bencana }}" value="{{ $data->id_laporan_bencana }}">{{ $data->nama_bencana }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Posko</label>
                    <select id="posko" name="id_posko"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value=''>Pilih Posko</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label for="korban_terluka"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kebutuhan</label>
                    <input type="text" id="korban_terluka" name="nama_kebutuhan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required />
                </div>
                <div class="mb-5">
                    <label for="korban_meninggal"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                    <input type="number" id="korban_meninggal" name="jumlah"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required />
                </div>
                <div class="mb-5">
                    <label class="text-[16px] mb-2 inline-block" for="">Upload Foto</label>
                            <label
                                class="flex flex-col items-center justify-center w-96 h-48 border-2 border-dashed border-gray-400 rounded-lg cursor-pointer hover:border-gray-500 transition relative">
                                <input type="file" class="hidden" name="file" id="fileInput" accept="image/*" />
                                <i class="fas fa-cloud-upload-alt text-5xl text-gray-500" id="uploadIcon"></i>
                                <p class="mt-3 text-gray-500 font-semibold" id="uploadText">Upload Bencana</p>

                                <!-- Kontainer preview gambar -->
                                <img id="imagePreview"
                                    class="absolute inset-0 w-full h-full object-cover rounded-lg opacity-0 transition-opacity duration-300"
                                    alt="Image Preview">
                            </label>
                </div>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            <a href="{{ route('bpbd.informasi-bencana') }}"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Kembali</a>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#laporan_bencana").change(function(e) {
            var id_laporan_bencana = e.target.options[e.target.selectedIndex].dataset.reg;

            $.ajax({
                url: "/api/posko/id_laporan_bencana/" + id_laporan_bencana,
                method: "GET",
                success: function(data) {
                    $("#posko").empty();
                    $("#posko").append("<option value=''>Pilih Posko</option>");
                    data.forEach(element => {
                        $("#posko").append("<option value='" + element.id_posko + "'>" + element.nama_posko + "</option>");
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        })
    })
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