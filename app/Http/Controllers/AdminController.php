<?php

namespace App\Http\Controllers;

use App\User;
use \Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function setAdmin(Request $request)
    {
        try {
            if ($request->val) { //true = lo subo de rango
                User::find($request->id)->update(['admin' => 1]);
            } else { // lo hago alumno, admin = 0
                User::find($request->id)->update(['admin' => 0]);
            }

            return response()->json([
                'value'  => [],
                'status' => 'success',
                'message' => 'Usuario modificado correctamente!!'
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->admin) {
            $users = User::all();
            return view('admin-panel.index', compact('users'));
        } else {
            return redirect()->route('projects.index')->withErrors('Solo docentes pueden acceder al panel!');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        $user = DB::table('users')
            ->where('users.id', $id)
            ->get()->first();

        //dd($user);
        return view('admin-panel.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request_params = $request->all();
        $rules = array(
            'name' => 'required',
            'email' => 'required',
        );

        $messages = [
            'name.required' => 'El nombre del usuario es requerido',
            'email.required' => 'El email del usuario es requerido',
        ];

        $validator = Validator::make($request_params, $rules, $messages);

        if ($validator->passes()) {

            try {
                $p = User::find($id);
                if ($p) {
                    $p->update($request->all());
                }
                return redirect()->route('admin-panel.index')->with('success', 'Usuario editado correctamente');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $p = User::find($id);
            if ($p) {
                $p->delete();
            }
            return redirect()->route('admin-panel.index')->with('success', 'Usuario eliminado correctamente');
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }
}
