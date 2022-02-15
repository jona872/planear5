<?php

namespace App\Http\Controllers;

use App\City;
use Exception;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function getCities(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $cities = City::orderby('city_name', 'asc')->select('id', 'city_name')->limit(5)->get();
        } else {
            $cities = City::orderby('city_name', 'asc')->select('id', 'city_name')
                ->where('city_name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($cities as $city) {
            $response[] = array("value" => $city->id, "label" => $city->city_name);
        }

        return response()->json($response);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $values = City::all();
            return response()->json([
                'value'  => $values,
                'status' => 'success',
                'message' => 'Provinces Listed Successfully !!',
                'mensaje' => 'city controller'
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
