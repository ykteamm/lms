<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnterLogout extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'lms_enter_exit';

    protected $fillable = ['user_id','login_time','logout_time'];
}
