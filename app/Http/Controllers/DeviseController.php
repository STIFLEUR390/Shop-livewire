<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Config, Redirect, Session};

class DeviseController extends Controller
{
    public function swithDevise($devise)
    {
        if (array_key_exists($devise, Config::get('devises'))) {
            $store = Config::get('devises')[$devise];
            Session::put('appdevise', $store);
        }
        return Redirect::back();
    }
}
