<title>{{ $judul }}</title>
@extends('admin.layout.admin')

@section('content')
    <h2 class="text-2xl font-semibold">Dashboard</h2>
    <p class="text-gray-600 text-sm mb-5">Hallo selamat datang Admin👋</p>
    <div class="grid grid-cols-3 gap-5">
        <div class="bg-blue1 p-4 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <i class="ri-user-line text-5xl text-blue4"></i>
                <h1 class="text-5xl font-bold text-blue4">{{ $informasi_bencana->sum('korban_terluka') }}</h1>
            </div>
            <p class="font-bold text-blue4">Korban Terluka</p>
        </div>
        <div class="bg-blue1 p-4 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <i class="ri-skull-2-line text-5xl text-blue4"></i>
                <h1 class="text-5xl font-bold text-blue4">{{ $informasi_bencana->sum('korban_meninggal') }}</h1>
            </div>
            <p class="font-bold text-blue4">Korban Meninggal</p>
        </div>
        <div class="bg-blue1 p-4 rounded-lg shadow-md border-dashed">
            <div class="flex items-center justify-between">
                <i class="ri-user-unfollow-line text-5xl text-blue4"></i>
                <h1 class="text-5xl font-bold text-blue4">{{ $informasi_bencana->sum('korban_hilang') }}</h1>
            </div>
            <p class="font-bold text-blue4">Korban Hilang</p>
        </div>
        <div class="bg-blue1 p-4 rounded-lg shadow-md flex-1">
            <div class="flex items-center justify-between">
                <i class="ri-tent-line text-6xl text-blue4"></i>
                <h1 class="text-5xl font-bold text-blue4">{{ $informasi_bencana->sum('korban_mengungsi') }}</h1>
            </div>
            <p class="font-bold text-blue4">Korban Mengungsi</p>
        </div>
        <div class="bg-blue1 p-4 rounded-lg shadow-md flex-1">
            <div class="flex items-center justify-between">
                <i class="ri-home-gear-fill text-5xl text-blue4"></i>
                <h1 class="text-3xl font-bold text-blue4">Tinggi</h1>
            </div>
            <p class="font-bold text-blue4">Dampak Kerusakan</p>
        </div>
        <div class="bg-blue1 p-4 rounded-lg shadow-md flex-1">
            <div class="flex items-center justify-between">
                <i class="ri-money-dollar-circle-line text-5xl text-blue4"></i>
                <h1 class="text-4xl font-bold text-blue4">Rp.
                    {{ number_format($donasi_uang->sum('nominal_donasi'), 0, ',', '.') }}</h1>
            </div>
            <p class="font-bold text-blue4">Total Donasi</p>
        </div>
    </div>

    <div class="w-full h-auto border-2 border-blue-300 border-dashed rounded-lg mt-10">
        <div class="p-4 rounded-lg shadow-md transition">
            <h1 class="text-xl font-bold text-blue4 mb-2">Grafik Korban Bencana</h1>
            <canvas id="lineChart" width="400" height="150"></canvas>
        </div>
    </div>

    <div class="mt-10 flex space-x-4 shadow-md">
        <div class="w-8/1text-blue4 border-dashed border-2 border-blue-300 p-5 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-blue1 mb-4">Penggunaan Donasi</h2>
            <table id="myTable" class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-blue-100 text-blue1">
                        <th class="py-3 px-4 font-semibold border-b border-blue-300">No</th>
                        <th class="py-3 px-4 font-semibold border-b border-blue-300">Nama Bencana</th>
                        <th class="py-3 px-4 font-semibold border-b border-blue-300">Nama Kebutuhan</th>
                        <th class="py-3 px-4 font-semibold border-b border-blue-300">Nominal Uang</th>
                        <th class="py-3 px-4 font-semibold border-b border-blue-300">Tanggal Pembelian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penggunaan_donasi as $penggunaan)
                        <tr class="hover:bg-blue-50">
                            <td class="py-3 px-4 border-b border-blue-100">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 border-b border-blue-100">{{ $penggunaan->laporan->nama_bencana }}</td>
                            <td class="py-3 px-4 border-b border-blue-100"><a
                                    href="{{ route('admin.penggunaan-donasi') }}">{{ $penggunaan->nama_kebutuhan }}</td>
                            <td class="py-3 px-4 border-b border-blue-100">
                                {{ number_format($penggunaan->nominal_uang, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 border-b border-blue-100">{{ $penggunaan->tanggal_pembelian }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="w-4/12 h-fit border-2 border-blue-300 border-dashed rounded-lg">
            <div class="p-4 rounded-lg shadow-md transition">
                <h1 class="text-xl font-bold text-blue1 mb-2">Donatur</h1>
                @foreach ($donasi_uang as $donasi)
                    <ul class="mb-4">
                        <li class="flex items-center">
                            <img src="{{ asset('/img/donasi/bantumakan 1.png') }}" alt="Penyumbang 1"
                                class="w-12 h-12 rounded-full mr-3">
                            <div class="flex flex-col w-full">
                                <div class="flex items-center">
                                    <a href="{{ route('admin.donasi-uang') }}"><span
                                            class="font-bold">{{ $donasi->user->nama }}</span></a>
                                    <span class="text-gray-600 text-sm ml-auto font-bold">Rp.
                                        {{ number_format($donasi->nominal_donasi, 0, ',', '.') }}</span>
                                </div>
                                <span class="text-gray-600 text-sm">{{ $donasi->user->no_hp }}</span>
                            </div>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('lineChart').getContext('2d');

            // Dummy data for testing purposes
            const labels = ['2024-01-01', '2024-01-05', '2024-01-10', '2024-01-15', '2024-01-20'];
            const dataKorbanTerluka = [10, 15, 8, 20, 25];
            const dataKorbanMeninggal = [2, 3, 1, 4, 5];
            const dataKorbanHilang = [1, 2, 0, 1, 3];

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Korban Terluka',
                            data: dataKorbanTerluka,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            fill: true,
                        },
                        {
                            label: 'Korban Meninggal',
                            data: dataKorbanMeninggal,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            fill: true,
                        },
                        {
                            label: 'Korban Hilang',
                            data: dataKorbanHilang,
                            borderColor: 'rgba(255, 206, 86, 1)',
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            fill: true,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal Kejadian'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Jumlah'
                            },
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        },
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false
                    }
                }
            });
        });
    </script>
@endsection
