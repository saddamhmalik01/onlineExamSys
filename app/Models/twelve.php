<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class twelve extends Model
{
    use HasFactory;
    public $tablename='12th';
    public $fillable = ['Question','a','b','c','d','ans'];

}
