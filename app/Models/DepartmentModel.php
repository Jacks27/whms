<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'fee',
        'head',
    ];
    protected $table = 'departments';

    public static function getAll() {
        return self::all();
    }



}
