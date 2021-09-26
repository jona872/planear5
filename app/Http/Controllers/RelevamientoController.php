<?php

namespace App\Http\Controllers;

use App\Answer;
use App\DataAnswer;
use App\Project;
use App\ProjectRelevamiento;
use App\Relevamiento;
use App\Tool;
use App\ToolData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RelevamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relevamientos = DB::table('relevamientos')
            ->join('users', 'relevamientos.user_id', '=', 'users.id')
            ->join('tools', 'relevamientos.tool_id', '=', 'tools.id')
            ->join('projects', 'relevamientos.project_id', '=', 'projects.id')
            ->select('tools.tool_name', 'projects.project_name', 'users.name', 'relevamientos.*')
            ->get();
        // dd($relevamientos);
        return view('relevamientos.index', compact('relevamientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function preCreate()
    {
        $projects = DB::table('projects')
            ->select('projects.id', 'projects.project_name')
            ->get();
        $tools = DB::table('tools')
            ->select('tools.id', 'tools.tool_name')
            ->get();

        return view('relevamientos.preCreate', compact('projects', 'tools'));
    }
    public function posCreate(Request $request)
    {
        //dd($request);
        //$request->pid; $request->tid;
        $toolData = DB::table('data')
            ->join('tools_data', 'data.id', '=', 'tools_data.data_id')
            ->join('tools', 'tools_data.tool_id', '=', 'tools.id')
            ->where('tools.id', $request->tool_id)
            ->select('data.*')
            ->get();

        $pid = $request->project_id;
        $tid = $request->tool_id;
        session(['pid' => $request->project_id]);
        session(['tid' => $request->tool_id]);
        session(['toolData' => $toolData]);

        // dd(session('pid'));

        return view('relevamientos.posCreate', compact('toolData', 'pid', 'tid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $toolData = session('toolData');
        $pid = session('pid');
        $tid = session('tid');

        try {
            $relevamiento = new Relevamiento();
            $relevamiento->relevamiento_creator = Auth::user()->name;
            $relevamiento->project_id = $pid;
            $relevamiento->tool_id = $tid;
            $relevamiento->user_id = Auth::user()->id;
            $relevamiento->save();

            //Updateo los campos de cada herramienta =====================
            $answer_id = array();
            $answers_value = array();
            foreach ($request->all() as $key => $value) {
                if (str_contains($key, 'data_id')) {
                    array_push($answer_id, $value);
                    // dd($answer_id);
                    // dd([$key,$value]);
                } elseif (str_contains($key, 'answer_name')) {
                    array_push($answers_value, $value);
                }
            }

            $td_key_values = array_combine($answer_id, $answers_value);
            foreach ($td_key_values as $key => $value) {
                $answer = new Answer();
                $answer->answer_name = $value;
                $answer->save();

                $da = new DataAnswer();
                $da->data_id = $key;
                $da->answer_id = $answer->id;
                $da->relevamiento_id = $relevamiento->id;
                $da->save();
            }




            //===============================================================
            return view('relevamientos.posCreate', compact('toolData', 'pid', 'tid'));
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Relevamiento  $relevamiento
     * @return \Illuminate\Http\Response
     */
    public function show(Relevamiento $relevamiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Relevamiento  $relevamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Relevamiento $relevamiento)
    {
        $relevamientoData = DB::table('relevamientos')
            ->join('tools', 'relevamientos.tool_id', '=', 'tools.id')
            ->join('tools_data', 'tools.id', '=', 'tools_data.tool_id')
            ->join('data', 'tools_data.data_id', '=', 'data.id')
            ->join('data_answers', 'data.id', '=', 'data_answers.data_id')
            ->join('answers', 'data_answers.answer_id', '=', 'answers.id')
            ->select('relevamientos.id as relevamiento_id', 'data.data_question', 'answers.id as answer_id', 'answers.answer_name')
            ->where('data_answers.relevamiento_id', $relevamiento->id)
            ->where('relevamientos.id', $relevamiento->id)
            ->get();

        // $dataset = DB::select(' 
        //     SELECT answers.answer_name, answers.id as answer_id, relevamientos.id as relevamiento_id, data.data_question FROM data 
        //         INNER JOIN tools_data ON data.id = tools_data.data_id
        //         INNER JOIN tools ON tools_data.tool_id = tools.id
        //         INNER JOIN relevamientos ON tools.id = relevamientos.tool_id
        //         INNER JOIN projects ON relevamientos.project_id = projects.id
        //         INNER JOIN data_answers ON data.id = data_answers.data_id
        //         INNER JOIN answers ON data_answers.answer_id = answers.id
        //         where data_answers.relevamiento_id = 1 and relevamientos.id = 1 ');
        // dd($relevamientoData);





        // dd($relevamiento);
        $projects = DB::table('projects')
            ->select('projects.id', 'projects.project_name')
            ->get();
        $actualP = DB::table('projects')
            ->select('projects.id', 'projects.project_name')
            ->where('projects.id', $relevamiento->project_id)
            ->get()->first();
        //dd($actualP);
        $tools = DB::table('tools')
            ->select('tools.id', 'tools.tool_name')
            ->where('tools.id', $relevamiento->tool_id)
            ->get()->first();

        // $relevamientoData = DB::table('relevamientos')
        //     ->join('tools', 'relevamientos.tool_id', '=', 'tools.id')
        //     ->join('tools_data', 'tools.id', '=', 'tools_data.tool_id')
        //     ->join('data', 'tools_data.data_id', '=', 'data.id')
        //     ->join('data_answers', 'data.id', '=', 'data_answers.data_id')
        //     ->join('answers', 'data_answers.answer_id', '=', 'answers.id')
        //     ->select('answers.answer_name', 'answers.id as answer_id', 'relevamientos.id as relevamiento_id', 'data.data_question')
        //     ->where('relevamientos.id', $relevamiento->id)
        //     ->get();
        // dd($relevamientoData);

        return view('relevamientos.edit', compact('relevamientoData', 'projects', 'tools', 'relevamiento', 'actualP'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Relevamiento  $relevamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relevamiento $relevamiento)
    {
        if (!is_null($request->project_id) && strcmp($request->project_id, $relevamiento->project_id) != 0) {
            echo "Hay que modificar ";
            $relevamiento->project_id = intval($request->project_id);
            $relevamiento->save();
        } else {
            echo "NO Hay que modificar ";
        }


        // dd( [ $request->project_id, $relevamiento->project_id]);

        // dd([$request->id, $relevamiento->project_id]);
        //Nuevo = request->id, Old = relevamiento_project_id
        try {
            //Agrupo las key,values a modificar =====================
            $answer_id = array();
            $answers_value = array();
            foreach ($request->all() as $key => $value) {
                if (str_contains($key, 'answer_id')) {
                    array_push($answer_id, $value);
                    // dd($answer_id);
                    // dd([$key,$value]);
                } elseif (str_contains($key, 'answer_name')) {
                    array_push($answers_value, $value);
                }
            }
            $td_key_values = array_combine($answer_id, $answers_value);
            //dd($td_key_values);
            //========================================================
            //updateo cada una de las respuestas que tiene el relevamiento. =========
            foreach ($td_key_values as $key => $value) {
                Answer::where('id', '=', $key)->update(['answer_name' => $value]);
            }

            return redirect()->route('relevamientos.index')->with('success', 'Relevamiento editaro correctamente!');
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Relevamiento  $relevamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relevamiento $relevamiento)
    {
        try {
            $answerIds = array();
            $relevamientos = DB::table('data_answers')
                ->select('data_answers.id as DA_id', 'data_answers.answer_id as answer_id')
                ->where('data_answers.relevamiento_id', $relevamiento->id)
                ->get();
    
            foreach ($relevamientos as $r) {
                array_push($answerIds, $r->answer_id);
            }
            DataAnswer::where('relevamiento_id', '=', $relevamiento->id)->delete();
            Answer::whereIn('id', $answerIds)->delete();

			$p = Relevamiento::find($relevamiento->id);
			if ($p) {
				$p->delete();
			}

			return redirect()->route('relevamientos.index')->with('success', 'Relevamiento Eliminado correctamente!');

		} catch (Exception $e) {
			return [
				'value'  => [],
				'status' => 'error',
				'message'   => $e->getMessage()

			];
		}       
    }
    
}
