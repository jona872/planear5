<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Data;
use App\DataAnswer;
use App\Project;
use App\ProjectRelevamiento;
use App\Relevamiento;
use App\Tool;
use App\ToolData;
use Carbon\Carbon;
use Exception;
use Validator;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
use SplTempFileObject;
use PhpParser\Node\Expr\FuncCall;
use SplFileObject;

//use Illuminate\Support\Facades\Input;

class RelevamientoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$relevamientos = DB::table('relevamientos')
			->join('users', 'relevamientos.user_id', '=', 'users.id')
			->join('tools', 'relevamientos.tool_id', '=', 'tools.id')
			->join('projects', 'relevamientos.project_id', '=', 'projects.id')
			->select('projects.project_name', 'tools.tool_name', 'users.name', 'relevamientos.*')
			->orderBy('relevamientos.created_at', 'desc')
			->orderBy('relevamientos.id', 'desc')
			->get();


		if (session()->has('export')) {
			session()->forget('export');
		}
		session(['export' => $relevamientos]);

		return view('relevamientos.index', compact('relevamientos'));
	}

	public function nameSearch(Request $request)
	{
		try {
			$relevamientos = DB::table('relevamientos')
				->join('users', 'relevamientos.user_id', '=', 'users.id')
				->join('tools', 'relevamientos.tool_id', '=', 'tools.id')
				->join('projects', 'relevamientos.project_id', '=', 'projects.id')
				->select('tools.tool_name', 'projects.project_name', 'users.name', 'relevamientos.*')
				->where('projects.project_name', 'like', '%' . $request->search . '%')
				->orderBy('projects.project_name', 'desc')
				->get();

			session()->forget('export');
			session(['export' => $relevamientos]);

			return view('relevamientos.index', compact('relevamientos'));
		} catch (Exception $e) {
			return [
				'value'  => [],
				'status' => 'error',
				'message'   => $e->getMessage()

			];
		}
	}
	public function dateSearch(Request $request)
	{
		// dd($request->all());
		// "searchStart" => "01/09/2021"
		// "searchEnd" => "02/09/2021"
		$start = Carbon::createFromFormat('d/m/Y', $request->searchStart)->toDateString();
		$end = Carbon::createFromFormat('d/m/Y', $request->searchEnd);
		//dd([$start, $end]);
		$relevamientos = DB::table('relevamientos')
			->join('users', 'relevamientos.user_id', '=', 'users.id')
			->join('tools', 'relevamientos.tool_id', '=', 'tools.id')
			->join('projects', 'relevamientos.project_id', '=', 'projects.id')
			->select('tools.tool_name', 'projects.project_name', 'users.name', 'relevamientos.*')
			->whereBetween('relevamientos.created_at', [$start, $end])
			->orderBy('relevamientos.created_at', 'desc')
			->get();
		session()->forget('export');
		session(['export' => $relevamientos]);
		// dd($relevamientos);
		return view('relevamientos.index', compact('relevamientos'));
	}

	public function picker(Request $request)
	{
		$projects = DB::table('projects')
			->select('projects.id', 'projects.project_name')
			->get();
		$tools = DB::table('tools')
			->select('tools.id', 'tools.tool_name')
			->get();

		return view('relevamientos.picker', compact('projects', 'tools'));
	}

	public function preview(Request $request)
	{
		// dd($request);
		//dd($request->file());
		//dd($request->all()); // project_id y tool_id
		// dd($request->file('file')); //en forma de array plano
		if ($request->hasFile('file')) {
			$tmpFile = $request->file;

			$path = $request->file->path();
			$extension = $request->file->extension();

			$grupos = array();
			$grupo = array();
			$grupo['project_name'] = Project::find($request->project_id)->project_name;
			$grupo['tool_name'] = Tool::find($request->tool_id)->tool_name;

			//load the CSV document from a file path
			$reader = Reader::createFromPath($path, 'r');
			$importedValues = array();
			$reader->setHeaderOffset(0);
			$header_offset = $reader->getHeaderOffset();
			$header = $reader->getHeader(); //returns ['First Name', 'Last Name', 'E-mail']
			$grupo['preguntas'] = $header;
			$grupo['colCount'] = count($header);

			$row = array();
			$newDataCount = 0;
			$newAnswerCount = 0;
			foreach ($reader as $offset => $record) { //todo el csv
				// dd($record);

				$relevamiento = new Relevamiento();
				$relevamiento->relevamiento_creator = Auth::user()->name;
				$relevamiento->user_id = Auth::user()->id;
				$relevamiento->project_id = intval($request->project_id);
				$relevamiento->tool_id = intval($request->tool_id);
				$relevamiento->save();
				//Guardar este ID para editarlo cuando termino


				foreach ($record as $data_question => $answer_name) { // data_question - answer_name
					//dd($row);
					array_push($row, $answer_name);
					//dd($data_question);
					//dd([$data_question, $answer_name]);
					//busco cada pregunta del csv para ver si existe.
					$data = DB::table('data')
						->join('tools_data', 'tools_data.data_id', '=', 'data.id')
						->join('tools', 'tools_data.tool_id', '=', 'tools.id')
						->join('relevamientos', 'relevamientos.tool_id', '=', 'tools.id')
						->join('projects', 'relevamientos.project_id', '=', 'projects.id')
						->where('data_question', 'LIKE', $data_question)
						->where('projects.id', intval($request->project_id))
						->where('tools.id', intval($request->tool_id))
						->select('data.*')
						->first();

					//dd($data);

					if (!$data) { //Si no encontro, tengo que agregar el data al toolData y desp las relaciones existentes
						$newQuestion = new Data();
						$newQuestion->data_question = $data_question;
						$newQuestion->save();
						$newDataCount++;

						$toolData = new ToolData();
						$toolData->tool_id = intval($request->tool_id);
						$toolData->data_id = $newQuestion->id;
						$toolData->save();

						$answer = new Answer();
						$answer->answer_name = $answer_name;
						$answer->save();
						$newAnswerCount++;

						$dataAnswer = new DataAnswer();
						$dataAnswer->data_id = $newQuestion->id;
						$dataAnswer->answer_id = $answer->id;
						$dataAnswer->relevamiento_id = $relevamiento->id;
						$dataAnswer->save();



						//updateo los que ya existen (Busco todos los relevamientos que tenga este proyecto - herramienta)
						$relevamientoID = DB::table('relevamientos')
							->join('projects', 'relevamientos.project_id', '=', 'projects.id')
							->join('tools', 'relevamientos.tool_id', '=', 'tools.id')
							->where('projects.id', intval($request->project_id))
							->where('tools.id', intval($request->tool_id))
							->select('relevamientos.id')
							->distinct()
							->get();

						$relevamientoIDsinUltimo = array();
						foreach ($relevamientoID as $key => $value) {
							if ($value->id != $relevamiento->id)
								array_push($relevamientoIDsinUltimo, $value->id);
						}

						foreach ($relevamientoIDsinUltimo as $r) {
							$existeRelacion = DB::table('data_answers')
								->where('data_answers.relevamiento_id', '=', $r)
								->where('data_answers.data_id', '=', $newQuestion->id)
								->get();


							if ($existeRelacion->isEmpty()) { //No existe relacion de Data-Tool-Relevamiento
								//"updateo", agrego la resp. nula a los relavamientos del "proyecto-tool" (tabla dataAnswer)
								$answer = new Answer();
								$answer->answer_name = "";
								$answer->save();
								//$newAnswerCount++; con answer nula

								$dataAnswer = new DataAnswer();
								$dataAnswer->data_id = $newQuestion->id;
								$dataAnswer->answer_id = $answer->id;
								$dataAnswer->relevamiento_id = $r;
								$dataAnswer->save();
							} else { //Lo mismo pero sin answer nula, si no con la que le mande del csv
								$answer = new Answer();
								$answer->answer_name = $answer_name;
								$answer->save();
								$newAnswerCount++;

								$dataAnswer = new DataAnswer();
								$dataAnswer->data_id = $newQuestion->id;
								$dataAnswer->answer_id = $answer->id;
								$dataAnswer->relevamiento_id = $r;
								$dataAnswer->save();
							}
						}
					} else { //existe una pregunta, asi que agrego a la relacion existente
						//dd([$data->id, $data->data_question, $answer_name]);
						$answer = new Answer();
						$answer->answer_name = $answer_name;
						$answer->save();
						$newAnswerCount++;

						$dataAnswer = new DataAnswer();
						$dataAnswer->data_id = $data->id;
						$dataAnswer->answer_id = $answer->id;
						$dataAnswer->relevamiento_id = $relevamiento->id;
						$dataAnswer->save();
					}
				}
				// array_push($importedValues, $record);
			}
			$grupo['respuestas'] = array_chunk($row, $grupo['colCount']);
			$grupo['newDataCount'] = $newDataCount;
			$grupo['newAnswerCount'] = $newAnswerCount;
			array_push($grupos, $grupo);
			//dd($grupos);

			//dd($importedValues);
			return view('relevamientos.import-result', compact('grupos'));
		}

		//$fileName = time().'.'.$request->file->extension();  
		//$fileName = $request->file->originalName . '.' . $request->file->extension();

		//dd($fileName);
		return view('relevamientos.picker');
	}



	public function fileUpload(Request $request)
	{

		// $request->validate([
		//     'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
		//     ]);

		dd($request->file());
		return view('relevamientos.picker');
	}

	public function import(Request $request)
	{
		dd($request);
	}


	public function selectExport(Request $request)
	{
		$projects = Project::all();
		$tools = Tool::all();
		return view('relevamientos.select-export', compact('projects', 'tools'));
	}

	public function getProjectTools(Request $request)
	{
		try {
			$tools = DB::table('tools')
				->join('relevamientos', 'relevamientos.tool_id', '=', 'tools.id')
				->join('projects', 'relevamientos.project_id', '=', 'projects.id')
				->where('projects.id', $request->id)
				->select('tools.id', 'tools.tool_name')
				->distinct()
				->get();
			return response()->json([
				'value'  => $tools,
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


	public function exportTool(Request $request)
	{
		//dd($request->all());
		//obtengo los relevamientos_id que voy a exportar.
		$relevamientos = DB::table('relevamientos')
			->join('tools', 'tools.id', '=', 'relevamientos.tool_id')
			->join('projects', 'projects.id', '=', 'relevamientos.project_id')
			->where('projects.id', intval($request->pList))
			->where('tools.id', intval($request->tList))
			->select('relevamientos.id', 'projects.project_name', 'tools.tool_name')
			->get();

		$ids = array();
		foreach ($relevamientos as $key => $value) {
			array_push($ids, $value->id);
		}

		//Todas las preguntas que tiene la herramienta
		$preguntas = DB::table('data_answers')
			->join('data', 'data.id', '=', 'data_answers.data_id')
			->whereIn('data_answers.relevamiento_id', $ids)
			->select('data.data_question')
			->orderBy('data.id')
			->distinct()
			->get();

		$q = array();
		foreach ($preguntas as $key => $value) {
			array_push($q, $value->data_question);
		}
		// dd($q);

		//Todas las respuestas de la herramienta (todos los relevamientos que tiene el proyecto)
		$respuestas = DB::table('data_answers')
			->join('answers', 'answers.id', '=', 'data_answers.answer_id')
			->whereIn('data_answers.relevamiento_id', $ids)
			->select('answers.answer_name')
			->orderBy('answers.id')
			->get();
		// dd($respuestas);
		$r = array();
		foreach ($respuestas as $key => $value) {
			array_push($r, $value->answer_name);
		}
		//divido en grupos de n elementos
		$r = array_chunk($r, count($q));
		//dd($r);



		//Ahora meto esos rel_id en data_answers y obtengo todas las Preg-Resp que necesito.
		$grupos = array();
		$grupo = array();
		$grupo['project_name'] = $request->pName;
		$grupo['tool_name'] = $request->tName;
		$grupo['pid'] = $request->pList;
		$grupo['tid'] = $request->pList;

		$grupo['preguntas'] = $q;
		$grupo['respuestas'] = $r;
		array_push($grupos, $grupo);
		//dd($grupos);
		return view('relevamientos.exportar', compact('grupos'));
	}


	public function exportTools(Request $request)
	{
		// "pList", "tList"
		dd($request->all());
	}

	//viejo
	public function export(Request $request)
	{
		//dd($request->all());
		$tool_id = $request->tList;
		$project_id = $request->pList;


		$relevamientos = DB::table('relevamientos')
			->join('tools', 'tools.id', '=', 'relevamientos.tool_id')
			->join('projects', 'projects.id', '=', 'relevamientos.project_id')
			->get();


		$grupos = array();
		$grupo = array();


		foreach ($relevamientos as $relevamiento) {
			//dd($relevamiento->id);
			$grupo['project_name'] = $relevamiento->project_name;
			$grupo['tool_name'] = $relevamiento->tool_name;
			$grupo['pid'] = $relevamiento->project_id;
			$grupo['tid'] = $relevamiento->tool_id;

			$preguntas = DB::select("SELECT answers.answer_name, data.data_question FROM answers
                INNER JOIN data_answers ON data_answers.answer_id = answers.id
                INNER JOIN data on data.id = data_answers.data_id
                WHERE answers.id IN 
                    (SELECT id from answers WHERE id IN 
                        (SELECT answer_id FROM data_answers 
                        WHERE relevamiento_id='.$relevamiento->id.')
                    )");
			//dd($preguntas);

			$questions = array();
			$answers = array();
			//aplano las preguntas a un solo array
			foreach ($preguntas as $value) {
				array_push($questions, $value->data_question);
				array_push($answers, $value->answer_name);
			}
			$grupo['preguntas'] = $questions;
			$grupo['respuestas'] = $answers;
			$grupo['colCount'] = count($questions);
			//dd($grupo);            
			array_push($grupos, $grupo);
		}

		//dd($grupos);
		return view('relevamientos.exportar', compact('grupos'));
	}

	public function exportConfirm(Request $request) //hasta aca session sigue con los mismos datos
	{ //handle csv output
		//dd($request->all());
		//dd(unserialize($request->exportData));
		//dd($request->all());
		$grupo = unserialize($request->exportData);
		//dd($grupo['project_name']);
		$csv = $this->exportData($grupo);
		$csv->output($grupo['project_name'] . ' -- ' . $grupo['tool_name'] . '.csv');
	}


	public function exportData($grupo)
	{
		//dd($grupo);
		//dd($grupo['respuestas']);

		$csv = Writer::createFromFileObject(new SplTempFileObject());

		//header
		$csv->insertOne($grupo['preguntas']);

		//body 
		foreach ($grupo['respuestas'] as $key => $value) {
			$csv->insertOne($value);
		}
		//OLD Insert MULTIPLE VALUES
		// foreach ($grupo['respuestas'] as $key => $columnas) {
		//     dd($columnas);
		//     $csv->insertOne($columnas);
		// }

		return $csv;
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function preCreate()
	{
		$projects = DB::table('projects')
			->select('projects.id', 'projects.project_name')
			->get();
		$tools = DB::table('tools')
			->select('tools.id', 'tools.tool_name')
			->get();

		return view('relevamientos.preCreate', compact('projects', 'tools'));
	}


	public function posCreate(Request $request)
	{
		$request_params = $request->all();
		// dd($request_params);
		$rules = array(
			'project_id' => 'integer|required',
			'tool_id' => 'integer|required'
		);

		$messages = [
			'project_id.required' => 'El nombre del projecto es requerido',
			'project_id.integer' => 'El identificativo debe ser numerico',
			'tool_id.required' => 'El nombre de la herramienta es requerido',
			'tool_id.integer' => 'El identificativo debe ser numerico',
		];

		$validator = Validator::make($request_params, $rules, $messages);

		if ($validator->passes()) {

			//$request->pid; $request->tid;
			$toolData = DB::table('data')
				->join('tools_data', 'data.id', '=', 'tools_data.data_id')
				->join('tools', 'tools_data.tool_id', '=', 'tools.id')
				->where('tools.id', $request->tool_id)
				->select('data.*')
				->get();

			$pid = $request->project_id;
			$tid = $request->tool_id;
			session(['pid' => $request->project_id]);
			session(['tid' => $request->tool_id]);
			session(['toolData' => $toolData]);
			session(['lat' => $request->lat]);
			session(['lon' => $request->lon]);

			return view('relevamientos.posCreate', compact('toolData', 'pid', 'tid'));
		}
		return redirect()->back()->withErrors($validator->messages());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//dd($request->all());
		$toolData = session('toolData');
		$pid = session('pid');
		$tid = session('tid');
		$lat = session('lat');
		$lon = session('lon');
		try {
			$relevamiento = new Relevamiento();
			$relevamiento->relevamiento_creator = Auth::user()->name;
			$relevamiento->project_id = $pid;
			$relevamiento->tool_id = $tid;
			$relevamiento->user_id = Auth::user()->id;
			$relevamiento->relevamiento_latitud = $request->lat;
			$relevamiento->relevamiento_longitud = $request->lon;
			//$relevamiento->created_at = date("d-m-Y");
			$relevamiento->save();

			//Updateo los campos de cada herramienta =====================
			$answer_id = array();
			$answers_value = array();
			foreach ($request->all() as $key => $value) {
				if (str_contains($key, 'data_id')) {
					array_push($answer_id, $value);
					// dd($answer_id);
					// dd([$key,$value]);
				} elseif (str_contains($key, 'answer_name')) {
					array_push($answers_value, $value);
				}
			}

			$td_key_values = array_combine($answer_id, $answers_value);
			foreach ($td_key_values as $key => $value) {
				$answer = new Answer();
				$answer->answer_name = $value;
				$answer->save();

				$da = new DataAnswer();
				$da->data_id = $key;
				$da->answer_id = $answer->id;
				$da->relevamiento_id = $relevamiento->id;
				$da->save();
			}




			//===============================================================
			return view('relevamientos.posCreate', compact('toolData', 'pid', 'tid'));
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
		$relevamientoData = DB::table('relevamientos')
			->join('tools', 'relevamientos.tool_id', '=', 'tools.id')
			->join('tools_data', 'tools.id', '=', 'tools_data.tool_id')
			->join('data', 'tools_data.data_id', '=', 'data.id')
			->join('data_answers', 'data.id', '=', 'data_answers.data_id')
			->join('answers', 'data_answers.answer_id', '=', 'answers.id')
			->select('relevamientos.id as relevamiento_id', 'data.data_question', 'answers.id as answer_id', 'answers.answer_name')
			->where('data_answers.relevamiento_id', $relevamiento->id)
			->where('relevamientos.id', $relevamiento->id)
			->get();
		//dd($relevamientoData);

		$projects = DB::table('projects')
			->select('projects.id', 'projects.project_name')
			->get();
		$actualP = DB::table('projects')
			->select('projects.id', 'projects.project_name')
			->where('projects.id', $relevamiento->project_id)
			->get()->first();

		$tools = DB::table('tools')
			->select('tools.id', 'tools.tool_name')
			->where('tools.id', $relevamiento->tool_id)
			->get()->first();

		return view('relevamientos.edit', compact('relevamientoData', 'projects', 'tools', 'relevamiento', 'actualP'));
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
		if (!is_null($request->project_id) && strcmp($request->project_id, $relevamiento->project_id) != 0) {
			// echo "Hay que modificar ";
			$relevamiento->project_id = intval($request->project_id);
			$relevamiento->save();
		}
		// dd([$request->id, $relevamiento->project_id]);
		//Nuevo = request->id, Old = relevamiento_project_id

		try {
			//Agrupo las key,values a modificar =====================
			$answer_id = array();
			$answers_value = array();
			foreach ($request->all() as $key => $value) {
				if (str_contains($key, 'answer_id')) {
					array_push($answer_id, $value);
				} elseif (str_contains($key, 'answer_name')) {
					array_push($answers_value, $value);
				}
			}
			$td_key_values = array_combine($answer_id, $answers_value);
			//dd($td_key_values);
			//========================================================

			//updateo cada una de las respuestas que tiene el relevamiento. =========
			foreach ($td_key_values as $key => $value) {
				Answer::where('id', '=', $key)->update(['answer_name' => $value]);
			}

			return redirect()->route('relevamientos.index')->with('success', 'Relevamiento editaro correctamente!');
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
	 * @param  \App\Relevamiento  $relevamiento
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Relevamiento $relevamiento)
	{
		try {
			$answerIds = array();
			$relevamientos = DB::table('data_answers')
				->select('data_answers.id as DA_id', 'data_answers.answer_id as answer_id')
				->where('data_answers.relevamiento_id', $relevamiento->id)
				->get();

			foreach ($relevamientos as $r) {
				array_push($answerIds, $r->answer_id);
			}
			DataAnswer::where('relevamiento_id', '=', $relevamiento->id)->delete();
			Answer::whereIn('id', $answerIds)->delete();

			$p = Relevamiento::find($relevamiento->id);
			if ($p) {
				$p->delete();
			}

			return redirect()->route('relevamientos.index')->with('success', 'Relevamiento Eliminado correctamente!');
		} catch (Exception $e) {
			return [
				'value'  => [],
				'status' => 'error',
				'message'   => $e->getMessage()

			];
		}
	}
	public function aplanar($array)
	{
		// 0 => {#1289 ▼
		//     +"answer_name": "6"
		//     +"data_question": "Hombre"
		//   }
		//   1 => {#1290 ▼
		//     +"answer_name": "0"
		//     +"data_question": "Mujer"
		//   }
		// Me entra eso, y sale un array con las preguntas
		// array:2 [▼
		// 0 => "Hombre"
		// 1 => "Mujer"
		// ]
		$questions = array();
		foreach ($array as $value) {
			array_push($questions, $value->data_question);
		}
		//divido en grupos de n elementos
		//$aux = array_chunk($aux, $colCount);
		return $questions;
	}

	public function getRelevamientos()
	{
		try {
			$relevamiento = Relevamiento::all();
			return response()->json([
				'value'  => $relevamiento,
				'status' => 'success',
				'message' => 'Relevamientos Listed Successfully !!'
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
