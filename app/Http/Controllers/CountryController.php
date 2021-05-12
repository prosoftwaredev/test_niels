<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         // Get all the countries
         $countries = Country::where([
             ['name', '!=', Null],
             [function ($query) use ($request) {
                 if ($request->search) {
                     $query->orWhere('name', 'LIKE', '%' . $request->search . '%')->get();
                 }
             }]
         ])
             ->orderBy('id', 'desc')->get();

         // Load the view and pass the countries
         return view('countries.index', compact('countries'))->with('search_term', $request->search);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('countries.create');
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
            'name' => 'required|string|max:60|unique:countries',
            'country_code' => 'required|string|max:3|unique:countries'
        ]);

        $country = Country::create([
            'name' => $request->name,
            'country_code' => $request->country_code
        ]);

        return redirect('countries')->with('status', 'Country created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        // Load the view and pass the country
        return view('countries.edit')->with('country', $country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'country_code' => 'required|string|max:3'
        ]);

        $country->name = $request->name;
        $country->country_code = $request->country_code;
        $country->save();

        return redirect('countries')->with('status', 'Country updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return redirect('countries')->with('status', 'Country deleted successfully!');
    }
}
