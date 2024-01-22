<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCheck extends Model
{
    use HasFactory;

    protected $table = 'lms_users_check';
    protected $primaryKey = 'id';

    protected $fillable = ['video','one_day_apteka','user_id'];
}
