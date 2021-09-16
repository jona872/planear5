<?php

namespace App\Http\Controllers;

use App\Proyecto;
use Illuminate\Http\Request;
use Exception;

class ProyectoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		try {
			$getAllProyecto = Proyecto::orderBy('id', 'desc')->get();

			return response()->json([
				'value'  => $getAllProyecto,
				'status' => 'success',
				'message' => 'Proyecto Listed Successfully !!'
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
		try {
			$proyecto = Proyecto::create($request->all());

			return response()->json([
				'value'  => $proyecto,
				'status' => 'success',
				'message' => 'Proyecto Added Successfully !!'
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
	 * Display the specified resource.
	 *
	 * @param  \App\Proyecto  $proyecto
	 * @return \Illuminate\Http\Response
	 */
	public function show(Proyecto $Proyecto)
	{
		try {
			$getProyectoData = Proyecto::find($Proyecto->id);
			return response()->json([
				'value'  => $getProyectoData,
				'status' => 'success',
				'message' => 'Proyecto Showed Successfully !!'
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Proyecto  $proyecto
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Proyecto $proyecto)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Proyecto  $proyecto
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Proyecto $Proyecto)
	{
		try {
			$p = Proyecto::find($request->id);

			if ($p) {
				// Proyecto::where('id', $id)->update($request->all());
				$p->update($request->all());
			}
			return response()->json([
				'value'  => $p,
				'status' => 'success',
				'message' => 'Proyecto Editado Successfully !!'
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
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Proyecto  $proyecto
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Proyecto $Proyecto)
	{
		try {
			$p = Proyecto::find($Proyecto->id);
			if ($p) {
				$p->delete();
			}
			return response()->json([
				'value'  => [],
				'status' => 'success',
				'message' => 'Proyecto Removed Successfully !!'
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
