<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\KebutuhanKorban;
use App\Models\LaporanBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function index($id)
    {
        $kebutuhanKorban = KebutuhanKorban::where('id_laporan_bencana', $id)->get();
        return view('all.pages.donation.tambah', [
            "id" => $id,
            "kebutuhanKorban" => $kebutuhanKorban
        ]);
    }

    public function apiBencana()
    {
        $bencana = LaporanBencana::all();
        return response()->json($bencana);
    }

    public function getToken(Request $request)
    {
        $rand_id = "TRN".time().rand(1,9);

        Donasi::create([
            'order_id' => $rand_id,
            'id_laporan_bencana' => $request->id_laporan_bencana,
            'nominal_donasi' => $request->amount,
            'deskripsi' => $request->deskripsi,
            'id_users' => Auth::user()->id_users,
            'status' => 'ditolak',
            'jenis_donasi' => 'uang',
            'tanggal_donasi' => now()
        ]);
    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = false;
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;

    $params = array(
        'transaction_details' => array(
            'order_id' => $rand_id,
            'gross_amount' => $request->amount,
        ),
        'customer_details' => array(
            'first_name' => 'test',
            'last_name' => '.',
            'email' => 'test@gmail.com'
            // 'phone' => '08111222333',
        ),
    );
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    return response()->json($snapToken);
    }

    public function callback(Request $request)
    {
        $id = $request->order_id;
        $donasi = Donasi::where('order_id', $id)->first();
        $donasi->status = 'diterima';
        $donasi->save();
        return response()->json($donasi);
    }

    public function storeBarang(Request $request)
    {
        // dd($request->all());
        $rand_id = "BRG".time().rand(100,200);
        
        foreach($request->id_kebutuhan_korban as $key => $item){
            Donasi::create([
                'order_id' =>$rand_id,
                'id_laporan_bencana' => $request->id_laporan_bencana,
                'id_kebutuhan_korban' => $item,
                'jumlah_barang' => $request->jumlah[$key],
                'deskripsi' => $request->deskripsi,
                'id_users' => Auth::user()->id_users,
                'status' => 'ditolak',
                'jenis_donasi' => 'barang',
                'tanggal_donasi' => now()
            ]);

            $kebutuhanKorban = KebutuhanKorban::where('id_kebutuhan_korban', $item)->first();
            $jumlahUpdate = $kebutuhanKorban->jumlah_kebutuhan - $request->jumlah[$key];
            $kebutuhanKorban->update([
                'jumlah_kebutuhan' => $jumlahUpdate
            ]);
        }

        return redirect('/')->with('success', 'Donasi barang berhasil disimpan.');
    }
}