<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;//change the date format
use App\Models\notification;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if(count(Auth::user()->getRoleNames()) <=1){
            abort(404);
        }else{

        $query = DB::table('appointments as a')
    ->leftJoin('doctors as d', 'a.doctor_id', '=', 'd.id')
    ->leftJoin('user_profiles as up', 'd.prof_id', '=', 'up.id')
    ->leftJoin('users as u', 'up.user_id', '=', 'u.id')
    ->leftJoin('departments as dep', 'd.dep_id', '=', 'dep.id')
    ->leftJoin('notifications as n', 'a.id', '=', 'n.bk_id')
    ->select(
        'a.id',
        'a.date',
        'a.time',
        'a.status',
        'a.description',
        'a.payment_mode',
        'd.id as doctor_id',
        'd.speciality',
        'up.id as user_id',
        'up.phno',
        'up.image',
        'dep.fee',
        'dep.name as department',
        'n.status as nstatus',
        'n.description as message',
        'u.name as username'
    );

if ($request->has('search')) {
    $query->where('a.id', 'like', '%' . $request->search . '%');
}

$appointments = $query->distinct()->get();
            if ($request->wantsJson()) {
                return response($appointments);
            }

                return view('booking.index', compact('appointments'));
    }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        $query = DB::table('appointments')
        ->leftJoin('doctors', 'appointments.doctor_id', '=', 'doctors.id')
        ->leftJoin('user_profiles', 'doctors.prof_id', '=', 'user_profiles.id')
        ->leftJoin('users', 'user_profiles.user_id', '=', 'users.id')
        ->leftJoin('departments', 'doctors.dep_id', '=', 'departments.id')
        ->select(
            'appointments.id ass',
            'appointments.date',
            'appointments.time',
            'appointments.status',
            'appointments.description',
            'appointments.payment_mode',
            'doctors.id as doctor_id',
            'doctors.speciality',
            'user_profiles.id as user_id',
            'user_profiles.phno',
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

        return view('booking.index', compact('appointments'));
    }

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
        $time = Carbon::createFromFormat('Y-m-d H:i:s', $request->time);
        $formattedDate = $time->format('Y F d H:i');
        $appointment = new appointment();
        $appointment->patient_id = auth()->user()->id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->payment_mode = $request->payment_mode;
        $appointment->description = $request->description;
        $appointment->date = $request->date;
        $appointment->time = $formattedDate;
        $appointment->confirmation = 0;
        $appointment->status = 0;
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
    public function show($id)
    {
        $appointment = appointment::find($id);
        $comments= notification::where('bk_id','=', $id)->paginate(10);
        return  view('booking.show', compact('appointment', 'comments'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {


        $appointment = appointment::find($id);

        if(!$appointment){
            return redirect()->route('booking.index')->with('error', 'Appointment not found');
        }
        // if(\request()->user()->id != $appointment->patient_id){
        //     return redirect()->route('booking.index')->with('error', 'You are not authorized to edit this appointment');
        // }
        if($request->wantsJson()){
            return response($appointment);
        }
        return view('booking.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, appointment $appointment)
    {

        $request->validate([
            'doctor_id' => 'required',
            'payment_mode' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required'

        ]);

        $appointment->patient_id = auth()->user()->id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->payment_mode = $request->payment_mode;
        $appointment->description = $request->description;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->confirmation = 0;
        $appointment->status = 0;
        $appointment->save();

        if ($appointment->save()) {
            return redirect()->route('booking.index')->with('success', 'Appointment updated successfully');
        } else {
            return redirect()->route('booking.index')->with('error', 'Error in updating appointment');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(appointment $appointment)
    {
        //
    }
}
