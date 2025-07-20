<title>{{ $judul }}</title>
@extends('bpbd.layout.bpbd')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="container mx-auto px-4 py-6">
            <div class="overflow-x-auto">
                <table id="myTable" class="display w-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelapor</th>
                            <th>Nama Bencana</th>
                            <th>Lokasi Kejadian</th>
                            <th>Tanggal Kejadian</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan_bencana as $bencana)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">
                                <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4">{{ $bencana->user->nama }}</td>
                                <td class="py-2 px-4">{{ $bencana->nama_bencana }}</td>
                                <td class="py-2 px-4">{{ $bencana->desa_bencana }}</td>
                                <td class="py-2 px-4">{{ $bencana->tanggal_kejadian }}</td>
                                <td class="py-2 px-4 flex gap-2 items-center">
                                    <a href="{{ route('posko.show', $bencana->id_laporan_bencana) }}" class="p-2 bg-green-500 text-white rounded">Tambah</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Main modal -->
            <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Detail Laporan Bencana
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="authentication-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            @foreach ($laporan_bencana as $laporan)
                                <div class="mb-3">
                                    <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Nama
                                        Pelapor:</span>
                                    <p class="text-sm text-gray-700 dark:text-gray-400">{{ $laporan->user->nama }}</p>
                                </div>
                                <div class="mb-3">
                                    <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Tanggal
                                        Kejadian:</span>
                                    <p class="text-sm text-gray-700 dark:text-gray-400">{{ $laporan->tanggal_kejadian }}</p>
                                </div>
                                <div class="mb-3">
                                    <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Nama
                                        Bencana:</span>
                                    <p class="text-sm text-gray-700 dark:text-gray-400">{{ $laporan->nama_bencana }}</p>
                                </div>
                                <div class="mb-3">
                                    <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Deskripsi
                                        Bencana:</span>
                                    <p class="text-sm text-gray-700 dark:text-gray-400">{{ $laporan->deskripsi_bencana }}
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Tingkat
                                        Bencana:</span>
                                    <p class="text-sm text-gray-700 dark:text-gray-400">{{ $laporan->tingkat_bencana }}</p>
                                </div>
                                <div class="mb-3">
                                    <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Desa
                                        Kejadian:</span>
                                    <p class="text-sm text-gray-700 dark:text-gray-400">{{ $laporan->desa_bencana }}</p>
                                </div>
                                <div class="mb-3">
                                    <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Foto
                                        Bencana:</span>
                                    <p class="text-sm text-gray-700 dark:text-gray-400">Tidak ada foto tersedia</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
