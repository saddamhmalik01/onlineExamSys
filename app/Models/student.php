<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'email',
        'password',
        'rollno',
        'father_name',
        'class',
    ];
}
