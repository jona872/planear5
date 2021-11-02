<?php

namespace App\Http\Controllers;

use App\Data;
use App\Tool;
use App\ToolData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tools = Tool::all();
        return view('data.index', compact('tools'));
    }
    public function customize(Request $request)
    {
        $params = $request->all();
        $t = Tool::find($request->tool_id);
        $params['tool_name'] = $t->tool_name;

        return view('data.create', compact('params'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    public function test()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            foreach ($request->all() as $key => $value) {
                if (str_contains($key, 'data_question')) {
                    $data = new Data();
                    $data->data_question = $value;
                    $data->save();

                    $td = new ToolData();
                    $td->tool_id = $request['tool_id'];
                    $td->data_id = $data->id;
                    $td->save();
                }
            }
            return redirect()->route('tools.index')->with('success', 'Preguntas agregadas correctamente');
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
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function show(Data $data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function edit(Data $data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Data $data)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        // Session::flash('message','Cliente eliminado correctamente');
        // return Redirect::to('owners');

        try {
            $td = DB::table('tools_data')
                // ->select('tools_data.id', 'tools_data.data_id','tools_data.tool_id')
                ->select('tools_data.id')
                ->join('data', 'tools_data.data_id', '=', 'data.id')
                ->where('data.id', $id)
                ->get();

            ToolData::destroy($td[0]->id);

            // $d = Data::find($id);
            // if ($d) {
            //     Data::destroy($id);
            // }


            $d = Data::findOrFail($id);
            $d->delete();
            return redirect()->back()->withSuccess(['Success Delete Message here!']);



            // return redirect()->route('tools.index')->withSuccess(['Success Delete Message here!']);
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }

    public function getDatas()
    {
        try {
            $data = Data::all();
            return response()->json([
                'value'  => $data,
                'status' => 'success',
                'message' => 'Datas Listed Successfully !!'
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
