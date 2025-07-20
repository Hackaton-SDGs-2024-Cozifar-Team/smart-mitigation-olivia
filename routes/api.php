<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\bpbd\PoskoController;
use App\Http\Controllers\PrediksiCuacaController;
use App\Http\Controllers\ClusteringController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('bencana',[DonationController::class, 'apiBencana']);
Route::get('posko/id_laporan_bencana/{id_laporan_bencana}',[PoskoController::class, 'apiPoskoByLaporanBencana']);
Route::post('callback', [DonationController::class, 'callback']);

Route::get('/prediksi-banjir', [PrediksiCuacaController::class, 'prediksiBanjir']);
Route::get('/prediksi/{adm_code}', [PrediksiCuacaController::class, 'prediksiCuaca']);

Route::get('/cluster', [ClusteringController::class, 'index']);

Route::post('/chatbot', [ChatbotController::class, 'getResponse']);
Route::get('get-prediksi', [PrediksiCuacaController::class, 'getprediksi']);
Route::get('get-cluster', [PrediksiCuacaController::class, 'getCluster']);
route::get('/posko/{id}',[PoskoController::class, 'apiPosko']);

