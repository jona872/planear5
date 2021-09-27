<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlotController extends Controller
{
    public function index()
    {
        // $meses = array('0' => 'Enero', '1' => 'Febrero','2' => 'Marzo','3' => 'Abril','4' => 'Mayo');
        $meses = array('Enero','Febrero','Marzo','Abril','Mayo'); //eje X
        $values = [random_int(1, 20),random_int(1, 20),random_int(1, 20),random_int(1, 20),10]; //eje Y
        $data=[];

        foreach ($meses as $key => $month) {
            $data[$month] = $values[$key];
            
        }
        // dd($data);
        // dd($data[$meses]=$values);

        return  view('plots.indexphp',compact('data'));
    }
    public function plots2()
    {
        return  view('plots.plots2');
    }
}


