@extends('all.layout.index')

@section('title', 'Landing Page')
@section('landing')
<section class="px-[100px] py-[100px]">
    <h2 class="text-[40px] font-[600] text-blue1 text-center mb-10">Riwayat Bencana</h2>
    <table class="w-full text-sm mt-3 text-left border">
        <thead class="text-[16px]uppercase bg-[#567E93] text-white">
            <tr>
                <th class="p-4">No</th>
                <th class="p-4">Nama Bencana</th>
                <th class="p-4">Desa Bencana</th>
                <th class="p-4">Tingkat Bencana</th>
                <th class="p-4">Tanggal Bencana</th>

            </tr>
        </thead>
        <tbody class="text-[16px]">
            @foreach ($laporan_bencanas as $bencana)
                <tr class="border-b">
                    <td class="p-4">{{ $loop->iteration }}</td>
                    <td class="p-4">{{ $bencana->nama_bencana }}</td>
                    <td class="p-4">{{ $bencana->desa->nama_desa }}</td>
                    <td class="p-4">{{ $bencana->tingkat_bencana }}</td>
                    <td class="p-4">{{ $bencana->tanggal_kejadian }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
