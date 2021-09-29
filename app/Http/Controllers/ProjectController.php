<?php

namespace App\Http\Controllers;

use App\City;
use App\Project;
use App\Proyecto;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Throwable;

class ProjectController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$projects = DB::table('projects')
			->select('projects.*', 'cities.city_name')
			->join('cities', 'projects.city_id', '=', 'cities.id')
			->get();
		// dd($projects);
		return view('projects.index', compact('projects'));
	}
	public function search(Request $request)
	{
		// dd($request->search);

		if (is_null($request->search)) {
			$projects = Project::all();
		} else {
			$projects = DB::table('projects')
				->select('projects.*', 'cities.city_name')
				->join('cities', 'projects.city_id', '=', 'cities.id')
				->where('project_name', 'like', '%' . $request->search . '%')
				->orderBy('project_name', 'desc')
				->get();
		}

		//return redirect()->route('projects.index',compact('projects'));
		return view('projects.index', compact('projects'));
	}

	public function action(Request $request)
	{
		if ($request->ajax()) {
			$output = '';
			$query = $request->get('query');
			if ($query != '') {
				$data = DB::table('projects')
					->where('project_name', 'like', '%' . $query . '%')
					->orderBy('project_name', 'desc')
					->get();
			} else {
				$data = DB::table('projects')
					->orderBy('project_name', 'desc')
					->get();
			}
			$total_row = $data->count();
			if ($total_row > 0) {
				foreach ($data as $row) {
					$output .= '
        <tr>
         <td>' . $row->project_name . '</td>
         <td>' . $row->project_name . '</td>
         <td>' . $row->project_name . '</td>
         <td>' . $row->project_name . '</td>
        </tr>
        ';
				}
			} else {
				$output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
			}
			$data = array(
				'table_data'  => $output,
				'total_data'  => $total_row
			);

			echo json_encode($data);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		// $cities = City::pluck('city_name', 'id');
		$cities = City::all();


		return view('projects.create', ["cities" => $cities]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'project_name' => 'required',
		]);

		Project::create($request->all());
		return redirect()->route('projects.index')->with('success', 'Post created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Project  $Project
	 * @return \Illuminate\Http\Response
	 */
	public function show(Project $project)
	{
		$city = DB::table('cities')
			->where('id', $project->city_id)
			->get();
		$project['city_name'] = $city[0]->city_name;
		return view('projects.show', compact('project'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Project  $Project
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Project $project)
	{
		$cities = City::all();
		$projects = DB::table('projects')
			->select('projects.*', 'cities.city_name', 'cities.id as city_id')
			->join('cities', 'projects.city_id', '=', 'cities.id')
			->where('projects.id', $project->id)
			->get();
		// dd($projects);
		return view('projects.edit', compact('projects', 'cities'));
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
		//$data = array('requestValues' => $request->all(), 'Project' => $Project );

		$request->validate([
			'project_name' => 'required',
		]);

		try {
			$p = Project::find($request->id);
			if ($p) {
				// Project::where('id', $id)->update($request->all());
				$p->update($request->all());
			}
			return redirect()->route('projects.index')->with('success', 'Project updated successfully');
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
			return redirect()->route('projects.index')->with('success', 'project deleted successfully');
		} catch (Exception $e) {
			return [
				'value'  => [],
				'status' => 'error',
				'message'   => $e->getMessage()

			];
		}
	}
}
