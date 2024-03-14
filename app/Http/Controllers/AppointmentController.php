<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = DB::table('appointments')
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
                'appointments.payment',
                'doctors.id as doctor_id',
                'doctors.speciality',
                'user_profiles.id as user_id',
                'user_profiles.phno',
                'user_profiles.image',
                'departments.fee as fee',
                'departments.name as department',
                'users.name as username'
            )->get();


        return view('booking.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('booking.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'payment_mode' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required'

        ]);

        $appointment = new appointment();
        $appointment->patient_id = auth()->user()->id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->payment_mode = $request->payment_mode;
        $appointment->description = $request->description;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->status = 0;
        $appointment->payment_status = 'pending';
        $appointment->prescription = '';
        $appointment->report = '';
        $appointment->payment = 0;
        $appointment->save();

        if ($appointment->save()) {
            return redirect()->route('booking.create')->with('success', 'Appointment created successfully');
        } else {
            return redirect()->route('booking.create')->with('error', 'Error in creating appointment');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(appointment $appointment)
    {
        //
    }
}
