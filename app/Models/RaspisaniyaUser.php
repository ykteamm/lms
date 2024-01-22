<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaspisaniyaUser extends Model
{
    use HasFactory;
    protected $table = 'lms_raspisaniya_user';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','begin','end','lesson_id'];
}
