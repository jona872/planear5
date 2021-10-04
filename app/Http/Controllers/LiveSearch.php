<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class LiveSearch extends Controller

{
	public function map()
	{
		$boxmap = Project::all();

		$dataMap  = array();
		$dataMap['type'] = 'FeatureCollection';
		$dataMap['features'] = array();
		foreach ($boxmap as $value) {
			$feaures = array();
			$feaures['type'] = 'Feature';
			$geometry = array("type" => "Point", "coordinates" => [$value->project_latitud, $value->project_longitud]);
			$feaures['geometry'] = $geometry;
			$properties = array('title' => $value->project_name, "description" => $value->project_name);
			$feaures['properties'] = $properties;
			array_push($dataMap['features'], $feaures);
		}
		//return View('pages.google-map')->with('dataArray',json_encode($dataMap));
		return view('map')->with('dataArray', json_encode($dataMap));
	}
	public function index()
	{
		return view('live_search');
	}
	public function store(Request $request)
	{
		dd($request->all());
		//$validated = $request->validated();
		//Project::create($request->all());
		return redirect('/map')->with('success', "Add map success!");
	}

	public function action(Request $request)
	{
		if ($request->ajax()) {
			$output = '';
			$query = $request->get('query');
			if ($query != '' && !is_null($query)) {
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
}
