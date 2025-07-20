<?php

namespace App\Http\Controllers;

use App\Models\ClusteringBencana;
use App\Models\Desa;
use App\Models\TutupanLahan;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ClusteringController extends Controller
{
    public function index() {
        $client = new Client();
        $desas = Desa::all();
        $allData = []; // Array untuk menyimpan data tiap desa

        try {
            foreach ($desas as $desa) {
                // Buat permintaan ke API untuk setiap kode ADM desa
                $response = $client->get('https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=' . $desa->code_adm);
                $data = json_decode($response->getBody(), true);
                $weatherData = $data['data'][0]['cuaca'][0][0] ?? null;
                // return response()->json($weatherData);

                $search_desa = Desa::where('code_adm', $desa->code_adm)->first();

                $tutupan_lahan = TutupanLahan::where('id_desa', $search_desa->id_desa)->first();

                $formattedData = [
                    'desa' => $desa->id_desa, // Nama desa atau ID desa
                    't' => $weatherData['t'] ?? 'Tidak ada data lokasi',
                    'hu' => $weatherData['hu'] ?? 'Tidak ada data kelembaban',
                    'wd_deg' => $weatherData['wd_deg'] ?? 'Tidak ada data arah angin',
                    'tp' => $weatherData['tp'] ?? 'Tidak ada data suhu',
                    'tl' => $tutupan_lahan->nilai_tutupan_lahan ?? 30, // Gunakan 30 jika data tidak ada
                ];
                $allData[] = $formattedData;
            }
            $response = $client->post('http://127.0.0.1:5001/cluster', [
                'json' => $allData
            ]);

            $responseBody = json_decode($response->getBody(), true);
            foreach($responseBody['clusters'] as $data){

                if($data['cluster_label'] == 'tinggi'){
                    $nilai_cluster = 3;
                }elseif($data['cluster_label'] == 'sedang'){
                    $nilai_cluster = 2;
                }elseif($data['cluster_label'] == 'rendah'){
                    $nilai_cluster = 1;
                }
                ClusteringBencana::create([
                    'id_desa' => $data['desa'],
                    't' => $data['t'],
                    'hu' => $data['hu'],
                    'wd_deg' => $data['wd_deg'],
                    'tl' => $data['tl'],
                    'tp' => $data['tp'],
                    'cluster' => $data['cluster_label'],
                    'nilai_cluster' => $nilai_cluster,
                    'tanggal_prediksi' => date('Y-m-d H:i:s'),
                ]);
            }
            return response()->json($responseBody);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
