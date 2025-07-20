@extends('all.layout.index')

@section('title', 'Landing Page')
@section('landing')
    <section class="px-[100px] py-[100px]">
        <h2 class="text-[40px] font-[600] text-blue1 text-center mb-10">Donasi Terbaru</h2>
        <table class="w-full text-sm mt-3 text-left border">
            <thead class="text-[16px]uppercase bg-[#567E93] text-white">
                <tr>
                    <th class="p-4">No</th>
                    <th class="p-4">Nama Bencana</th>
                    <th class="p-4">Nominal Donasi</th>

                </tr>
            </thead>
            <tbody class="text-[16px]">
                @foreach ($laporan_donasis as $donasi)
                    <tr class="border-b">
                        <td class="p-4">{{ $loop->iteration }}</td>
                        <td class="p-4">{{ $donasi->laporan->nama_bencana }}</td>
                        <td class="p-4">{{ $donasi->nominal_donasi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
