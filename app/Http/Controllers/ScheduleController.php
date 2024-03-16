<?php

namespace App\Http\Controllers;

use App\Models\scheduled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('appointments')
            ->leftJoin('doctors', 'appointments.doctor_id', '=', 'doctors.id')
            ->leftJoin('user_profiles', 'doctors.prof_id', '=', 'user_profiles.id')
            ->leftJoin('users', 'user_profiles.user_id', '=', 'users.id')
            ->leftJoin('departments', 'doctors.dep_id', '=', 'departments.id')
            ->select(
                'appointments.id',
                'appointments.date',
                'appointments.time',
                'appointments.status',
                'appointments.description',
                'appointments.payment_mode',
                'doctors.id as doctor_id',
                'doctors.speciality',
                'user_profiles.id as user_id',
                'user_profiles.phno',
                'user_profiles.image',
                'departments.fee as fee',
                'departments.name as department',
                'users.name as username'
            );
            if ($request->has('search')) {
                $query->where('appointments.id', 'like', '%' . $request->search . '%');
            }

            $appointments = $query->get();

            if ($request->wantsJson()) {
                return response($appointments);
            }

        return view('schedule.index')->with('appointments', $appointments);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(scheduled $scheduled)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(scheduled $scheduled)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, scheduled $scheduled)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(scheduled $scheduled)
    {
        //
    }
}
