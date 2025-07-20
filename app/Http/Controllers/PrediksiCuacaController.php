<?php

namespace App\Http\Controllers;

use App\Models\ClusteringBencana;
use App\Models\Desa;
use App\Models\PrediksiBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class PrediksiCuacaController extends Controller
{
    public function prediksiCuaca($adm_code)
    {
        $client = new Client();
        // return response()->json("haloo");
        try {
            $response = $client->get('http://127.0.0.1:5000/predict_weather/' . $adm_code);
            $data = json_decode($response->getBody(), true);

            if (isset($data['predictions']) && is_array($data['predictions']) && !empty($data['predictions'])) {
                $lastElement = end($data['predictions']);
            } else {
                throw new \Exception("Predictions data is not a valid non-empty array.");
            }

            return response()->json($lastElement);


        } catch (\Exception $e) {
           return response()->json([
                'error' => 'Exception caught',
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }

    /**
     * This function is used to predict flood for each village in the database.
     * It uses the weather prediction API to get the weather data for each village and then
     * uses the flood prediction API to predict the flood.
     * The result is stored in the prediksi_bencana table and is also returned as a JSON response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function prediksiBanjir()
    {
        $client = new Client();
        $responses = []; // To hold responses for each village

        try {
            // Get all villages
            $desas = Desa::all();
            $responses = []; // Initialize the responses array

            foreach ($desas as $search_desa) {
                $response = $client->get('http://127.0.0.1:5000/predict_weather/' . $search_desa->code_adm);
                $dataCuaca = json_decode($response->getBody(), true);

                if (!isset($dataCuaca['predictions']) || empty($dataCuaca['predictions'])) {
                    continue;
                }

                $existingPredictions = PrediksiBencana::where('id_desa', $search_desa->id_desa)->get();

                if ($existingPredictions->isNotEmpty()) {
                    foreach ($existingPredictions as $prediksi) {
                        $prediksi->delete();
                    }
                }

                foreach ($dataCuaca['predictions'] as $index => $data) {
                    $requestData = [
                        't' => round($data[0]),
                        'hu' => round($data[1]),
                        'wd_deg' => round($data[2]),
                        'tp' => round($data[3]),
                        'tl' => 20,
                    ];

                    // data terprediksi
                    // $requestData = [
                    //     't' => 21,
                    //     'hu' => 96,
                    //     'wd_deg' => 180,
                    //     'tp' => 400,
                    //     'tl' => 90,
                    // ];

                    $response = $client->post('http://127.0.0.1:5000/predict_flood', [
                        'json' => $requestData
                    ]);

                    $result = json_decode($response->getBody(), true);
                    $floodPrediction = $result['flood_prediction'];

                    PrediksiBencana::create([
                        'id_desa' => $search_desa->id_desa,
                        'nilai_prediksi' => $floodPrediction,
                        'status_prediksi' => $floodPrediction === 1 ? 'terprediksi' : 'tidak terprediksi',
                        'tanggal_prediksi' => date('Y-m-d H:i:s', strtotime('+' . $index . ' day')),
                    ]);

                    $responses[] = [
                        'id_desa' => $search_desa->id_desa,
                        'flood_prediction' => $floodPrediction,
                        'status_prediksi' => $floodPrediction === 1 ? 'terprediksi' : 'tidak terprediksi',
                        'tanggal_prediksi' => date('Y-m-d H:i:s', strtotime('+' . $index . ' day')),
                    ];
                }
            }

            return response()->json($responses);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function getprediksi()
    {
        $subquery = DB::table('prediksi_bencanas')
        ->select('id_desa', DB::raw('MAX(tanggal_prediksi) as tanggal_prediksi'))
        ->where('status_prediksi', 'terprediksi')
        ->groupBy('id_desa');

    $prediksi = DB::table('prediksi_bencanas as pb')
        ->joinSub($subquery, 'latest', function ($join) {
            $join->on('pb.id_desa', '=', 'latest.id_desa')
                 ->on('pb.tanggal_prediksi', '=', 'latest.tanggal_prediksi');
        })
        ->join('desas', 'pb.id_desa', '=', 'desas.id_desa')
        ->select('pb.id_desa', 'pb.tanggal_prediksi', 'desas.latitude','desas.longitude','desas.nama_desa','pb.tanggal_prediksi')
        ->get();

        return response()->json($prediksi);
    }

    public function getCluster()
    {
        $cluster = ClusteringBencana::with('desa')->get();
        return response()->json($cluster);
    }
}
