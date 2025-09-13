<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestauranteController extends Controller
{
    public function index()
    {
        // Assuming you have a list of restaurants
        return view('restaurantes');
    }

    public function showCipriani()
    {
        return view('cipriani');
    }
}
