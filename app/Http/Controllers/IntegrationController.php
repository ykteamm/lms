<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Passed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IntegrationController extends Controller
{
    public function index()
    {
        $user = User::where('rol_id','user')->get();
        $course = Course::where('status',0)->first();
        $passed = Passed::where('course_id',$course->id)->get();
        return view('admin.menu.integration.index',compact('user','passed'));
    }

    public function jang($id)
    {
     $user = User::where('id',$id)->first();

     $first_name = $user->first_name;
     $last_name = $user->last_name;
     $username = $user->username;
     $phone = $user->phone;
     $password = $user->username;

     $all = $first_name ."".$last_name."".$username."".$phone."".$password;
//     return $all;
        Http::post('http://127.0.0.1:8001/test', [
            'first_name' => $first_name,
            'last_name'=>$last_name,
            'username'=>$username,
            'phone'=>$phone,
            'password'=>$username
        ]);

        return redirect()->back();
    }
}
