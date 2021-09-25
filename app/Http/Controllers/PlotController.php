<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlotController extends Controller
{
    public function index()
    {
        return  view('plots.indexphp');
    }
}


