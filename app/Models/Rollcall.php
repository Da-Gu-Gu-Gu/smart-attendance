<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rollcall extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['tid','year','subject','major','lifetime','token','time'];
}
