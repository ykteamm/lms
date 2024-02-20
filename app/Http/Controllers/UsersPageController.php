<?php

namespace App\Http\Controllers;

use App\Models\AnswerCheck;
use App\Models\GroupTest;
use App\Models\Lesson;
use App\Models\LmsOraliqTest;
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
        $zumrad = Zumrad::where('user_id',$userID)->first();

        $module_status = [];
        $lessons = [];
        if ($course->status == 1){
            $lesson_status = Lesson::where('module_id',$module_id)->get();
            $module_status = $lesson_status;
        }else{
            $lessons = Lesson::where('module_id',$module_id)->orderBy('id','asc')->get();
        }

//        return $module_status;

//        $module = Module::where('status',1)->get();
//        $status_lesson = Lesson::whereIn('module_id');
//        return $lessons;
        return view('user.menu.lesson',compact('lessons','course','module_id','userID','zumrad','module_status'));
    }

    public function LessonShow($lesson_id)
    {

        $user_id = auth()->user()->id;

        $group_test = GroupTest::where('lesson_id',$lesson_id)->first();
//        if ($group_test){
//            return $group_test;
//        }else{
//            $a = 'yomon';
//            return $a;
//        }
        $test = Test::where('lesson_id',$lesson_id)->get();
//        if ($test->isEmpty()) {
//            $a = 'yomon';
//            return $a;
//        }
//        return $test;
        $test_count = Test::where('lesson_id',$lesson_id)->count();

        $passed = Passed::where(['lesson_id'=>$lesson_id,'user_id'=>$user_id])->first();
        $result = AnswerCheck::where(['user_id'=>$user_id,'lesson_id'=>$lesson_id])->get();

        $natija_pass = Passed::where(['lesson_id'=>$lesson_id,'user_id'=>$user_id])->orderBy('id','desc')->first();
        $natija_result = AnswerCheck::where(['user_id'=>$user_id,'lesson_id'=>$lesson_id])->orderBy('id','desc')->first();

        $lesson = Lesson::where('id',$lesson_id)->first();
        $video_lesson = Video::where('lesson_id',$lesson_id)->first();

        $zumrad = Zumrad::where('user_id',$user_id)->first();



        return view('user.menu.lesson-show',compact('video_lesson','test','zumrad','lesson','group_test','test_count','passed','result','natija_pass','natija_result','user_id'));
    }

    public function LessonTest($lesson_id)
    {
        $lesson = Lesson::where('id',$lesson_id)->first();
        $course_id =Module::where('id',$lesson->module_id)->first();
        $group_test = GroupTest::where('lesson_id',$lesson_id)->first();
        $tests = Test::where('lesson_id',$lesson_id)->orderBy('id','asc')->get();

        return view('user.menu.lesson-test',compact('tests','group_test','lesson','course_id'));
    }

    public function OraliqTest()
    {
        $user_id = auth()->user()->id;
//        return $user_id;
        $passed = Passed::where('user_id',$user_id)->get();
        $lesson_ids = $passed->pluck('lesson_id');
//        $tests = Test::whereIn('lesson_id',$lesson_ids)->get();
        $tests = Test::whereIn('lesson_id', $lesson_ids)->inRandomOrder()->limit(20)->get();

        $count = $tests->count();

//        return $count;

//        return $tests;
//        return $lesson_ids;
        return view('user.menu.oraliq-test',compact('tests','user_id','count'));
    }

    public function OraliqCheck(Request $request)
    {
        $user_id = $request->user_id;
        $question_ids = $request->question_ids;
        $question_number = $request->count;
        $answer = $request->answers;

        $success = 90;

        $totalScore = 0;
        foreach ($question_ids as $questionId) {
            $correctAnswer = Test::find($questionId)->answer; // Test modelida "answer" haqiqiy savol javobi ustida
            // Agar berilgan javoblar va haqiqiy javob bir xil bo'lsa, 1 qo'shib sanab boramiz, aks holda 0 qo'shib sanab boramiz
            $totalScore += ($answer[$questionId][0] == $correctAnswer) ? 1 : 0;
        }
        $ball = ($totalScore / $question_number) * 100;

        $check = new LmsOraliqTest();
        $check->user_id = $user_id;
        $check->question_ids = $question_ids;
        $check->user_answers = $answer;
        $check->correct_answer = $totalScore;
        $check->question_numbers = $question_number;
        $check->ball = round($ball);
        if (round($ball) >= $success){
            $check->success = 1;
        }else{
            $check->success = 0;
        }
        $check->save();
        if (round($ball) >= $success){
            return redirect(route('user'))->with([
                'oraliq_test_success'=>'Siz oraliq testdan muvaffaqiyatli o\'tdingiz!',
                'oraliq_test'=>'',
                'ball' => round($ball),
                'success' => $success,
            ]);
        }else{
            return redirect(route('user'))->with([
                'oraliq_test_error'=>'Siz oraliq testdan muvaffaqiyatli o\'tmadingiz!',
                'oraliq_test'=>'',
                'ball' => round($ball),
                'success' => $success,
            ]);
        }



    }
}
