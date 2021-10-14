<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Tool;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;
use MathPHP\Statistics\Average;

class PlotController extends Controller
{
    public function index()
    {
        $projects = DB::table('projects')
            ->select('projects.id', 'projects.project_name')
            ->get();
        //dd($tools);

        return  view('plots.index', compact('projects'));
    }
    public function create()
    {
        $projects = DB::table('projects')
            ->select('projects.id', 'projects.project_name')
            ->get();
        return view("plots.indexmulti", compact('projects'));
    }
    public function plots2()
    {
        //Grafico 1
        $meses = array('0' => 'Enero', '1' => 'Febrero', '2' => 'Marzo', '3' => 'Abril', '4' => 'Mayo');  //idem que siguiente
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'); //eje X
        // dd($meses);
        $values = [random_int(1, 20), random_int(1, 20), random_int(1, 20), random_int(1, 20), 10]; //eje Y

        $data = [];
        foreach ($meses as $key => $month) {
            $data[$month] = $values[$key];
        }
        // dd($data);
        // dd($data[$meses]=$values);

        // FIN grafico 1 ================================================================

        // //Grafico 2
        // // $ejeX = array('0' => 'Enero', '1' => 'Febrero', '2' => 'Marzo', '3' => 'Abril', '4' => 'Mayo');
        // //$ejeX = array('Hombres', 'Mujeres'); //eje X (preguntas que tiene la herramienta)
        // $questions = ['Hombre', 'Mujer'];
        // $ejeX = array();
        // foreach ($questions as $key => $value) {
        //     array_push($ejeX, $value);
        // }
        // //Genreo mis 2 vectores de respuestas (pueden ser varios)
        // $answersP1 = [random_int(1, 20), random_int(1, 20), random_int(1, 20), random_int(1, 20), 10]; //genero aleatorio las respuestas SIN PROCESAR
        // $answersP2 = [random_int(1, 20), random_int(1, 20), random_int(1, 20), random_int(1, 20), 5];

        // $meanP1   = Average::mean($answersP1);
        // $meanP2   = Average::mean($answersP2);
        // // $median = Average::median($numbers);
        // // $values = [random_int(1, 20), random_int(1, 20), random_int(1, 20), random_int(1, 20), 10]; //eje Y
        // $answersProcesed = [$meanP1, $meanP2];
        // $values = [];
        // foreach ($answersProcesed as $key => $value) {
        //     array_push($values, $value);
        // }
        // //dd($values);

        // $data = [];
        // foreach ($ejeX as $key => $month) {
        //     $data[$month] = $values[$key];
        // }

        // FIN grafico 2 ================================================================
        //dd($data);
        // dd($data[$meses]=$values);

        return  view('plots.indexphp', compact('data'));

        // return  view('plots.plots2');
    }

    public function multiplotProcess(Request $request)
    {
        //dd( Tool::find($request->tList2)->attributesToArray()['tool_name']  );
        //dd($request->tList2);


        //dd($request_params = $request->all());

        // return view('plots.multiplot');
        $request_params = $request->all();
        //dd($request_params = $request->all());
        $rules = array(
            'pList' => 'required',
            'tList' => 'required',
            'plot_id' => 'required'
        );

        $messages = [
            'pList.required' => 'El Proyecto es requerido',
            'tList.required' => 'La Herramienta es requerida',
        ];

        $validator = Validator::make($request_params, $rules, $messages);

        if ($validator->passes()) {

            $pid = intval($request->pList);
            $tid = intval($request->tList);
            $pid2 = intval($request->pList2);
            $tid2 = intval($request->tList2);

            $extraConfig1 = (object)[]; // Cast empty array to object
            $extraConfig2 = (object)[]; // Cast empty array to object
            $type =  $this->parsePlotType($request->plot_id);
            $extraConfig1->type = $type;
            $extraConfig1->title = Tool::find($request->tList)->attributesToArray()['tool_name'];
            $extraConfig2->type = $type;
            $extraConfig2->title = Tool::find($request->tList2)->attributesToArray()['tool_name'];
            $extraConfig = [$extraConfig1,$extraConfig2];
            switch ($request->plot_id) {
                case '5':
                    $data = $this->multiPlot($pid, $pid2, $tid, $tid2, $extraConfig);
                    return  view('plots.multiplot', compact('data'));
                    break;
                case '6':
                    $data = $this->multiPlot($pid, $pid2, $tid, $tid2, $extraConfig);
                    return  view('plots.multiplot', compact('data'));
                    break;
                default:
                    return "default";
                    break;
            }
        }
        return redirect()->back()->with('errors', $validator->messages());
    }
    public function process(Request $request)
    {
        $request_params = $request->all();
        //dd($request_params = $request->all());
        $rules = array(
            'pList' => 'required',
            'tList' => 'required',
            'plot_id' => 'required'
        );

        $messages = [
            'pList.required' => 'El Proyecto es requerido',
            'tList.required' => 'La Herramienta es requerida',
        ];

        $validator = Validator::make($request_params, $rules, $messages);

        if ($validator->passes()) {

            $pid = intval($request->pList);
            $tid = intval($request->tList);

            $extraConfig = (object)[]; // Cast empty array to object
            $type =  $this->parsePlotType($request->plot_id);
            $extraConfig->type = $type;
            $extraConfig->title = $request->tName;
            switch ($request->plot_id) {
                case '1':
                    $data = $this->simplePlot($pid, $tid, $extraConfig);
                    return  view('plots.simplePlot', compact('data'));
                    break;
                case '2':
                    $data = $this->simplePlot($pid, $tid, $extraConfig);
                    return  view('plots.simplePlot', compact('data'));
                    break;
                case '3':
                    $data = $this->simplePlot($pid, $tid, $extraConfig);
                    return  view('plots.simplePlot', compact('data'));
                    break;
                case '4':
                    $data = $this->simplePlot($pid, $tid, $extraConfig);
                    return  view('plots.simplePlot', compact('data'));
                    break;
                case '5':
                    $data = $this->simplePlot($pid, $tid, $extraConfig);
                    return  view('plots.simplePlot', compact('data'));
                    break;
                case '6':
                    $data = $this->simplePlot($pid, $tid, $extraConfig);
                    return  view('plots.simplePlot', compact('data'));
                    break;
                default:
                    return "default";
                    break;
            }
        }
        return redirect()->back()->with('errors', $validator->messages());
    }



    public function simplePlot($pid, $tid, $extraConfig)
    {
        $columnas = DB::select("SELECT DISTINCT(data.data_question),SUM(answers.answer_name) total from data_answers
                INNER JOIN answers ON answers.id = data_answers.answer_id
                INNER JOIN data ON data.id = data_answers.data_id
                WHERE data_answers.relevamiento_id IN (
                    SELECT relevamientos.id from relevamientos 
                    INNER JOIN tools ON relevamientos.tool_id = tools.id
                    INNER JOIN projects on relevamientos.project_id = projects.id
                    WHERE projects.id = '$pid' AND tools.id = '$tid' )
                GROUP BY data.data_question");


        $preguntas = array(); //eje X
        $respuestas = array(); //eje Y
        foreach ($columnas as $key => $value) {
            array_push($preguntas, $value->data_question);
            array_push($respuestas, $value->total);
        }

        $labels = $preguntas;
        //$label = "My First Dataset desde controller";
        $label = $extraConfig->title;
        $bgc = array();

        foreach ($respuestas as $r) {
            array_push($bgc, $this->generateRGB());
        }

        $obj3 = (object)[]; // Cast empty array to object
        $obj3->label = $label;
        $obj3->data = $respuestas;
        $obj3->backgroundColor = $bgc;
        $obj3->hoverOffset = 4;

        $data['datasets'] = [$obj3];
        $data['labels'] = $labels;
        $data['type'] = $extraConfig->type;
        $data['title'] = $extraConfig->title;
        return $data;
    }

    public function multiPlot($pid, $pid2, $tid, $tid2, $extraConfig)
    {
        //dd($extraConfig);
        $data1 = $this->simplePlot($pid, $tid, $extraConfig['0']);
        $data2 = $this->simplePlot($pid2, $tid2, $extraConfig['1']);
        $bgc1 = $this->generateRGB();
        $bgc2 = $this->generateRGB();

        for ($i=0; $i < $data1['datasets'][0]->backgroundColor; $i++) { 
            $data1['datasets'][0]->backgroundColor[$i] = "1";
        }

        foreach ($data2['datasets'][0]->backgroundColor as $key => $value ) {
            $value = $bgc2;
        }

        //dd($data1['datasets'][0]->backgroundColor);

        dd($data1);

        $wrapper = [$data1,$data2];
        $wrapper['type'] = $extraConfig[0]->type;
        $wrapper['labels'] =  ( count($data1['labels']) > count($data2['labels']) ) ? $data1['labels'] : $data2['labels'];
    
        return $wrapper;
    }


    public function generateRGB()
    {

        //return "rgba(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ",1)";
        return "rgba(" . mt_rand(0, 255) . "," . mt_rand(0, 255) . "," . mt_rand(0, 255) . ",0.9)";

        // $numbers = range(0, 255);
        // shuffle($numbers);
        // $resu = array_slice($numbers, 0, 3);

        // return "rgba(" . $resu['0'] . "," . $resu['1'] . "," . $resu['2'] . ",0.9)";

    }


    public function parsePlotType($value)
    {
        switch ($value) {
            case 1:
            case 5:
                return "line";
                break;
            case 2:
            case 6:
                return "bar";
                break;
            case 3:
                return "doughnut";
                break;
            case 4:
                return "pie";
                break;

            default:
                return "pie";
                break;
        }
    }

    public function farmatData($datasets, $pid, $mid)
    {
        $type = $this->parsePlotType($pid);
        // $method = $this->parseMethod($mid);
        $formattedData = (object)[];
        $formattedData->datasets = array();
        //$formattedData->labels = array();
        // $formattedData->labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'];
        $formattedData->labels = [];
        $maximo = 0;

        foreach ($datasets as $key => $value) {
            $objeto1 = (object)[];
            $objeto1->type = $type;
            $objeto1->label = $key; //leyenda (clickeable)
            $objeto1->backgroundColor = $this->generateRGB();
            $objeto1->data = $value[0];
            $maximo = (count($value[0]) > $maximo) ? count($value[0]) : $maximo;
            array_push($formattedData->datasets, $objeto1);
        }

        for ($i = 1; $i <= $maximo; $i++) {
            array_push($formattedData->labels, $i);
        }

        return $formattedData;
    }
}
