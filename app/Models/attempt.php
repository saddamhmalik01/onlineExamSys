<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attempt extends Model
{
    use HasFactory;
    public $tablename = 'attempts';
    public $fillable = [
        'student_id',
        'attempts'
    ];

}
