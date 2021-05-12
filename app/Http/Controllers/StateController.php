<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get all the states
        $states = State::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if ($request->search) {
                    $query->orWhere('name', 'LIKE', '%' . $request->search . '%')->get();
                }
            }]
        ])
            ->orderBy('id', 'desc')->get();

        // Load the view and pass the states
        return view('states.index', compact('states'))->with('search_term', $request->search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('states.create')->with('countries', $countries);
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
            'name' => 'required|string|max:60|unique:states',
            'country_id' => 'required'
        ]);

        $state = State::create([
            'name' => $request->name,
            'country_id' => $request->country_id
        ]);

        return redirect('states')->with('status', 'State created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        // Load the view and pass the state
        $countries = Country::all();
        return view('states.edit', compact('countries'))->with('state', $state);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'country_id' => 'required'
        ]);

        $state->name = $request->name;
        $state->country_id = $request->country_id;
        $state->save();

        return redirect('states')->with('status', 'State updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();

        return redirect('states')->with('status', 'State deleted successfully!');
    }
}
