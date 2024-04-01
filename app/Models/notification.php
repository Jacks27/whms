<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'bk_id',
        'doctor_id',
        'description',
        'status'
    ];
    protected $table = 'notifications';
}
