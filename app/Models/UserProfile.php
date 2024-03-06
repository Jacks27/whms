<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'phno',
        'address',
        'image',
        'user_id',
        'blg',
        'gender',
        'dob',
        'city',
        'county',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
