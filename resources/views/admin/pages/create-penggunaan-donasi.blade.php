@extends('admin.layout.admin')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="container mx-auto px-4 py-6">
            <form action="{{ route('admin.penggunaan-donasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="mb-5">
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Bencana</label>
                        <select id="countries" name="id_lapora_bencana"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            onchange="updateMaxNominal()">
                            <option value="" disabled selected><--- Pilih Bencana Alam ---></option>
                            @foreach ($disasterData as $data)
                                <option value="{{ $data['id_laporan_bencana'] }}" data-sisa="{{ $data['sisa'] }}"
                                    @if ($data['sisa'] <= 0) hidden @endif>
                                    {{ $data['nama_bencana'] }} - Sisa donasi
                                    {{ number_format($data['sisa'], 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label for="tanggal_pembelian"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pembelian</label>
                        <input type="date" id="tanggal_pembelian" name="tanggal_pembelian"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                    </div>

                    <div class="mb-5">
                        <label for="nominal_uang"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nominal Pembelian</label>
                        <input type="number" id="nominal_uang" name="nominal_uang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required oninput="validateNominal()" />
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="foto_struk">Foto
                            Struk Pembelian</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="foto_struk"
                                class="flex flex-col items-center justify-center w-full h-32 border-2 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="ri-download-cloud-line text-5xl mb-3"></i>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Klik untuk upload</span> atau drag dan drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, or JPEG (MAX. 5MB)</p>
                                </div>
                                <input id="foto_struk" name="foto_struk" type="file" class="hidden"
                                    accept="image/png, image/jpeg, image/jpg" onchange="previewFile(event, 'struk')">
                            </label>
                        </div>
                        <div id="file-info-struk" class="mt-3 hidden">
                            <p class="text-sm text-gray-700 dark:text-gray-300 font-medium" id="file-name-struk"></p>
                            <img id="image-preview-struk"
                                class="mt-2 w-32 h-32 object-cover rounded-md border border-gray-300 dark:border-gray-600"
                                alt="Image Preview">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Kebutuhan</label>
                        <textarea id="message" rows="6" name="nama_kebutuhan"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder=""></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="bukti_keterangan">Foto Barang</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="bukti_keterangan"
                                class="flex flex-col items-center justify-center w-full h-32 border-2 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="ri-download-cloud-line text-5xl mb-3"></i>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Klik untuk upload</span> atau drag dan drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, or JPEG (MAX. 5MB)</p>
                                </div>
                                <input id="bukti_keterangan" name="bukti_keterangan" type="file" class="hidden"
                                    accept="image/png, image/jpeg, image/jpg" onchange="previewFile(event, 'barang')">
                            </label>
                        </div>
                        <div id="file-info-barang" class="mt-3 hidden">
                            <p class="text-sm text-gray-700 dark:text-gray-300 font-medium" id="file-name-barang"></p>
                            <img id="image-preview-barang"
                                class="mt-2 w-32 h-32 object-cover rounded-md border border-gray-300 dark:border-gray-600"
                                alt="Image Preview">
                        </div>
                    </div>
                </div>
                <div class="flex item-center justify-center space-x-3">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    <a href="{{ route('admin.penggunaan-donasi') }}"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewFile(event, type) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            const fileInfo = document.getElementById(`file-info-${type}`);
            const fileName = document.getElementById(`file-name-${type}`);
            const imagePreview = document.getElementById(`image-preview-${type}`);

            if (file) {
                fileName.textContent = file.name;
                fileInfo.classList.remove('hidden');

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        function updateMaxNominal() {
            const select = document.getElementById('countries');
            const selectedOption = select.options[select.selectedIndex];
            const sisa = selectedOption.getAttribute('data-sisa');
            const nominalInput = document.getElementById('nominal_uang');

            if (sisa) {
                nominalInput.max = sisa;
            } else {
                nominalInput.removeAttribute('max');
            }
        }

        function validateNominal() {
            const nominalInput = document.getElementById('nominal_uang');
            const max = nominalInput.max;

            if (nominalInput.value > max) {
                alert('Nominal tidak boleh lebih besar dari sisa donasi yang tersedia.');
                nominalInput.value = max; // Atur kembali ke maksimum
            }
        }
    </script>
@endsection
