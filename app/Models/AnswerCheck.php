<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerCheck extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'lms_answer_check';
    protected $fillable = ['user_id','course_id','module_id','lesson_id','question_ids','user_answers','correct_answer','question_numbers','foiz'];

    protected $casts = [
        'question_ids' => 'array',
        'user_answers' => 'array',
    ];


}
