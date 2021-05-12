<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         // Get all the departments
         $departments = Department::where([
             ['name', '!=', Null],
             [function ($query) use ($request) {
                 if ($request->search) {
                     $query->orWhere('name', 'LIKE', '%' . $request->search . '%')->get();
                 }
             }]
         ])
             ->orderBy('id', 'desc')->get();

         // Load the view and pass the countries
         return view('departments.index', compact('departments'))->with('search_term', $request->search);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
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
            'name' => 'required|string|max:60|unique:departments'
        ]);

        $department = Department::create([
            'name' => $request->name
        ]);

        return redirect('departments')->with('status', 'Department created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('departments.edit')->with('department', $department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:60'
        ]);

        $department->name = $request->name;
        $department->save();

        return redirect('departments')->with('status', 'Department updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect('departments')->with('status', 'Department deleted successfully!');
    }
}
