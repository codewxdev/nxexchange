<?php

use Stichoza\GoogleTranslate\GoogleTranslate;

if (!function_exists('t')) {
    function t($text)
    {
        $lang = session('locale', 'en');

        // English? no need to translate
        if ($lang === 'en') {
            return $text;
        }

        try {
            $tr = new GoogleTranslate();
            $tr->setSource('en'); // Your default language
            $tr->setTarget($lang);
            return $tr->translate($text);
        } catch (\Exception $e) {
            logger("Translate error: " . $e->getMessage());
            return $text; // fallback
        }
    }
}
