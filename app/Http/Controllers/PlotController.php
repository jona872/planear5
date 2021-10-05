<?php

namespace App\Http\Controllers;

use App\Answer;
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
        //dd($projects);

        return  view('plots.index', compact('projects'));
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
    public function process(Request $request)
    {
        dd($request_params = $request->all());

        $request_params = $request->all();
        $rules = array(
            'project_id' => 'required',
            'plot_id' => 'required',
            'metodo_id' => 'required'
        );

        // $messages = array(
        //     'required' => 'El :attribute es requerido.'
        // );
        $messages = [
            'project_id.required' => 'El Proyecto es requerido',
        ];

        $validator = Validator::make($request_params, $rules, $messages);

        if ($validator->passes()) {

            //Columnas que necesito saber las respuestas
            $columnas = DB::table('projects')
                ->join('relevamientos', 'relevamientos.project_id', '=', 'projects.id')
                ->join('tools', 'tools.id', '=', 'relevamientos.tool_id')
                ->join('tools_data', 'tools_data.tool_id', '=', 'tools.id')
                ->join('data', 'data.id', '=', 'tools_data.data_id')
                ->select('projects.project_name', 'projects.id as pid', 'data.id as did', 'data.data_question')
                ->where('projects.id', $request->project_id)
                ->groupBy('data.data_question')
                ->get();
            //dd($columnas);
            $datasets = [];

            //dd($respuestas[0]->answer_name);
            //dd($respuestas);

            foreach ($columnas as $key => $element) {
                // $element->pid,$element->did;
                //dd([$key,$element]);
                $tmp = array();
                $datasets[$element->data_question] = array();
                //busco las respuestas de cada columna
                $respuestas = DB::table('answers')
                    ->join('data_answers', 'answers.id', '=', 'data_answers.answer_id')
                    ->join('data', 'data_answers.data_id', '=', 'data.id')
                    ->join('relevamientos', 'data_answers.relevamiento_id', '=', 'relevamientos.id')
                    ->join('projects', 'relevamientos.project_id', '=', 'projects.id')
                    ->where('data.id', $element->did)
                    ->select('answers.answer_name')
                    ->get();
                //dd($respuestas);

                foreach ($respuestas as $keyRespuesta => $valueRespuesta) {
                    array_push($tmp, $valueRespuesta->answer_name);
                }
                array_push($datasets[$element->data_question], $tmp);
            }

            $datasets = $this->farmatData($datasets, $request->plot_id, $request->metodo_id);
            //dd($datasets);

            return  view('plots.plot', compact('datasets'));
        }
        return redirect()->back()->with('errors', $validator->messages());
    }

    public function generateRGB()
    {
        return "rgba(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ",1)";
    }

    public function parsePlotType($value)
    {
        switch ($value) {
            case 1:
                return "line";
                break;
            case 2:
                return "bar";
                break;
            case 3:
                return "doughnut";
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
