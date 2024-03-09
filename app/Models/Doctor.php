<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
