<?php

namespace App\Http\Controllers;

use App\Data;
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
        $relevamientos = Relevamiento::all();
        // return response()->json([
        //                     'mensaje' => 'relevamiento controller',
        //                     'value' => $values   
        //                 ]);
        return view('relevamientos.index', compact('relevamientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function preCreate()
    {
        // $projects = Project::all();
        // $tools = Tool::all();

        // $projects2 = Project::pluck('project_name', 'id')->all();
        // $tools = Tool::pluck('tool_name', 'id') ->all();

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
        //1 creo el relevameinto conel toolID
        //2 Creo el projects_relevamientos con el id recien creado y el projectID
        try {
            $relevameinto = new Relevamiento();
            if ($relevameinto) {
                $relevameinto->relevamiento_creator = Auth::user()->name;
                $relevameinto->tool_id = $request->tool_id;
                $relevameinto->relevamiento_latitud = "";
                $relevameinto->relevamiento_longitud = "";
                $relevameinto->save();

                $pr = new ProjectRelevamiento();
                if ($pr) {
                    $pr->relevamiento_id = $relevameinto->id;
                    $pr->project_id = $request->project_id;
                    $pr->save();
                }
            }
            $toolData = DB::table('data')
                ->join('tools_data', 'data.id', '=', 'tools_data.data_id')
                ->join('tools', 'tools_data.tool_id', '=', 'tools.id')
                ->where('tools.id', $request->tool_id)
                ->select('data.*')
                ->get();

            return view('relevamientos.posCreate', compact('toolData'));
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Recibe un proyectoID, una HerramientaID y las respuestas de esa Herramienta.
        // 1) Update data
        // 2) Agrega el relavmiento nuevo (idHerramienta, fecha y responsable.)
        // 3) Cuando ya tengo el id del nuevo relevamiento, agrego ese relevamientoID + proyectoID a 'projects_relevamientos'
        try {
            
            //Updateo los campos de cada herramienta =====================
            $data_ids = array();
            $data_answers = array();
            foreach ($request->all() as $key => $value) {
                if (str_contains($key, 'data_id')) {
                    array_push($data_ids, $value);
                }elseif (str_contains($key, 'data_answer')){
                    array_push($data_answers, $value);
                }
            }

            $td_key_values = array_combine($data_ids, $data_answers);
            // dd($td_key_values);
            foreach ($td_key_values as $key => $value) {
                Data::where('id', $key)->update(['data_answer' => $value]);
            }
            //===============================================================

            return redirect()->back()->withSuccess(['Recopilacion Exitosa!']);
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }



        dd($request);
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
        return view('relevamientos.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Relevamiento  $relevamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relevamiento $relevamiento)
    {
        //
    }
}
