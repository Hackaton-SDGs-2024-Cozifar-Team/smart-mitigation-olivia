<section id="fitur-page" class="flex flex-col justify-center items-center w-full bg-blue1 py-[100px] text-white">
    <h2 class="text-[40px] font-[700] text-blue4">TEMUKAN BERBAGAI FITUR</h2>
    <p class="text-blue4 text-[20px] font-[300]">Menyediakan berbagai fitur untuk mitigasi dan penanganan bencana alam
    </p>
    <div class="py-[30px] flex flex-wrap px-[15px] md:px-[100px] gap-4 mt-8 justify-center">
        {{-- card 1 --}}
        <div class="group bg-blue4 text-black w-full md:w-[480px] rounded-xl hover:shadow-2xl hover:shadow-blue-400/25 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer">
            <p class="p-[15px] text-center bg-blue4 rounded-t-xl text-[24px] font-semibold text-blue1 ">Prediksi Bencana
            </p>
            <div class="bg-white rounded-xl flex h-[230px] group-hover:bg-gradient-to-br group-hover:from-white group-hover:to-blue-50 transition-all duration-300">
                <div class="px-[30px] py-[20px]">
                    <p class="text-[18px] font-[600] group-hover:text-blue-700 transition-colors duration-300">Prediksi Bencana Banjir Berbasis Artificial Intellegence </p>
                    <div class="text-[12px] mt-2">
                        <p class="group-hover:text-blue-600 transition-colors duration-300">Menggunakan parameter:</p>
                        <span class="flex items-center gap-2 hover:translate-x-2 transition-transform duration-300">
                            <img src="../img/fitur/triangle.png" alt="" class="w-2 group-hover:animate-pulse">
                            <p class="group-hover:text-gray-700 transition-colors duration-300">Cuaca (cuaca, tutupan awan, dll)</p>
                        </span>
                        <span class="flex items-center gap-2 hover:translate-x-2 transition-transform duration-300">
                            <img src="../img/fitur/triangle.png" alt="" class="w-2 group-hover:animate-pulse">
                            <p class="group-hover:text-gray-700 transition-colors duration-300">Iklim (suhu, kecepatan angin, dll)</p>
                        </span>
                        <span class="flex items-center gap-2 hover:translate-x-2 transition-transform duration-300">
                            <img src="../img/fitur/triangle.png" alt="" class="w-2 group-hover:animate-pulse">
                            <p class="group-hover:text-gray-700 transition-colors duration-300">Jarak Terhadap Sungai</p>
                        </span>
                        <span class="flex items-center gap-2 hover:translate-x-2 transition-transform duration-300">
                            <img src="../img/fitur/triangle.png" alt="" class="w-2 group-hover:animate-pulse">
                            <p class="group-hover:text-gray-700 transition-colors duration-300">Tutupan Lahan</p>
                        </span>
                    </div>
                </div>
                <div class="pe-6 py-[20px]">
                    <img src="/img/fitur/prediksi-bencana.png" alt="" class="w-[350px] group-hover:scale-110 transition-transform duration-500">
                    <a href="{{ route('prediksi-bencana') }}"
                        class="w-full tex-center py-2 block text-center bg-blue1 mt-3 text-white font-[300] rounded-lg text-[12px] hover:bg-blue-600 hover:shadow-lg transform hover:scale-105 transition-all duration-300">Lihat
                        Prediksi</a>
                </div>
            </div>
        </div>
        {{-- card 2 --}}
        <div class="group bg-blue4 text-black w-full md:w-[480px] rounded-xl hover:shadow-2xl hover:shadow-blue-400/25 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer">
            <p class="p-[15px] text-center bg-blue4 rounded-t-xl text-[24px] font-semibold text-blue1 ">Clustering Resiko Banjir
            </p>
            <div class="bg-white rounded-xl flex h-[230px] group-hover:bg-gradient-to-br group-hover:from-white group-hover:to-blue-50 transition-all duration-300">
                <div class="px-[30px] py-[20px]">
                    <p class="text-[18px] font-[600] group-hover:text-blue-700 transition-colors duration-300">Visualisasi Peta Clustering Resiko Banjir Berdasarkan desa</p>
                    <div class="text-[12px] mt-2">
                        <p class="group-hover:text-gray-700 transition-colors duration-300">Menampilkan daerah resiko banjir berdasarkan perhitungan kmeans</p>
                    </div>
                </div>
                <div class="pe-6 py-[20px]">
                    <img src="/img/fitur/clustering.png" alt="" class="w-[350px] group-hover:scale-110 transition-transform duration-500">
                    <a href="{{ route('clustering-banjir') }}"
                        class="w-full tex-center py-2 block text-center bg-blue1 mt-3 text-white font-[300] rounded-lg text-[12px] hover:bg-blue-600 hover:shadow-lg transform hover:scale-105 transition-all duration-300">Lihat
                        Prediksi</a>
                </div>
            </div>
        </div>

        <div class="group bg-blue4 text-black w-full md:w-[480px] rounded-xl hover:shadow-2xl hover:shadow-blue-400/25 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer">
            <p class="p-[15px] text-center bg-blue4 rounded-t-xl text-[24px] font-semibold text-blue1 ">Peta Sebaran
                Bencana</p>
            <div class="bg-white rounded-xl flex h-[230px] group-hover:bg-gradient-to-br group-hover:from-white group-hover:to-blue-50 transition-all duration-300">
                <div class="px-[30px] py-[20px]">
                    <p class="text-[18px] font-[600] group-hover:text-blue-700 transition-colors duration-300">Visualisasi Peta Sebaran Bencana Berdasarkan Laporan Bencana</p>
                    <div class="text-[12px] mt-2">
                        <span class="flex items-center gap-2">
                            <p class="group-hover:text-gray-700 transition-colors duration-300">Menampilkan daerah yang terkena bencana berdasarkan hasil laporan bencana</p>
                        </span>
                    </div>
                </div>
                <div class="pe-6 py-[20px]">
                    <img src="/img/fitur/sebaran-bencana.png" alt="" class="w-[400px] group-hover:scale-110 transition-transform duration-500">
                    <a href="{{ route('persebaran-bencana') }}"
                        class="w-full tex-center py-2 block text-center bg-blue1 mt-3 text-white font-[300] rounded-lg text-[12px] hover:bg-blue-600 hover:shadow-lg transform hover:scale-105 transition-all duration-300">Lihat
                        Peta Sebaran</a>
                </div>
            </div>
        </div>
        {{-- card 3 --}}
        <div class="group bg-blue4 text-black w-full md:w-[480px] rounded-xl hover:shadow-2xl hover:shadow-blue-400/25 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer">
            <p class="p-[15px] text-center bg-blue4 rounded-t-xl text-[24px] font-semibold text-blue1 ">Tutupan Lahan</p>
            <div class="bg-white rounded-xl flex h-[230px] group-hover:bg-gradient-to-br group-hover:from-white group-hover:to-blue-50 transition-all duration-300">
                <div class="px-[30px] py-[20px]">
                    <p class="text-[18px] font-[600] group-hover:text-blue-700 transition-colors duration-300">Visualisasi Tutupan Lahan Menggunakan Google Earth Engine (GEE)
                    </p>
                    <div class="text-[12px] mt-2">
                        <span class="flex items-center gap-2">
                            <p class="group-hover:text-gray-700 transition-colors duration-300">Menampilkan tutupan lahan menggunakan Google Earth Engine</p>
                        </span>
                    </div>
                </div>
                <div class="pe-6 py-[20px]">
                    <img src="/img/fitur/tutupan-lahan.png" alt="" class="w-[400px] group-hover:scale-110 transition-transform duration-500">
                    <a href="{{ route('tutupan-lahan') }}"
                        class="w-full tex-center py-2 block text-center bg-blue1 mt-3 text-white font-[300] rounded-lg text-[12px] hover:bg-blue-600 hover:shadow-lg transform hover:scale-105 transition-all duration-300">Lihat
                        Tutupan Lahan</a>
                </div>
            </div>
        </div>
        {{-- card 4 --}}
        <div class="group bg-blue4 text-black w-full md:w-[480px] rounded-xl hover:shadow-2xl hover:shadow-blue-400/25 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer">
            <p class="p-[15px] text-center bg-blue4 rounded-t-xl text-[24px] font-semibold text-blue1 ">Laporan Bencana
            </p>
            <div class="bg-white rounded-xl flex group-hover:bg-gradient-to-br group-hover:from-white group-hover:to-red-50 transition-all duration-300">
                <div class="px-[30px] py-[20px]">
                    <p class="text-[18px] font-[600] group-hover:text-red-700 transition-colors duration-300">Laporan Bencana Terintegrasi Dengan Tim Respon Cepat</p>
                    <div class="text-[12px] mt-2">
                        <span class="flex items-center gap-2">
                            <p class="group-hover:text-gray-700 transition-colors duration-300">Fitur laporan yang terhubung langsung dengan tim respon cepat dari Badan Penanggulanan
                                Bencana Daerah atau BPDB sekitar</p>
                        </span>
                    </div>
                </div>
                <div class="pe-6 py-[20px]">
                    <img src="/img/fitur/laporan-bencana.png" alt="" class="w-[400px] group-hover:scale-110 transition-transform duration-500">
                    <a href="{{ route('pelaporan-bencana') }}"
                        class="w-full tex-center py-2 block text-center bg-blue1 mt-2 text-white font-[300] rounded-lg text-[12px] hover:bg-red-600 hover:shadow-lg transform hover:scale-105 transition-all duration-300">Laporan
                        Bencana</a>
                </div>
            </div>
        </div>
        {{-- card 5 --}}
        <div class="group bg-blue4 text-black w-full md:w-[480px] rounded-xl hover:shadow-2xl hover:shadow-blue-400/25 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer">
            <p class="p-[15px] text-center bg-blue4 rounded-t-xl text-[24px] font-semibold text-blue1 ">Donasi Bencana
            </p>
            <div class="bg-white rounded-xl flex group-hover:bg-gradient-to-br group-hover:from-white group-hover:to-green-50 transition-all duration-300">
                <div class="px-[30px] py-[20px]">
                    <p class="text-[18px] font-[600] group-hover:text-green-700 transition-colors duration-300">Donasi Bencana Sesuai Dengan Kebutuhan di Lapangan</p>
                    <div class="text-[12px] mt-2">
                        <span class="flex items-center gap-2">
                            <p class="group-hover:text-gray-700 transition-colors duration-300">Platform donasi yang transparan dan tepat sasaran sesuai dengan kebutuhan di lapangan berdasarkan data real-time</p>
                        </span>
                    </div>
                </div>
                <div class="pe-6 py-[20px]">
                    <img src="/img/fitur/donasi-bencana.png" alt="" class="w-[400px] group-hover:scale-110 transition-transform duration-500">
                    <a href="{{ route('user.donasi') }}"
                        class="w-full tex-center py-2 block text-center bg-blue1 mt-2 text-white font-[300] rounded-lg text-[12px] hover:bg-green-600 hover:shadow-lg transform hover:scale-105 transition-all duration-300">Mulai Donasi</a>
                </div>
            </div>
        </div>
    </div>
</section>