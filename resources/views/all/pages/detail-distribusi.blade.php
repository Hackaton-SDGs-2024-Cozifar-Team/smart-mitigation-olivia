@extends('all.layout.index')

@section('title', 'Landing Page')
@section('landing')
<div class="m-28">
    <table class="w-full text-sm mt-5 text-left border">
        <thead class="text-[16px]uppercase bg-[#567E93] text-white">
            <tr>
                <th class="p-4">No</th>
                <th class="p-4">Nama Kebutuhan</th>
                <th class="p-4">Jumlah</th>
                <th class="p-4">Tanggal</th>
                <th class="p-4">Foto</th>
            </tr>
        </thead>
        <tbody class="text-[16px]">
            @foreach ($distribusi as $key => $k)
                <tr class="border-b">
                    <td class="p-4">{{ $loop->iteration }}</td>
                    <td class="p-4">{{ $k->nama_kebutuhan }}</td>
                    <td class="p-4">{{ $k->jumlah }}</td>
                    <td class="p-4">{{ $k->tanggal }}</td>
                    <td class="p-4"><img src="{{ asset('uploads/distribusi/' . $k->foto_keterangan) }}" alt="Struk"
                            style="width: 140px; height: auto;"></td>
                    
                </tr>
            @endforeach
    
        </tbody>
    </table>
</div>
@endsection