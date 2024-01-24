<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zumrad extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'lms_zumrad';
    protected $fillable = ['user_id','passed_id','zumrad'];
    protected $casts = [
        'passed_id' => 'array',
    ];
}
