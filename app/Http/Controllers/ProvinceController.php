<?php

namespace App\Http\Controllers;

use App\Province;
use Exception;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		try {
			$values = Province::all();
			return response()->json([
				'value'  => $values,
				'status' => 'success',
				'message' => 'Provinces Listed Successfully !!',
				'mensaje' => 'province controller',

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
	 * @param  \App\Province  $province
	 * @return \Illuminate\Http\Response
	 */
	public function show(Province $province)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Province  $province
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Province $province)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Province  $province
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Province $province)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Province  $province
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Province $province)
	{
		//
	}
}
