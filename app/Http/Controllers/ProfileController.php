<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Profile;
use View;//solo para completar el select
use DB;
use Auth;
use Session;
use Redirect;
use App\User;
use HTML;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {  
        // $id = Auth::user()->id;
        // $profile = DB::select('SELECT * FROM `users` WHERE `id` = '.$id.' ;');
        // return view('profile.index',['profile'=>$profile]);

        $id = Auth::user()->id;
        $profile = User::where('id', $id)->get();
        /*foreach ($users as $user) {
            echo $user->us_name;
        }*/
        return view('profile.index',['profile'=>$profile]);
    }
    public function dameMasa()
    {

        $id = Auth::user()->id;
        $profile = DB::select('SELECT * FROM `users` WHERE `id` = '.$id.' ;');
        return view('profile.index',['profile'=>$profile]);
    }

    public function user()
    {
        return $this->belongs_to('User');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       // $id = Auth::user()->id;
        //$profile = User::where('id', $id)->get();
        
        //usando with
        //$profile = Profile::find($id);
        //return view('profile.edit')->with('profile', $profile);



        $profile = User::find($id);
        return view('profile.edit')->with('profile',$profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $profile = User::find($id);
        $profile->fill($request->all());
        $profile->save();

        Session::flash('message','profile editado correctamente');
        return Redirect::to('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
