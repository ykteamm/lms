<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = 'lms_tests';
    protected $primaryKey = 'id';

    protected $fillable = ['title','variant_a','variant_b','variant_c','variant_d','answer','lesson_id'];


}
