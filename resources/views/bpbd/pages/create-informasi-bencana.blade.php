@extends('bpbd.layout.bpbd')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="container mx-auto px-4 py-6">
            <form action="{{ route('bpbd.informasi-bencana.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="mb-5">
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Bencana</label>
                        <select id="countries" name="id_laporan_bencana"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option><--- Pilih Bencana Alam ---></option>
                            @foreach ($laporan_bencana as $data)
                                <option value="{{ $data->id_laporan_bencana }}">{{ $data->nama_bencana }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="korban_terluka"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Korban Terluka</label>
                        <input type="number" id="korban_terluka" name="korban_terluka"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="korban_meninggal"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Korban Meninggal</label>
                        <input type="number" id="korban_meninggal" name="korban_meninggal"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="korban_hilang"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Korban Hilang</label>
                        <input type="number" id="korban_hilang" name="korban_hilang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="korban_menungsi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Korban Mengungsi</label>
                        <input type="number" id="korban_menungsi" name="korban_mengungsi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="dampak_kerusakan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dampak Kerusakan</label>
                        <select id="countries" name="dampak_kerusakan"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option><--- Dampak Kerusakan ---></option>
                            <option>Rendah</option>
                            <option>Sedang</option>
                            <option>Tinggi</option>
                        </select>
                    </div>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                <a href="{{ route('bpbd.informasi-bencana') }}"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Kembali</a>
            </form>
        </div>
    </div>
@endsection
