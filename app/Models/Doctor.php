<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DepartmentModel;
use App\Models\UserProfile;
use APP\Models\User;
use Illuminate\Database\Eloquent\Relations\hasOne;
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

    public function department()
    {
        return $this->belongsTo(DepartmentModel::class, 'dep_id');
    }

    public function profile(){
        return $this->belongsTo(UserProfile::class, 'prof_id');
    }



    public function users()
    {
        return $this->hasOne(User::class, 'user_id', 'id')
            ->select('user.id', 'user.name as username', 'user_profiles.id as profile_id', 'user_profiles.phno');
    }


    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
}
