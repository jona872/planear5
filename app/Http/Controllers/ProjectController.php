<?php

namespace App\Http\Controllers;

use App\City;
use App\Project;
use App\Proyecto;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Validator;
use \Validator;
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
		return view('projects.index', compact('projects'));
	}

	public function getProjects()
	{
		try {
			$projects = DB::table('projects')
				->select('projects.*', 'cities.city_name')
				->join('cities', 'projects.city_id', '=', 'cities.id')
				->get();

			return response()->json([
				'value'  => $projects,
				'status' => 'success',
				'message' => 'Post Listed Successfully !!'
			]);
		} catch (Exception $e) {
			return [
				'value'  => [],
				'status' => 'error',
				'message'   => $e->getMessage()
			];
		}
	}


	public function search(Request $request)
	{
		// dd($request->search);
		$request->validate([
			'search' => 'required',
		]);

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

		$request_params = $request->all();

		$rules = array(
			'project_name' => 'required',
			'city_id' => 'required'
		);

		$messages = [
			'project_name.required' => 'El nombre del proyecto es requerido',
			'city_id.required' => 'La ciudad es requerida',
		];

		$validator = Validator::make($request_params, $rules, $messages);

		if ($validator->passes()) {
			Project::create($request->all());
			return redirect()->route('projects.index')->with('success', 'Proyecto creado correctamente!');
		}
		return redirect()->back()->withErrors($validator->messages());
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
		$request_params = $request->all();
		$rules = array(
			'project_name' => 'required'
		);

		$messages = [
			'project_name.required' => 'El nombre del proyecto es requerido',
		];

		$validator = Validator::make($request_params, $rules, $messages);

		if ($validator->passes()) {

			try {
				$p = Project::find($request->id);
				if ($p) {
					$p->update($request->all());
				}
				return redirect()->route('projects.index')->with('success', 'Proyecto editado correctamente!');
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
	 * @param  \App\Project  $Project
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		try {
			$p = Project::find($id);
			if ($p) {
				$p->delete();
			}
			return redirect()->route('projects.index')->with('success', 'Proyecto eliminado correctamente');
		} catch (Exception $e) {
			return [
				'value'  => [],
				'status' => 'error',
				'message'   => $e->getMessage()

			];
		}
	}
}
