<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LmsOraliqTest extends Model
{
    use HasFactory;
    protected $table = 'lms_oraliq_test';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','question_ids','user_answers','correct_answer','question_numbers','ball','success'];

    protected $casts = [
        'question_ids' => 'array',
        'user_answers' => 'array',
    ];
}
