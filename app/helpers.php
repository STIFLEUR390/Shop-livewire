<?php

if (!function_exists('priceFormat')) {
    #Franck CFA
    // /*
    function priceFormat($number)
    {
        $fmt = new NumberFormatter( 'fr_FR', NumberFormatter::CURRENCY );
        return $fmt->formatCurrency($number, "XAF");
    }
    // */

    # dollar americain
    /*
    function priceFormat($number)
    {
        $fmt = new NumberFormatter( 'en_US', NumberFormatter::CURRENCY );
        return $fmt->formatCurrency($number, "USD");
    }
    */

    # ero
    /*
    function priceFormat($number)
    {
        $fmt = new NumberFormatter( 'fr_FR', NumberFormatter::CURRENCY );
        return $fmt->formatCurrency($number, "EUR");
    }
    */
}
