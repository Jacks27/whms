<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentModel;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index()
    {
        $docs = DB::table('doctors')
        ->leftJoin('user_profiles', 'doctors.prof_id', '=', 'user_profiles.id')
        ->leftJoin('users', 'user_profiles.user_id', '=', 'users.id')
        ->leftJoin('departments', 'doctors.dep_id', '=', 'departments.id')
        ->select(
            'speciality',
            'experience',
            'qualification',
            'status',
            'departments.name as department',
            'doctors.id',
            'user_profiles.id as user_id',
            'user_profiles.phno',
            'user_profiles.address',
            'user_profiles.image',
            'user_profiles.county',
            'user_profiles.city',
            'users.name as username'
        )->get();


        return view('doc.index')->with('docs', $docs);
    }
    public function create()
    {
        $docs = DB::table('user_profiles')
        ->leftJoin('users', 'user_profiles.user_id', '=', 'users.id')
        ->select(
            'user_profiles.id',
            'users.name as username',
        )->get();
        $department = DepartmentModel::getAll();
        $deprtmnt = $department->pluck('name', 'id');
        $deprt = $deprtmnt->all();

        return view('doc.create')->with('docs', $docs)->with('deprt', $deprt);
    }
    public function store(Request $request)
    {
        $request->validate([
            'prof_id' => 'required|integer|unique:doctors',
            'dep_id' => 'required|integer',
            'speciality' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);
        $pro=Doctor::create([
            'prof_id' => $request->prof_id,
            'dep_id' => $request->dep_id,
            'speciality' => $request->speciality,
            'experience' => $request->experience,
            'qualification' => $request->qualification,
            'status' => $request->status,
        ]);
        if ($pro->save()) {
            return redirect()->route('doctor.index')->with('success', 'Doctor created successfully');
        }else{
            return redirect()->route('doctor.create')->with('error', 'Error in creating doctor');
        }

    }
    public function show($id)
    {
        return view('doctor.show');
    }
    public function edit($id)
    {
        return view('doc.edit');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:doctors,name,' . $id,
            'department_id' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:doctors,email,' . $id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255'
        ]);
        return redirect()->route('doctor.index');
    }
    public function destroy($id)
    {
        return redirect()->route('doctor.index');
    }


}
