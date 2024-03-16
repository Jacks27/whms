<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class scheduled extends Model
{
    use HasFactory;
    protected $table = 'schedules';
    protected $fillable = [
        'doctor_id',
        'date',
        'start_time',
        'end_time',
        'status',
    ];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
    public function getDoctorNameAttribute()
    {
        return $this->doctor->user->name;
    }
    public function getDoctorSpecialityAttribute()
    {
        return $this->doctor->speciality;
    }
    public function getDoctorImageAttribute()
    {
        return $this->doctor->user->profile->image;
    }
}
