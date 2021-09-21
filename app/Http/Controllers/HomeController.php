<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function test()
    {
        try {
            $dogs = DB::table('projects')
                ->select('projects.id','projects.nombre as project_name','projects.latitud','projects.longitud','cities.nombre as city_name','users.name' )
                ->join('users', 'projects.user_id', '=', 'users.id')
                ->join('cities', 'projects.city_id', '=', 'cities.id')
                ->get();
            // dd($dogs);                
            // $projects = Project::orderBy('id', 'desc')->get();
            // dd($projects);
            return View::make('projects.index', compact('dogs'));
        } catch (Throwable $e) {
            report($e);
            //dd($e->errorInfo);
            return view('projects.index')->with('errors', $e);
            // return false;
        }
    }
}
