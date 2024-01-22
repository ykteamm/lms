<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = 'lms_videos';
    protected $primaryKey = 'id';

    protected $fillable = ['url','content','image','lesson_id'];

}
