<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }
    public function getResponse(Request $request)
    {
        // Validasi input
        $request->validate([
            'message' => 'required|string',
        ]);

        // Membuat instance dari Guzzle HTTP Client
        $client = new Client();

        try {
            // Mengirim permintaan POST ke API Python
            $response = $client->post('http://127.0.0.1:5002/chatbot', [
                'json' => ['message' => $request->input('message')]
            ]);

            // Mengambil respons dari API
            $data = json_decode($response->getBody(), true);

            // Mengembalikan respons ke frontend
            return response()->json($data);
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi
            return response()->json(['error' => 'Terjadi kesalahan saat menghubungi API'], 500);
        }
    }
}
