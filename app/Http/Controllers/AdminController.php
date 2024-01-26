<?php

namespace App\Http\Controllers;

use App\Models\AnswerCheck;
use App\Models\Course;
use App\Models\GroupTest;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Passed;
use App\Models\Raspisaniya;
use App\Models\RaspisaniyaUser;
use App\Models\User;
use App\Models\UserCheck;
use App\Models\Video;
use App\Models\Zumrad;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {

        return view('admin.index');
    }

    public function user()
    {
        $userID = auth()->user()->id;
        $user = auth()->user();

        $first_course = Course::where('status',0)->first();
        $first_module = Module::where('course_id',$first_course ? $first_course->id : null)->first();
        $first_lesson = Lesson::where('module_id', $first_module ? $first_module->id : null)->first();
        $first_group_test = GroupTest::where('lesson_id',$first_lesson ? $first_lesson->id : null)->first();
        $first_module_count = Module::where('course_id',$first_course ? $first_course->id : null)->count();

        $passed = Passed::where([
            'course_id'=>$first_course ? $first_course->id : null,
            'module_id'=>$first_module ? $first_module->id : null,
            'lesson_id'=>$first_lesson ? $first_lesson->id : null,
            'user_id'=>$userID,
            'pass_status'=>1
        ])->first();

        $natija_result = AnswerCheck::where(['user_id'=>$userID,'lesson_id'=>$first_lesson ? $first_lesson->id : null,'module_id'=>$first_module ? $first_module->id : null ,'course_id'=>$first_course ? $first_course->id : null])->orderBy('id','desc')->first();
//        return $passed;

        $user_check = UserCheck::where('user_id',$userID)->first();
        $course = Course::where('status',1)->get();

        $zumrad = Zumrad::where('user_id',$userID)->first();

        return view('user.index',compact('course','zumrad','passed','natija_result','user','user_check','first_group_test','first_course','first_module_count','first_lesson'));
    }

}
