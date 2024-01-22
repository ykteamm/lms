<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'lms_courses';
    protected $primaryKey = 'id';

    protected $fillable =['title','image'];

}
