<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignmentanswer extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['to','sender','subject','detail','attachment','date','token'];
}
