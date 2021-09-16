<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Exception;

class ProjectController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Project::all();
		// try {
		// 	$getAllProject = Project::orderBy('id', 'desc')->get();

		// 	return response()->json([
		// 		'value'  => $getAllProject,
		// 		'status' => 'success',
		// 		'message' => 'Project Listed Successfully !!'
		// 	]);
		// } catch (Exception $e) {
		// 	return [
		// 		'value'  => [],
		// 		'status' => 'error',
		// 		'message'   => $e->getMessage()

		// 	];
		// }
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
			$Project = Project::create($request->all());

			return response()->json([
				'value'  => $Project,
				'status' => 'success',
				'message' => 'Project Added Successfully !!'
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
	 * @param  \App\Project  $Project
	 * @return \Illuminate\Http\Response
	 */
	public function show(Project $Project)
	{
		try {
			$getProjectData = Project::find($Project->id);
			return response()->json([
				'value'  => $getProjectData,
				'status' => 'success',
				'message' => 'Project Showed Successfully !!'
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
	 * @param  \App\Project  $Project
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Project $Project)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Project  $Project
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Project $Project)
	{
		try {
			$p = Project::find($request->id);

			if ($p) {
				// Project::where('id', $id)->update($request->all());
				$p->update($request->all());
			}
			return response()->json([
				'value'  => $p,
				'status' => 'success',
				'message' => 'Project Editado Successfully !!'
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
	 * @param  \App\Project  $Project
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Project $Project)
	{
		try {
			$p = Project::find($Project->id);
			if ($p) {
				$p->delete();
			}
			return response()->json([
				'value'  => [],
				'status' => 'success',
				'message' => 'Project Removed Successfully !!'
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
