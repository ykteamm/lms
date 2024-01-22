<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raspisaniya extends Model
{
    use HasFactory;
    protected $table = 'lms_raspisaniya';
    protected $primaryKey = 'id';
    protected $fillable = ['title','lesson_id','day'];
    protected $casts = [
        'lesson_id' => 'array',
    ];
}
