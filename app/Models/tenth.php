<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tenth extends Model
{
    use HasFactory;
    public $tablename='10th';
    public $fillable = ['Question','a','b','c','d','ans'];
}
