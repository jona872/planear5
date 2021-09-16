<?php

namespace App\Http\Controllers;

use App\ProjectRelevamiento;
use Illuminate\Http\Request;

class ProjectRelevamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = ProjectRelevamiento::all();
        return response()->json([
            'mensaje' => 'ProjectRelevamiento controller',
            'value' => $values
        ]);
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
     * @param  \App\ProjectRelevamiento  $projectRelevamiento
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectRelevamiento $projectRelevamiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectRelevamiento  $projectRelevamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectRelevamiento $projectRelevamiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectRelevamiento  $projectRelevamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectRelevamiento $projectRelevamiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectRelevamiento  $projectRelevamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectRelevamiento $projectRelevamiento)
    {
        //
    }
}
