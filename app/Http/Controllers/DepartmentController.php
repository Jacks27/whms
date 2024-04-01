<?php

namespace App\Http\Controllers;

use App\Models\DepartmentModel;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {

         $this->middleware('role_or_permission:Super-Admin|department.edit', ['only' => ['edit','update']]);
         $this->middleware('role_or_permission:Super-Admin|department.delete', ['only' => ['destroy']]);
    }
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
        return redirect()->route('departany.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // get doctor by department
        $docs = Doctor::leftJoin('user_profiles', 'doctors.prof_id', '=', 'user_profiles.id')
    ->leftJoin('users', 'user_profiles.user_id', '=', 'users.id')
    ->leftJoin('departments', 'doctors.dep_id', '=', 'departments.id')
    ->select(
        'doctors.speciality',
        'doctors.experience',
        'doctors.qualification',
        'doctors.status',
        'departments.name as department',
        'doctors.id as docid',
        'user_profiles.id as profile_id',
        'user_profiles.phno',
        'users.id as user_id',
        'users.name as username'
    )
    ->where('doctors.dep_id', $id)
    ->get();

        $department = DepartmentModel::find($id);

        if (request()->wantsJson()) {
            return response(
                $docs
            );
        }
        // This code retrieves all doctors associated with the given department ID ($departmentModel->id) and eager loads the users relationship for each doctor
        return view('depart.show')->with('doctors', $docs)->with('department', $department);
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
    public function update(DepartmentUpdateRequest $request,$id)
    {
        $updt= DepartmentModel::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'fee' => $request->fee,
            'head' => $request->head
        ]);
        if ($updt) {
            return redirect()->route('department.index')->with('success', 'Department updated successfully');
        } else {
            return redirect()->back()->with('error', 'Error in updating department');
        }
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
