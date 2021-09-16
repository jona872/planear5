<?php

namespace App\Http\Controllers;

use App\Relevamiento;
use Illuminate\Http\Request;

class RelevamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = Relevamiento::all();
        return response()->json([
                            'mensaje' => 'relevamiento controller',
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
        //
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
