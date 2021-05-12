<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         // Get all the cities
         $cities = City::where([
             ['name', '!=', Null],
             [function ($query) use ($request) {
                 if ($request->search) {
                     $query->orWhere('name', 'LIKE', '%' . $request->search . '%')->get();
                 }
             }]
         ])
             ->orderBy('id', 'desc')->get();

         // Load the view and pass the cities
         return view('cities.index', compact('cities'))->with('search_term', $request->search);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return view('cities.create')->with('states', $states);
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
            'name' => 'required|string|max:60|unique:cities',
            'state_id' => 'required'
        ]);

        $city = City::create([
            'name' => $request->name,
            'state_id' => $request->state_id
        ]);

        return redirect('cities')->with('status', 'City created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        // Load the view and pass the city
        $states = State::all();
        return view('cities.edit', compact('states'))->with('city', $city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'state_id' => 'required'
        ]);

        $city->name = $request->name;
        $city->state_id = $request->state_id;
        $city->save();

        return redirect('cities')->with('status', 'City updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        return redirect('cities')->with('status', 'City deleted successfully!');
    }
}
