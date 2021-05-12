<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employment;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Department;

class EmploymentController extends Controller
{
    public function index(Request $request)
    {
        $employments = Employment::where([
            ['address', '!=', Null],
            [function ($query) use ($request) {
                if ($request->search) {
                    $query->orWhere('firstname', 'LIKE', '%' . $request->search . '%');
                    $query->orWhere('lastname', 'LIKE', '%' . $request->search . '%');
                }
            }]
        ])
        ->orWhereHas('department', function ($query) use ($request) {
            if ($request->search) {
                $query->Where('name', 'LIKE', '%' . $request->search . '%');
            }
        })
            ->orderBy('id', 'desc')->get()->toArray();
        return array_reverse($employments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'middle_name' => 'string|max:60',
            'address' => 'required|string|max:120',
            'department_id' => 'required|int',
            'country_id' => 'required|int',
            'state_id' => 'required|int',
            'city_id' => 'required|int',
            'zip' => 'required|string|max:10'
        ]);

        $employment = Employment::create($request->all());

        return response()->json([
            "status" => "SUCCESS",
            "message" => 'Employment created successfully!'
        ]);
    }

    public function show($id)
    {
        $employment = Employment::find($id);
        return response()->json($employment);
    }

    public function update($id, Request $request)
    {
        $employment = Employment::find($id);
        $employment->update($request->all());

        return response()->json([
            "status" => "SUCCESS",
            "message" => 'Employment updated successfully!'
        ]);
    }

    public function destroy($id)
    {
        $employment = Employment::find($id);
        $employment->delete();

        return response()->json([
            "status" => "SUCCESS",
            "message" => 'Employment deleted successfully!'
        ]);
    }

    public function GetUtilsData()
    {
        $countries = Country::all()->toArray();
        $states = State::all()->toArray();
        $cities = City::all()->toArray();
        $departments = Department::all()->toArray();

        return [
            'countries'=> $countries,
            'states'=> $states,
            'cities'=> $cities,
            'departments'=> $departments
        ];
    }
}
