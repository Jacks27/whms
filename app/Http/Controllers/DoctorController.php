<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentModel;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
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
            'doctors.id as docid',
            'user_profiles.id as profile_id',
            'user_profiles.phno',
            'user_profiles.address',
            'user_profiles.image',
            'user_profiles.county',
            'user_profiles.city',
            'users.id as user_id',
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
            'users.id as profileid'
        )->get();
        $department = DepartmentModel::getAll();
        $deprtmnt = $department->pluck('name', 'id');
        $deprt = $deprtmnt->all();
        $rolenames = Role::all();

        return view('doc.create')->with('docs', $docs)->with('deprt', $deprt)->with('roles',$rolenames);
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
        $doc = User::select('id', 'name', 'email')
            ->where('id', $id)
            ->first();
            $roles=$doc->getRoleNames();
            $rolenames = Role::all()->pluck('name');
        return view('doc.show', compact('doc', 'roles', 'rolenames'));
    }
    public function edit($id)
    {

        $deprt = DepartmentModel::getAll();
        $deprtmnt = $deprt->pluck('name', 'id');
        $departments = $deprtmnt->all();
        $doctor = Doctor::where('id', $id)->first();


        return view('doc.edit' )->with('departments', $departments)->with('doctor', $doctor);
    }

    public function update(Request $request,Doctor $doctor)
    {
        $request->validate([
            'prof_id' => 'required|integer',
            'dep_id' => 'required|integer',
            'speciality' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);
        $doctor->update(
            [
                'prof_id' => $request->prof_id,
                'dep_id' => $request->dep_id,
                'speciality' => $request->speciality,
                'experience' => $request->experience,
                'qualification' => $request->qualification,
                'status' => $request->status,
            ]
        );
        return redirect()->route('doctor.index')->with('success', 'Doctor updated successfully');
    }
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctor.index')->with('success', 'Profile  deleted successfully');

    }


}
