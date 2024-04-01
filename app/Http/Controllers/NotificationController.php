<?php

namespace App\Http\Controllers;

use App\Models\notification;
use Illuminate\Http\Request;
use App\Models\appointment;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // select notifiction based on the current sesionn


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bk_id' => 'required|integer',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $appointment= appointment::find($request->bk_id);
        $appointment->confirmation = 1;
        $appointment->status = 1;
    if ($request->status == 'pedding' || $request->status == 'rejected') {
    // Update values based on condition
    $appointment->confirmation = 0;
    }


        $nt=notification::create([
            'bk_id' => $request->bk_id,
            'description' => $request->description,
            'doctor_id'=> auth()->user()->id,
            'status' => $request->status,
        ]);



        if ($nt->save() && $appointment->save() ) {
            return redirect()->route('booking.index')->with('success', 'Appointment updated successfully');
        }else{
            return redirect()->route('booking.create')->with('error', 'Error there was an error updating the appointment');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(notifications $notification)
    {
        dd($nofications);
       return view('notification.show', compact('notifications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(notification $notification)
    {
        //
    }
}
