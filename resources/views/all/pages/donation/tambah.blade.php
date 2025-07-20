@extends('all.layout.index')

@section('title', 'Landing Page')
@section('landing')
    <style>
        .active-btn {
            background-color: #283F50;
            color: #fff;
        }
    </style>
  <section class="px-4 sm:px-6 lg:px-28 mt-28 mb-10">
    <p class="text-sm text-gray-600 mb-4"><i class="fa-solid fa-house"></i> Donasi > Detail Donasi</p>

    <div class="flex mt-4 flex-wrap gap-3">
        <button class="px-6 py-3 border active-btn" id="btnUang">Uang</button>
        <button class="px-6 py-3 border" id="btnBarang">Barang</button>
    </div>

    <div class="border rounded shadow-lg mt-5 p-4 sm:p-6 md:p-10">
        <div id="formUang">
            <h1 class="text-[23px] font-bold text-center mb-5">Form Donasi Uang</h1>
            <form action="">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 justify-items-center">
                    <div class="w-full max-w-xs">
                        <label class="text-[16px] mb-2 block">Nama</label>
                        <input type="text" name="nama" class="w-full rounded border border-slate-400 text-[16px] p-2" placeholder="Nama">
                    </div>
                    <div class="w-full max-w-xs">
                        <label class="text-[16px] mb-2 block">No telepon</label>
                        <input type="text" name="telepon" class="w-full rounded border border-slate-400 text-[16px] p-2" placeholder="No telepon">
                    </div>
                    <div class="w-full max-w-xs">
                        <label class="text-[16px] mb-2 block">Jumlah</label>
                        <input type="text" name="jumlah" class="w-full rounded border border-slate-400 text-[16px] p-2" placeholder="Jumlah Donasi">
                    </div>
                    <div class="w-full max-w-xs">
                        <label class="text-[16px] mb-2 block">Deskripsi</label>
                        <input type="text" name="deskripsi" class="w-full rounded border border-slate-400 text-[16px] p-2" placeholder="Deskripsi">
                    </div>
                </div>
                <div class="flex flex-wrap justify-center gap-5 mt-10">
                    <button type="submit" class="bg-[#283F50] text-white p-3 w-40 rounded text-[15px]">Donasi Sekarang</button>
                    <button type="reset" class="bg-[#567E93] text-white p-3 w-40 rounded text-[15px]">Batal</button>
                </div>
            </form>
        </div>

        <div id="formBarang" class="hidden">
            <h1 class="text-[23px] font-bold text-center mb-5">Form Donasi Barang</h1>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 justify-items-center">
                    <div class="w-full max-w-xs">
                        <label class="text-[16px] mb-2 block">Nama</label>
                        <input type="text" name="nama_donatur" class="w-full rounded border border-slate-400 text-[16px] p-2" placeholder="Nama">
                    </div>
                    <div class="w-full max-w-xs">
                        <label class="text-[16px] mb-2 block">No telepon</label>
                        <input type="text" name="no_telp" class="w-full rounded border border-slate-400 text-[16px] p-2" placeholder="No telepon">
                    </div>
                    <div class="w-full max-w-xs">
                        <label class="text-[16px] mb-2 block">Deskripsi</label>
                        <input type="text" name="deskripsi" class="w-full rounded border border-slate-400 text-[16px] p-2" placeholder="Deskripsi">
                    </div>
                    <div class="w-full sm:w-96">
                        <label class="text-[16px] mb-2 block">Upload Foto</label>
                        <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-400 rounded-lg cursor-pointer hover:border-gray-500 transition relative">
                            <input type="file" class="hidden" name="file" accept="image/*">
                            <i class="fas fa-cloud-upload-alt text-5xl text-gray-500"></i>
                            <p class="mt-3 text-gray-500 font-semibold">Upload Gambar</p>
                            <img id="imagePreview" class="absolute inset-0 w-full h-full object-cover rounded-lg opacity-0 transition-opacity duration-300" alt="Preview">
                        </label>
                    </div>
                </div>
                <div class="overflow-x-auto mt-5">
                    <table class="w-full min-w-[600px] text-sm text-left border">
                        <thead class="bg-[#567E93] text-white">
                            <tr>
                                <th class="p-4">No</th>
                                <th class="p-4">Nama Kebutuhan</th>
                                <th class="p-4">Jumlah Yg Dibutuhkan</th>
                                <th class="p-4">Pilih</th>
                                <th class="p-4">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Isi data kebutuhan -->
                            @foreach ($kebutuhanKorban as $key => $k)
                            <tr class="border-b">
                                <td class="p-4">{{ $loop->iteration }}</td>
                                <td class="p-4">{{ $k->nama_kebutuhan }}</td>
                                <td class="p-4">{{ $k->jumlah_kebutuhan }}</td>Add commentMore actions
                                <td class="p-4">
                                    <input type="checkbox" class="rounded" name="id_kebutuhan_korban[]" value="{{ $k->id_kebutuhan_korban }}" onclick="setJumlah('{{ $key }}',this)" id="">
                                </td>
                                <td class="p-4"><input class="w-14 p-2 rounded" name="jumlah[]" id="jmlBarang{{$key}}" disabled type="number"></td>
                            </tr>
                        @endforeach
                            <!-- Tambah baris lainnya -->
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-wrap justify-center gap-5 mt-10">
                    <button type="submit" class="bg-[#283F50] text-white p-3 w-40 rounded text-[15px]">Donasi Sekarang</button>
                    <button type="reset" class="bg-[#567E93] text-white p-3 w-40 rounded text-[15px]">Batal</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <script text="text/javascript">
    function setJumlah(id,checkbox) {
        if (checkbox.checked) {
            $("#jmlBarang"+id).prop('disabled', false);
        }else{
            $("#jmlBarang"+id).prop('disabled', true);
        }
        
    }

        $(document).ready(function() {
            $("#formUang").show();
            $("#formBarang").hide();
            $("#btnUang").click(function() {
                $("#formUang").show();
                $("#formBarang").hide();
                $("#btnBarang").removeClass("active-btn");
                $("#btnUang").addClass("active-btn");
            });
            $("#btnBarang").click(function() {
                $("#formUang").hide();
                $("#formBarang").show();
                $("#btnUang").removeClass("active-btn");
                $("#btnBarang").addClass("active-btn");
            });

            $("#btnDonasiUang").click(function() {
                var data = {
                    _token: "{{ csrf_token() }}",
                    amount: $("#inpJumlah").val(),
                    deskripsi: $("#inpDeskripsi").val(),
                    id_laporan_bencana: {{ $id }},
                };
                console.log(data);
                
                var token = "";
                $.ajax({
                url: "/get-token",
                method: "post",
                data: data,
                success(res) {
                    token = res;
                    window.snap.pay(token, {
                        onSuccess: function(result) {
                            /* You may add your own implementation here */
                            $.ajax({
                                url: "/api/callback",
                                method: "post",
                                data: result,
                                success(res) {
                                    window.location.assign(
                                        `http://127.0.0.1:8000/`
                                    );
                                },
                                error(err) {

                                }
                            });

                        },
                        onPending: function(result) {
                            /* You may add your own implementation here */
                            alert("wating your payment!");

                        },
                        onError: function(result) {
                            /* You may add your own implementation here */
                            alert("payment failed!");

                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            alert(
                                'you closed the popup without finishing the payment'
                            );
                        }
                    })
                },
                error(err) {

                }
            })
            })
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
