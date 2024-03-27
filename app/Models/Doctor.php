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

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }
    public function department()
    {
        return $this->belongsTo(DepartmentModel::class, 'dep_id');
    }


    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
}
