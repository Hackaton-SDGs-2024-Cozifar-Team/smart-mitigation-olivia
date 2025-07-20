<title>{{ $judul }}</title>
@extends('bpbd.layout.bpbd')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="container mx-auto px-4 py-6">
            <div class="overflow-x-auto">
                <div class="mb-4">
                    <a href="{{ route('bpbd.informasi-bencana.create') }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded-xl">+
                        Tambah Informasi</a>
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

                <table id="myTable" class="display w-full">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bencana</th>
                            <th>Korban Terluka</th>
                            <th>Korban Meninggal</th>
                            <th>Korban Hilang</th>
                            <th>Korban Mengungsi</th>
                            <th>Dampak Kerusakan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($informasi_bencana as $informasi)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">
                                <td class="py-2 px-4">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4">{{ $informasi->laporanBencana->nama_bencana }}</td>
                                <td class="py-2 px-4">{{ $informasi->korban_terluka }}</td>
                                <td class="py-2 px-4">{{ $informasi->korban_meninggal }}</td>
                                <td class="py-2 px-4">{{ $informasi->korban_hilang }}</td>
                                <td class="py-2 px-4">{{ $informasi->korban_mengungsi }}</td>
                                <td class="py-2 px-4">{{ $informasi->dampak_kerusakan }}</td>
                                <td class="py-2 px-4">{{ $informasi->tanggal }}</td>
                                <td class="py-2 px-4 flex gap-2 items-center">
                                    <a href="{{ route('bpbd.informasi-bencana.edit', $informasi->id_informasi_bencana) }}">
                                        <button type="submit"
                                            class="text-yellow-500 border-2 border-yellow-500 px-4 py-2 rounded-lg bg-transparent hover:bg-yellow-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-300 transition duration-200 ease-in-out">
                                            <i class="ri-pencil-line"></i>
                                        </button>
                                    </a>
                                    <form
                                        action="{{ route('bpbd.informasi-bencana.delete', $informasi->id_informasi_bencana) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-700 hover:text-white border border-red-700 px-4 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg p-2">
                                            <i class="ri-delete-bin-5-line"></i>
                                        </button>
                                    </form>
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
                            <div class="mb-3">
                                <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Nama
                                    Pelapor:</span>
                                <p class="text-sm text-gray-700 dark:text-gray-400"></p>
                            </div>
                            <div class="mb-3">
                                <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Tanggal
                                    Kejadian:</span>
                                <p class="text-sm text-gray-700 dark:text-gray-400"></p>
                            </div>
                            <div class="mb-3">
                                <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Nama
                                    Bencana:</span>
                                <p class="text-sm text-gray-700 dark:text-gray-400"></p>
                            </div>
                            <div class="mb-3">
                                <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Deskripsi
                                    Bencana:</span>
                                <p class="text-sm text-gray-700 dark:text-gray-400"></p>
                            </div>
                            <div class="mb-3">
                                <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Tingkat
                                    Bencana:</span>
                                <p class="text-sm text-gray-700 dark:text-gray-400"></p>
                                </p>
                            </div>
                            <div class="mb-3">
                                <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Desa
                                    Kejadian:</span>
                                <p class="text-sm text-gray-700 dark:text-gray-400"></p>
                            </div>
                            <div class="mb-3">
                                <span class="block text-md font-medium text-gray-900 dark:text-gray-200">Foto
                                    Bencana:</span>
                                <p class="text-sm text-gray-700 dark:text-gray-400">Tidak ada foto tersedia</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
