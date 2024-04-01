<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model
{
    use Notifiable;
    use HasRoles;
    use HasFactory;

    protected $fillable = [
        'prof_id',
        'dep_id',
        'speciality',
        'experience',
        'qualification',
        'status',
    ];

    protected $table = 'doctors';

    public function scopeWithAppointment($query)
    {
        // get user appointments
        // select from appointment where doctor id is join department
        //select I want patient details and appointment where doctor id is
        //
        return $query
        ->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'users.id')
->leftJoin('doctors', 'user_profiles.id', '=', 'doctors.prof_id')
->leftJoin('appointments', 'doctors.id', '=', 'appointments.doctor_id')
->select(
    'appointments.time',
    'appointments.patient_id as patient_id',
    'appointments.description',
    'appointments.id as appointment_id',
    'appointments.status',
    'appointments.confirmation',
    'user_profiles.phno as phone_number',
    'user_profiles.blg as blood_group',
    'user_profiles.address',
    'user_profiles.gender',
    'users.name as patient_name'
);
}

}
