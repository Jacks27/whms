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

        public function scopeWithAppointment($id, $includeUserProfile = true)
{
    $query = DB::table('appointments')
        ->leftJoin('users', 'appointments.patient_id', '=', 'users.id')
        ->select(
            'appointments.id as appointment_id',
            'appointments.date',
            'appointments.time',
            'appointments.payment_mode',
            'appointments.status',
            'appointments.description',
            'appointments.confirmation',
            'appointments.updated_at'
        )
        ->where('appointments.doctor_id', $id);

    if ($includeUserProfile) {
        $query->leftJoin('user_profiles', 'users.id', '=', 'user_profiles.user_id')
            ->selectRaw(
                'users.name as patient_name,
                user_profiles.dob as patient_date_of_birth,
                user_profiles.gender as patient_gender,
                user_profiles.blg as patient_blood_group,
                user_profiles.county as patient_county,
                user_profiles.city as patient_city'
            );
    }

    return $query->paginate(10);
}

public function get_confirmed_doctor_appoinrments($id, $bool){
// get appointment join doctor table
//
}
public function get_doctor($id){
    $userProfile = DB::table('user_profiles')
    ->leftJoin('users', 'user_profiles.user_id', '=', 'users.id')
    ->leftJoin('doctors', 'user_profiles.id', '=', 'doctors.prof_id')
    ->select(
        'doctors.id',
        'doctors.status',
        'users.name as username',
        'users.created_at'
    )->where('users.id', $id)->first();
}
}
