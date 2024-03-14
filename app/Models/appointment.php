<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class appointment extends Model
{
    use HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
    protected $table = 'appointments';
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'date',
        'status',
        'payment_mode',
        'description',
        'prescription',
        'report',
        'payment',
        'time',
        'payment_status'
    ];
    public function doctor():HasManyThrough
    {
        return $this->hasManyThrough(Doctor::class, User::class, 'doctor_id', 'id', 'id', 'user_id')
        ->select(
            'users.name as username',
            'doctors.id',
            'doctors.speciality'
        );
    }

    public function patient():HasManyThrough
    {
        return $this->hasManyThrough(UserProfile::class, User::class, 'id', 'id', 'patient_id', 'user_id');

    }
}
