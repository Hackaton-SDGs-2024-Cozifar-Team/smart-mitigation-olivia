<title>{{ $judul }}</title>
@extends('admin.layout.admin')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6 b-6">
        <div class="mb-5">
            <a href="{{ route('admin.artikel-bencana.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">+
                Artikel Bencana</a>
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

        <div id="konten-diterima" class="overflow-x-auto mt-8">
            <table id="myTable" class="display w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Artikel</th>
                        <th>Deskirpsi Artikel</th>
                        <th>Konten</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artikel_bencana as $artikel)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $artikel->judul_artikel }}</td>
                            <td>{{ $artikel->isi_artikel }}</td>
                            <td><img src="{{ asset('uploads/foto-artikel/' . $artikel->foto_artikel) }}" alt="Struk"
                                    style="width: 80px; height: auto;"></td>
                            <td>{{ $artikel->tanggal }}</td>
                            <td class="flex items-center">
                                <a href="{{ route('admin.artikel-bencana.edit', $artikel->id_artikel_bencana) }}"
                                    class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-yellow-400 dark:text-yellow-400 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-400">
                                    <i class="ri-pencil-line"></i>
                                </a>
                                <form action="{{ route('admin.artikel-bencana.delete', $artikel->id_artikel_bencana) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
