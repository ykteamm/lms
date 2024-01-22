<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'lms_module';
    protected $fillable = ['title','course_id'];
}
