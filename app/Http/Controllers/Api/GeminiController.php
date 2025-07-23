<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeminiController extends Controller
{
    public function getArticles(Request $request)
    {
        try {
            $location = $request->input('location', 'Jember');
            $count = $request->input('count', 6);
            
            $prompt = "Buatkan {$count} artikel informatif tentang mitigasi bencana dan kebencanaan dalam format JSON dengan struktur:
            {
                \"articles\": [
                    {
                        \"title\": \"Judul artikel yang menarik dan informatif\",
                        \"summary\": \"Ringkasan artikel dalam 2-3 kalimat tentang topik mitigasi bencana\",
                        \"content\": \"Konten lengkap artikel tentang mitigasi bencana, persiapan menghadapi bencana, sistem peringatan dini, atau edukasi kebencanaan. Jelaskan dalam 2-3 paragraf yang informatif dan edukatif.\",
                        \"author\": \"Tim Smart Mitigation\",
                        \"publishedDate\": \"2024-01-15\",
                        \"category\": \"Mitigasi|Edukasi|Persiapan|Teknologi|Pencegahan|Penanggulangan\",
                        \"url\": \"https://smart-mitigation.com/artikel/mitigasi-bencana\"
                    }
                ]
            }
            
            Fokus pada artikel edukatif tentang mitigasi bencana, cara persiapan menghadapi bencana, teknologi peringatan dini, dan tips keselamatan. Kategori harus sesuai dengan: Mitigasi, Edukasi, Persiapan, Teknologi, Pencegahan, atau Penanggulangan.";

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-goog-api-key' => env('GEMINI_API_KEY')
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent', [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $prompt
                            ]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $content = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
                
                // Clean the response and extract JSON
                $jsonString = $this->extractJsonFromResponse($content);
                $articles = json_decode($jsonString, true);
                
                if (json_last_error() === JSON_ERROR_NONE && isset($articles['articles'])) {
                    return response()->json($articles);
                } else {
                     return response()->json($data);
                    // return $this->getFallbackArticles($count);
                }
            } else {
                return response()->json(['error' => 'Failed to fetch articles from Gemini API'], 500);
                // Log the error or handle it as needed
                // return $this->getFallbackArticles($count);
            }
            
        } catch (\Exception $e) {
            // return $this->getFallbackArticles($count);
            return response()->json(['error' => 'Failed to fetch articles from Gemini API (' . $e->getMessage() . ')'], 500);
        }
    }
    
    private function extractJsonFromResponse($content)
    {
        // Remove markdown code blocks if present
        $content = preg_replace('/```json\s*/', '', $content);
        $content = preg_replace('/```\s*$/', '', $content);
        
        // Find JSON object
        $start = strpos($content, '{');
        $end = strrpos($content, '}');
        
        if ($start !== false && $end !== false && $end > $start) {
            return substr($content, $start, $end - $start + 1);
        }
        
        return $content;
    }
}