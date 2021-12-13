<?php

if (!function_exists('priceFormat')) {
    #Franck CFA
    // /*
    function priceFormat($number)
    {
        // $fmt = new NumberFormatter( 'fr_FR', NumberFormatter::CURRENCY );
        // return $fmt->formatCurrency($number, "XAF");
        $locale = config('app.devise.locale');
        $devise = config('app.devise.devise');
        $fmt = new NumberFormatter( $locale, NumberFormatter::CURRENCY );
        return $fmt->formatCurrency($number, $devise);
    }
}
