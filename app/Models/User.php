<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */
    protected $primaryKey = 'id';
    protected $table = 'lms_users';
    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'region_id',
        'district_id',
        'phone',
        'image',
        'passport_image',
        'status',
        'rol_id',
        'username',
        'password',
        'date_joined',
        'date_register',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
//        'password' => 'hashed',
    ];


//    public static function date_joined($datetime){
//        $datetime['date_joined'] = now();
//        $datetime['date_register'] = now();
//        return self::create($datetime);
//    }
}
