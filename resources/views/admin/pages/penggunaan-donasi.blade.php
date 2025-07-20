<title>{{ $judul }}</title>
@extends('admin.layout.admin')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="mb-5">
            <a href="{{ route('admin.penggunaan-donasi.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">+
                Penggunaan Donasi</a>
        </div>

        @if (session('success'))
            <div id="alert-3"
                class="flex items-center p-4 mb-4 text-green-900 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-100 text-green-700 rounded-lg focus:ring-2 focus:ring-green-500 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-500 dark:hover:bg-gray-800"
                    data-dismiss-target="#alert-3" aria-label="Close" onclick="this.parentElement.style.display='none';">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        <div class="container mx-auto px-4 py-6">
            <div class="overflow-x-auto">
                <table id="myTable" class="display w-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bencana</th>
                            <th>Nama Kebutuhan</th>
                            <th>Nominal Uang</th>
                            <th>Tanggal Pemebelian</th>
                            <th>Foto Struk</th>
                            <th>Foto Bukti</th>
                        </tr>
                    </thead>
                    @foreach ($penggunaan_donasi as $penggunaan)
                        <tbody>
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">
                                <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4">{{ $penggunaan->laporan->nama_bencana }}</td>
                                <td class="py-2 px-4">{{ $penggunaan->nama_kebutuhan }}</td>
                                <td class="py-2 px-4">{{ $penggunaan->nominal_uang }}</td>
                                <td class="py-2 px-4">{{ $penggunaan->tanggal_pembelian }}</td>
                                <td class="py-2 px-4">
                                    <img src="{{ asset('uploads/penggunaan-donasi/' . $penggunaan->foto_struk) }}" alt="Struk"
                                        style="width: 80px; height: auto;">
                                </td>
                                <td class="py-2 px-4">
                                    <img src="{{ asset('uploads/penggunaan-donasi/' . $penggunaan->bukti_keterangan) }}" alt="Struk"
                                        style="width: 80px; height: auto;">
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
