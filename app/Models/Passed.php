<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passed extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'lms_passed';
    protected $fillable = ['user_id','answer_check_id','course_id','module_id','lesson_id','pass_status','limit','limit_number'];
    protected $casts = [
        'answer_check_id' => 'array',
    ];
}
