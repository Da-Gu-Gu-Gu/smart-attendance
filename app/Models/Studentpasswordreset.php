<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentpasswordreset extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['rollno','token','create_at'];
}
