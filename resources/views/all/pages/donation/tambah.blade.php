@extends('all.layout.index')

@section('title', 'Donasi Bencana')
@section('landing')
    <style>
        .active-btn {
            background: #283F50;
            color: #fff;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            transform: translateY(-2px);
        }
        
        .form-input {
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .upload-area {
            transition: all 0.3s ease;
        }
        
        .upload-area:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>

<!-- Hero Section -->

<section class="px-4 sm:px-6 mt-20 lg:px-28 py-10 bg-gray-50">
       
    <!-- Donation Type Toggle -->
    <div class="max-w-4xl mx-auto">
          <nav class="flex items-center space-x-2 text-sm mb-6">
            <a href="/" class="hover:text-white transition-colors">
                <i class="fas fa-home mr-1"></i>
                Beranda
            </a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="/#donasi" class="hover:text-white transition-colors">
                Donasi
            </a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-blue1 font-medium">Form Donasi</span>
        </nav>
        <div class="bg-white rounded-2xl shadow-lg p-2 mb-8 animate-fadeInUp">
            <div class="flex">
                <button class="flex-1 px-6 py-4 rounded-xl font-semibold transition-all duration-300 active-btn" id="btnUang">
                    <i class="fas fa-money-bill-wave mr-2"></i>
                    Donasi Uang
                </button>
                <button class="flex-1 px-6 py-4 rounded-xl font-semibold transition-all duration-300 text-gray-600" id="btnBarang">
                    <i class="fas fa-box mr-2"></i>
                    Donasi Barang
                </button>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 card-hover">
            <!-- Money Donation Form -->
            <div id="formUang" class="animate-fadeInUp">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-white text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Form Donasi Uang</h2>
                    <p class="text-gray-600">Berikan bantuan dalam bentuk uang untuk membantu korban bencana</p>
                </div>
                
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-user text-blue-500 mr-2"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" id="inpNama" name="nama" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan nama lengkap Anda">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-phone text-green-500 mr-2"></i>
                                Nomor Telepon
                            </label>
                            <input type="tel" id="inpTelepon" name="telepon" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Contoh: 08123456789">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-money-bill text-yellow-500 mr-2"></i>
                                Jumlah Donasi
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-4 text-gray-500">Rp</span>
                                <input type="text" id="inpJumlah" name="jumlah" class="form-input w-full p-4 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="50.000">
                            </div>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <button type="button" class="quick-amount px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm hover:bg-blue-100 transition-colors" data-amount="50000">50K</button>
                                <button type="button" class="quick-amount px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm hover:bg-blue-100 transition-colors" data-amount="100000">100K</button>
                                <button type="button" class="quick-amount px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm hover:bg-blue-100 transition-colors" data-amount="250000">250K</button>
                                <button type="button" class="quick-amount px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm hover:bg-blue-100 transition-colors" data-amount="500000">500K</button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-comment text-purple-500 mr-2"></i>
                                Pesan (Opsional)
                            </label>
                            <textarea id="inpDeskripsi" name="deskripsi" rows="4" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" placeholder="Pesan dukungan untuk korban bencana"></textarea>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button id="btnDonasiUang" type="button" class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-4 px-8 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-heart mr-2"></i>
                            Donasi Sekarang
                        </button>
                        <button type="reset" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-4 px-8 rounded-xl font-semibold transition-all duration-300">
                            <i class="fas fa-undo mr-2"></i>
                            Reset Form
                        </button>
                    </div>
                </form>
            </div>

            <!-- Goods Donation Form -->
            <div id="formBarang" class="hidden">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-box text-white text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Form Donasi Barang</h2>
                    <p class="text-gray-600">Berikan bantuan dalam bentuk barang sesuai kebutuhan korban</p>
                </div>
                
                <form method="POST" enctype="multipart/form-data" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-user text-blue-500 mr-2"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" name="nama_donatur" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan nama lengkap Anda">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-phone text-green-500 mr-2"></i>
                                Nomor Telepon
                            </label>
                            <input type="tel" name="no_telp" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Contoh: 08123456789">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-comment text-purple-500 mr-2"></i>
                                Deskripsi Barang
                            </label>
                            <input type="text" name="deskripsi" class="form-input w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Deskripsi singkat barang yang akan didonasikan">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-camera text-indigo-500 mr-2"></i>
                                Foto Barang
                            </label>
                            <label class="upload-area flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-400 transition-colors relative overflow-hidden">
                                <input type="file" class="hidden" name="file" accept="image/*">
                                <div class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-500 font-medium">Klik untuk upload foto</p>
                                    <p class="text-xs text-gray-400">PNG, JPG hingga 5MB</p>
                                </div>
                                <img id="imagePreview" class="absolute inset-0 w-full h-full object-cover rounded-xl opacity-0 transition-opacity duration-300" alt="Preview">
                            </label>
                        </div>
                    </div>
                    
                    <!-- Needs Table -->
                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-list-check mr-2 text-blue-500"></i>
                            Pilih Kebutuhan yang Akan Didonasikan
                        </h3>
                        <div class="overflow-x-auto bg-gray-50 rounded-xl p-4">
                            <table class="w-full min-w-[600px] text-sm">
                                <thead>
                                    <tr class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                                        <th class="p-4 text-left rounded-tl-lg">No</th>
                                        <th class="p-4 text-left">Nama Kebutuhan</th>
                                        <th class="p-4 text-left">Kebutuhan</th>
                                        <th class="p-4 text-center">Pilih</th>
                                        <th class="p-4 text-left rounded-tr-lg">Jumlah Donasi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($kebutuhanKorban as $key => $k)
                                    <tr class="border-b border-gray-100 hover:bg-blue-50 transition-colors">
                                        <td class="p-4 font-medium">{{ $loop->iteration }}</td>
                                        <td class="p-4">
                                            <div class="flex items-center">
                                                <i class="fas fa-box text-orange-500 mr-2"></i>
                                                {{ $k->nama_kebutuhan }}
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                                {{ $k->jumlah_kebutuhan }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-center">
                                            <input type="checkbox" class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500" name="id_kebutuhan_korban[]" value="{{ $k->id_kebutuhan_korban }}" onclick="setJumlah('{{ $key }}',this)">
                                        </td>
                                        <td class="p-4">
                                            <input class="w-20 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-100" name="jumlah[]" id="jmlBarang{{$key}}" disabled type="number" placeholder="0">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-4 px-8 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-box mr-2"></i>
                            Donasi Barang
                        </button>
                        <button type="reset" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-4 px-8 rounded-xl font-semibold transition-all duration-300">
                            <i class="fas fa-undo mr-2"></i>
                            Reset Form
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <script text="text/javascript">
    // Quick amount buttons
    document.querySelectorAll('.quick-amount').forEach(button => {
        button.addEventListener('click', function() {
            const amount = this.getAttribute('data-amount');
            const input = document.querySelector('#inpJumlah');
            input.value = parseInt(amount).toLocaleString('id-ID');
            input.setAttribute('data-raw-value', amount); // Store raw value for processing
        });
    });

    // Format number input
    document.getElementById('inpJumlah').addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^\d]/g, ''); // Remove all non-digit characters
        if (value) {
            e.target.value = parseInt(value).toLocaleString('id-ID');
            e.target.setAttribute('data-raw-value', value); // Store raw value
        }
    });

    // Image preview
    document.querySelector('input[type="file"]').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('opacity-0');
                preview.classList.add('opacity-100');
            };
            reader.readAsDataURL(file);
        }
    });

    function setJumlah(id, checkbox) {
        const input = document.getElementById('jmlBarang' + id);
        input.disabled = !checkbox.checked;
        if (!checkbox.checked) {
            input.value = '';
        }
    }

    $(document).ready(function() {
        $("#formUang").show();
        $("#formBarang").hide();
        
        $("#btnUang").click(function() {
            $("#formUang").show();
            $("#formBarang").hide();
            $("#btnBarang").removeClass("active-btn").addClass("text-gray-600");
            $("#btnUang").addClass("active-btn").removeClass("text-gray-600");
        });
        
        $("#btnBarang").click(function() {
            $("#formUang").hide();
            $("#formBarang").show();
            $("#btnUang").removeClass("active-btn").addClass("text-gray-600");
            $("#btnBarang").addClass("active-btn").removeClass("text-gray-600");
        });

        $("#btnDonasiUang").click(function() {
            // Validate inputs
            const nama = $("#inpNama").val().trim();
            const telepon = $("#inpTelepon").val().trim();
            const jumlahInput = $("#inpJumlah");
            const deskripsi = $("#inpDeskripsi").val().trim();

            if (!nama) {
                alert("Nama harus diisi!");
                return;
            }

            if (!telepon) {
                alert("Nomor telepon harus diisi!");
                return;
            }

            // Get raw amount value
            let amount = jumlahInput.attr('data-raw-value') || jumlahInput.val().replace(/[^\d]/g, '');
            
            if (!amount || parseInt(amount) < 1000) {
                alert("Jumlah donasi minimal Rp 1.000!");
                return;
            }

            // Convert to integer
            amount = parseInt(amount);

            var data = {
                _token: "{{ csrf_token() }}",
                amount: amount,
                nama: nama,
                telepon: telepon,
                deskripsi: deskripsi,
                id_laporan_bencana: {{ $id }},
            };
            
            console.log("Sending data:", data);
            
            // Disable button to prevent double submission
            $("#btnDonasiUang").prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...');
            
            $.ajax({
                url: "/get-token",
                method: "post",
                data: data,
                success(res) {
                    console.log("Token response:", res);
                    
                    window.snap.pay(res, {
                        onSuccess: function(result) {
                            console.log("Payment success:", result);
                            $.ajax({
                                url: "/api/callback",
                                method: "post",
                                data: result,
                                success(res) {
                                    alert("Donasi berhasil! Terima kasih atas kepedulian Anda.");
                                    window.location.assign("{{ url('/') }}");
                                },
                                error(err) {
                                    console.error("Callback error:", err);
                                    alert("Terjadi kesalahan saat memproses donasi.");
                                }
                            });
                        },
                        onPending: function(result) {
                            console.log("Payment pending:", result);
                            alert("Menunggu pembayaran Anda!");
                        },
                        onError: function(result) {
                            console.log("Payment error:", result);
                            alert("Pembayaran gagal!");
                        },
                        onClose: function() {
                            alert('Anda menutup popup pembayaran tanpa menyelesaikan transaksi');
                        }
                    });
                },
                error(err) {
                    console.error("Token error:", err);
                    alert("Terjadi kesalahan saat memproses permintaan. Silakan coba lagi.");
                },
                complete() {
                    // Re-enable button
                    $("#btnDonasiUang").prop('disabled', false).html('<i class="fas fa-heart mr-2"></i>Donasi Sekarang');
                }
            });
        });
    });
</script>
@endsection
