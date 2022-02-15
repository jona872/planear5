<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use SplTempFileObject;

class CsvController extends Controller
{
    public function index()
    {
        $values = Project::all();

        $columnas = DB::select("SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_NAME = 'projects'
        ORDER BY ORDINAL_POSITION ");

        $col = array();
        foreach ($columnas as $key => $value) {
            array_push($col, $value->COLUMN_NAME);
        }
        
        //we create the CSV into memory
        $csv = Writer::createFromFileObject(new SplTempFileObject());

        //we insert the CSV header
        $csv->insertOne($col);
        
        // Insert the body
        //$csv->insertAll($test);
        foreach ($values as $data ) {
            $csv->insertOne($data->attributesToArray());
        }

        $csv->output('datas.csv');
        return view('csvs.index');
    }
}
