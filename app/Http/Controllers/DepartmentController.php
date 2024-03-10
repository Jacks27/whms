<?php

namespace App\Http\Controllers;

use App\Models\DepartmentModel;
use App\Models\Doctor;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest, DepartmentUpdateRequest;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->wantsJson()) {
            return response(
                DepartmentModel::all()
            );
        }
        $department = DepartmentModel::latest()->paginate(10);


        return view('depart.index')->with('department', $department);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('depart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $department = new DepartmentModel();
        $department->name = $request->name;
        $department->description = $request->description;
        $department->fee = $request->fee;
        $department->head = $request->head;
        $department->save();

        if ($department->save()) {
            return redirect()->route('department.index')->with('success', 'Department created successfully');
        }else{
            return redirect()->route('department.create')->with('error', 'Error in creating department');
        }
        return redirect()->route('depart.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // get doctor by department

        $doctors = Doctor::whereHas('department', function ($query) use ($id) {
            $query->where('id', $id);
        })->with('users')->get();
        $department = DepartmentModel::find($id);

        if (request()->wantsJson()) {
            return response(
                $doctors
            );
        }
        // This code retrieves all doctors associated with the given department ID ($departmentModel->id) and eager loads the users relationship for each doctor

        return view('depart.show')->with('doctors', $doctors)->with('department', $department);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DepartmentModel $department)
    {

        return view('depart.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentUpdateRequest $request, DepartmentModel $departmentModel)
    {
        //
        $departmentModel->update($request->all());
        return redirect()->route('depart.index')->with('success', 'Department updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepartmentModel $departmentModel)
    {
        //
        $departmentModel->delete();
        return redirect()->route('depart.index')->with('success', 'Department deleted successfully');
    }
}
