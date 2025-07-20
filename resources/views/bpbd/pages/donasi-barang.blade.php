<title>{{ $judul }}</title>
@extends('bpbd.layout.bpbd')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6 b-6">
        <div class="container mx-auto px-4 py-6">
            <div
                class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px">
                    <li class="me-2">
                        <a id="tab-diterima" onclick="tampilkanKonten('diterima')"
                            class="inline-block font-bold p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500"
                            aria-current="page">Donasi Diterima</a>
                    </li>
                    <li class="me-2">
                        <a id="tab-ditolak" onclick="tampilkanKonten('ditolak')"
                            class="inline-block font-bold p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Donasi
                            Ditolak</a>
                    </li>
                </ul>
            </div>

            @if (session('success'))
                <div id="alert-3"
                    class="flex items-center p-4 mb-4 text-green-900 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-100 text-green-700 rounded-lg focus:ring-2 focus:ring-green-500 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-500 dark:hover:bg-gray-800"
                        data-dismiss-target="#alert-3" aria-label="Close"
                        onclick="this.parentElement.style.display='none';">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif

            {{-- diterima --}}
            <div id="konten-diterima" class="overflow-x-auto mt-8">
                <table id="myTable" class="display w-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bencana</th>
                            <th>Nama Penyumbang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Tanggal Donasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donasi_barang as $donasi)
                            @if ($donasi->status == 'diterima')
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $donasi->laporan->nama_bencana }}</td>
                                    <td>{{ $donasi->user->nama }}</td>
                                    <td>{{ $donasi->kebutuhan->nama_kebutuhan }}</td>
                                    <td>{{ $donasi->jumlah_barang }}</td>
                                    <td>{{ $donasi->tanggal_donasi }}</td>
                                    <td class="flex items-center">
                                        <form action="{{ route('bpbd.donasi-barang.ditolak', $donasi->id_donasi) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                                <i class="ri-hand"></i>
                                            </button>
                                        </form>
                                        <form action="#" method="POST">
                                            <button type="submit"
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                <i class="ri-close-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- ditolak --}}
            <div id="konten-ditolak" class="overflow-x-auto mt-8 hidden">
                <table id="myTable1" class="display w-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bencana</th>
                            <th>Nama Penyumbang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Tanggal Donasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donasi_barang as $donasi)
                            @if ($donasi->status == 'ditolak')
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $donasi->laporan->nama_bencana }}</td>
                                    <td>{{ $donasi->user->nama }}</td>
                                    <td>{{ $donasi->kebutuhan->nama_kebutuhan }}</td>
                                    <td>{{ $donasi->jumlah_barang }}</td>
                                    <td>{{ $donasi->tanggal_donasi }}</td>
                                    <td class="flex items-center">
                                        <button type="button"
                                            class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                            <i class="ri-hand"></i>
                                        </button>
                                        <button type="button"
                                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                            <i class="ri-close-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function tampilkanKonten(tab) {
            // Sembunyikan semua bagian konten
            document.getElementById('konten-diterima').classList.add('hidden');
            document.getElementById('konten-ditolak').classList.add('hidden');

            // Tampilkan bagian konten yang dipilih
            document.getElementById(`konten-${tab}`).classList.remove('hidden');

            // Reset tampilan tab aktif
            document.getElementById('tab-diterima').classList.remove('text-blue-600', 'border-blue-600');
            document.getElementById('tab-ditolak').classList.remove('text-blue-600', 'border-blue-600');

            if (tab === 'diterima') {
                document.getElementById('tab-diterima').classList.add('text-blue-600', 'border-blue-600');
            } else {
                document.getElementById('tab-ditolak').classList.add('text-blue-600', 'border-blue-600');
            }
        }

        tampilkanKonten('diterima');
    </script>
@endsection
