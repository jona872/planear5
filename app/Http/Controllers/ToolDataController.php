<?php

namespace App\Http\Controllers;

use App\ToolData;
use Exception;
use Illuminate\Http\Request;

class ToolDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $values = ToolData::all();
            return response()->json([
                'value'  => $values,
                'mensaje' => 'ToolData controller',
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ToolData  $toolData
     * @return \Illuminate\Http\Response
     */
    public function show(ToolData $toolData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ToolData  $toolData
     * @return \Illuminate\Http\Response
     */
    public function edit(ToolData $toolData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ToolData  $toolData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToolData $toolData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ToolData  $toolData
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToolData $toolData)
    {
        //
    }
}
