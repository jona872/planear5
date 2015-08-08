<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Event;
use DB;
use Auth;
use Session;
use Redirect;
use App\User;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {//busca todos los eventos del usuario logeado ( por id )
        $id = Auth::user()->id ; 
        $event = DB::select('SELECT * FROM `event` WHERE `event_owner` = '.$id.' ;');
        return view('event.index',['event'=>$event]);

        

        // $event = Event::all();
        // return view('event.index',compact('event'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $event = new Event;
        $event->event_name = $request->event_name;
        $event->event_desc = $request->event_desc;
        $event->event_owner = Auth::user()->id;
        $event->event_loca = $request->event_loca;
        $event->event_type = $request->event_type;
        $event->event_priv = $request->event_priv;        
        
        $event->save();
        //echo $request->nomevent;//esto ya me da el id que necesito para hacer una fk         
        return redirect('/event')->with('message','Se agrego un nuevo event correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {   
        $event = Event::find($id);
        return view('event.show', ['event'=>$event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('event.edit',['event'=>$event]);
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
        $event = Event::find($id);
        $event->fill($request->all());
        $event->save();

        Session::flash('message','event editado correctamente');
        return Redirect::to('/event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Event::destroy($id);
        Session::flash('message','event eliminado correctamente');
        return Redirect::to('event');
    }
}
