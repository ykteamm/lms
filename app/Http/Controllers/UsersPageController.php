<?php

namespace App\Http\Controllers;

use App\Models\AnswerCheck;
use App\Models\GroupTest;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Passed;
use App\Models\Test;
use App\Models\Video;
use App\Models\Zumrad;
use Illuminate\Http\Request;

class UsersPageController extends Controller
{
    public function index($course_id)
    {
        $userID = auth()->user()->id;
        $module = Module::where('course_id',$course_id)->orderBy('id','asc')->get();

        $zumrad = Zumrad::where('user_id',$userID)->first();

        return view('user.menu.module',compact('module','course_id','userID','zumrad'));
    }

    public function lesson($module_id)
    {
        $userID = auth()->user()->id;
        $course = Module::where('id',$module_id)->first();
        $lessons = Lesson::where('module_id',$module_id)->orderBy('id','asc')->get();


        $zumrad = Zumrad::where('user_id',$userID)->first();
//        return $lessons;
        return view('user.menu.lesson',compact('lessons','course','module_id','userID','zumrad'));
    }

    public function LessonShow($lesson_id)
    {

        $user_id = auth()->user()->id;

        $group_test = GroupTest::where('lesson_id',$lesson_id)->first();
        $test_count = Test::where('lesson_id',$lesson_id)->count();

        $passed = Passed::where(['lesson_id'=>$lesson_id,'user_id'=>$user_id])->first();
        $result = AnswerCheck::where(['user_id'=>$user_id,'lesson_id'=>$lesson_id])->get();

        $natija_pass = Passed::where(['lesson_id'=>$lesson_id,'user_id'=>$user_id])->orderBy('id','desc')->first();
        $natija_result = AnswerCheck::where(['user_id'=>$user_id,'lesson_id'=>$lesson_id])->orderBy('id','desc')->first();

        $lesson = Lesson::where('id',$lesson_id)->first();
        $video_lesson = Video::where('lesson_id',$lesson_id)->first();

        $zumrad = Zumrad::where('user_id',$user_id)->first();

        return view('user.menu.lesson-show',compact('video_lesson','zumrad','lesson','group_test','test_count','passed','result','natija_pass','natija_result','user_id'));
    }

    public function LessonTest($lesson_id)
    {
        $lesson = Lesson::where('id',$lesson_id)->first();
        $course_id =Module::where('id',$lesson->module_id)->first();
        $group_test = GroupTest::where('lesson_id',$lesson_id)->first();
        $tests = Test::where('lesson_id',$lesson_id)->orderBy('id','asc')->get();

        return view('user.menu.lesson-test',compact('tests','group_test','lesson','course_id'));
    }
}
