<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTest extends Model
{
    use HasFactory;
    protected $table = 'lms_group_tests';
    protected $primaryKey = 'id';

    protected $casts = [
        'test_json' => 'array',
    ];
    protected $fillable =['test_json','ball','limit','level','lesson_id'];



}
