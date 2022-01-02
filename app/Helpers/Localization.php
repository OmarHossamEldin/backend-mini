<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * will get the current language of the session
     * @return string $locale
     */
    public static function getlocale(): string
    {
        $locale = App::getLocale();
        return $locale;
    }

    /**
     * will set the current language of the session
     * @param string $language
     * @return bool
     */
    public static function setlocale(string $language): bool
    {
        $language = match ($language) {
            'en' => 'en',
            'ar' => 'ar',
            default => 'en'
        };
        return App::setLocale($language) ? true : false;
    }
}