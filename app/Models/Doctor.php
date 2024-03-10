<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DepartmentModel;
use APP\Models\User;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Doctor extends Model
{
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
    public function department()
    {
        return $this->belongsTo(DepartmentModel::class, 'dep_id');
    }

    public function profile(){
        return $this->belongsTo(UserProfile::class, 'prof_id');
    }

    // user relationship id

    //profile user_id
    // department_id
    // department id



public function users(): HasManyThrough
{
    return $this->hasManyThrough(User::class, UserProfile::class, 'user_id', 'id', 'id', 'user_id')
    ->select(
        'users.id',
        'users.name as username',
        'user_profiles.id',
        'user_profiles.phno'
    );


}


    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
}
