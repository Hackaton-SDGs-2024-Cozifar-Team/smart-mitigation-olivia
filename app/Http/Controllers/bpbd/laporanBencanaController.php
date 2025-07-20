<?php

namespace App\Http\Controllers\bpbd;

use Illuminate\Http\Request;
use App\Models\LaporanBencana;
use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\Desa;
use App\Models\TutupanLahan;
use GuzzleHttp\Client;

class laporanBencanaController extends Controller
{
    public function index()
    {
        return view('bpbd.pages.laporan-bencana', [
            'judul' => 'Laporan Bencana',
            'laporan_bencana' => LaporanBencana::where('status', 'diajukan')->get()
        ]);
    }

    public function laporanDiterima($id)
    {
        $laporan = LaporanBencana::find($id);
        $laporan->status = 'terkonfirmasi';
        $laporan->save();

        $desa = Desa::find($laporan->id_desa);
        // create dataset
        $client = new Client();

        // Inside your if ($closestPrediction) block
        try {
            $response = $client->get('https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=' . $desa->code_adm);
            $data = json_decode($response->getBody(), true);

            if (isset($data['data']) && is_array($data['data']) && !empty($data['data'])) {
                $currentTime = time();
                $closestPrediction = null;
                $smallestTimeDifference = null;

                foreach ($data['data'] as $locationData) {
                    if (isset($locationData['cuaca']) && is_array($locationData['cuaca'])) {
                        foreach ($locationData['cuaca'] as $predictions) {
                            foreach ($predictions as $prediction) {
                                $predictionTime = strtotime($prediction['datetime']); // Get the datetime
                                $timeDifference = abs($currentTime - $predictionTime);

                                if (is_null($smallestTimeDifference) || $timeDifference < $smallestTimeDifference) {
                                    $closestPrediction = $prediction;
                                    $smallestTimeDifference = $timeDifference;
                                }
                            }
                        }
                    }
                }

                if ($closestPrediction) {
                    $tutupan_lahan = TutupanLahan::where('id_desa', $desa->id_desa)->first();
                    Dataset::create([
                        't' => $closestPrediction['t'],
                        'hu' => $closestPrediction['hu'],
                        'wd_deg' => $closestPrediction['wd_deg'],
                        'tp' => $closestPrediction['tp'],
                        'tl' => $tutupan_lahan->nilai_tutupan_lahan,
                        'flood' => 1,
                    ]);

                } else {
                    throw new \Exception("No valid closest prediction found.");
                }
            } else {
                throw new \Exception("Predictions data is not a valid non-empty array.");
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return redirect()->route('bpbd.laporan-bencana');
    }

    public function laporanDitolak($id)
    {
        $laporan = LaporanBencana::find($id);
        $laporan->status = 'tidak terkonfirmasi';
        $laporan->save();

        $desa = Desa::find($laporan->id_desa);
        // create dataset
        $client = new Client();
        try {
            $response = $client->get('http://127.0.0.1:5000/predict_weather/' . $desa->code_adm);
            $data = json_decode($response->getBody(), true);

            if (isset($data['predictions']) && is_array($data['predictions']) && !empty($data['predictions'])) {
                $lastElement = end($data['predictions']);
                $tutupan_lahan = TutupanLahan::where('id_desa', $desa->id_desa)->first();
                Dataset::create([
                    't' => $lastElement[0],
                    'hu' => $lastElement[1],
                    'wd_deg' => $lastElement[2],
                    'tp' => $lastElement[3],
                    'tl' => $tutupan_lahan->nilai_tutupan_lahan,
                    'flood' => 0,
                ]);
            } else {
                throw new \Exception("Predictions data is not a valid non-empty array.");
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return redirect()->route('bpbd.laporan-bencana');
    }
}
