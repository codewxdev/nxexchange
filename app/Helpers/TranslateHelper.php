<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('t')) {
    function t($text)
    {
        $lang = session('locale', 'en');

        if ($lang === 'en') {
            return $text; // English ke liye translate na karo
        }

        // External API request
        $response = Http::post('https://libretranslate.de/translate', [
            'q' => $text,
            'source' => 'en',
            'target' => $lang,
            'format' => 'text'
        ]);

        if ($response->successful()) {
            return $response->json()['translatedText'];
        }

        return $text; // fallback
    }
}
