<?php

namespace App\Http\Controllers;

use App\City;
use App\Data;
use App\Tool;
use Exception;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ToolController extends Controller
{

    /*
   AJAX request
   */
    public function getEmployees(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $cities = City::orderby('city_name', 'asc')->select('id', 'city_name')->limit(5)->get();
        } else {
            $cities = City::orderby('city_name', 'asc')->select('id', 'city_name')->where('city_name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($cities as $city) {
            $response[] = array("value" => $city->id, "label" => $city->name);
        }

        return response()->json($response);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $values = Tool::all();
        // return view('tools.index');


        $tools = DB::table('tools')
            ->select('tools.*', 'users.name')
            ->join('users', 'tools.user_id', '=', 'users.id')
            ->get();
        // dd($tools);
        return view('tools.index', compact('tools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tools.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_params = $request->all();
        $rules = array(
            'tool_name' => 'required'
        );

        $messages = [
            'tool_name.required' => 'El nombre de la herramienta es requerido',
        ];

        $validator = Validator::make($request_params, $rules, $messages);

        if ($validator->passes()) {
            //$request['user_id'] = Auth::user()->id; 
            $request['user_id'] = $request_params['user_id'];

            Tool::create($request->all());
            return redirect()->route('tools.index')->with('success', 'Herramienta creada corractamente');
        }
        return redirect()->back()->withErrors($validator->messages());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function show(Tool $tool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function edit(Tool $tool)
    {
        $toolData = DB::table('data')
            ->join('tools_data', 'data.id', '=', 'tools_data.data_id')
            ->join('tools', 'tools_data.tool_id', '=', 'tools.id')
            ->where('tools.id', $tool->id)
            ->select('data.id', 'data.data_question')
            ->get();
        $creator = DB::table('users')
            ->select('users.name')
            ->where('users.id', $tool->user_id)
            ->get()
            ->first();
        $tool['creator'] = $creator->name;

        return view('tools.edit', compact('tool', 'toolData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tool $tool)
    {
        $request_params = $request->all();
        $rules = array(
            'tool_name' => 'required'
        );

        $messages = [
            'tool_name.required' => 'El nombre de la herramienta es requerido',
        ];

        $validator = Validator::make($request_params, $rules, $messages);

        if ($validator->passes()) {


            try {
                //$request['user_id'] = Auth::user()->id;

                //Updateo los campos de cada herramienta =====================
                $data_ids = array();
                $data_questions = array();
                foreach ($request->all() as $key => $value) {
                    if (str_contains($key, 'data_id')) {
                        array_push($data_ids, $value);
                    }
                }
                foreach ($request->all() as $key => $value) {
                    if (str_contains($key, 'data_question')) {
                        array_push($data_questions, $value);
                    }
                }
                $td_key_values = array_combine($data_ids, $data_questions);

                foreach ($td_key_values as $key => $value) {
                    Data::where('id', $key)->update(['data_question' => $value]);
                }
                //===============================================================


                $p = Tool::find($request->id);
                if ($p) {
                    $p->tool_name = $request->tool_name;
                    $p->save();
                }

                return redirect()->route('tools.index')->with('success', 'Herramienta editada correctamente');
            } catch (Exception $e) {
                return [
                    'value'  => [],
                    'status' => 'error',
                    'message'   => $e->getMessage()

                ];
            }
        }
        return redirect()->back()->with('errors', $validator->messages());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tool  $tool
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $p = Tool::find($id);
            if ($p) {
                $p->delete();
            }
            return redirect()->route('tools.index')->with('success', 'Herramienta eliminada correctamente');
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }
    public function getTools()
    {
        try {
            $tools = Tool::all();
            return response()->json([
                'value'  => $tools,
                'status' => 'success',
                'message' => 'Tools Listed Successfully !!'
            ]);
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()
            ];
        }
    }
}
