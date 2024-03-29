<?php

namespace App\Http\Controllers;

use App\Models\AnswerCheck;
use App\Models\Course;
use App\Models\GroupTest;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShogirdController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->rol_id == 'teacher' || $user->rol_id == 'admin'){
        $ustoz_shogird_id = DB::table('tg_jamoalar')->where('teacher_id',$user->tg_user_id)->pluck('user_id');
//        return $ustoz_shogird_id;
        $lms_user = User::whereIn('tg_user_id',$ustoz_shogird_id)->select('id','tg_user_id','first_name','last_name')->get();
        $user_id = [];
        $user_id[] = $user->id;

        $users = [];
        $users[] = [
            'id' => $user->id,
            'firstname' => $user->first_name,
            'lastname' => $user->last_name,
        ];
        foreach ($lms_user as $use){
            $user_id[] = $use->id;
            $users[] = [
                'id'=>$use->id,
                'firstname'=>$use->first_name,
                'lastname'=>$use->last_name,
            ];
        }

//        return $user_id;
//        return $users;

//        return $lms_user;
        $course = Course::where('status',1)->select('id','title','image')->get();
//        return $course;
        $course_id = [];
        foreach ($course as $cour_id){
            $modules = Module::where('course_id', $cour_id->id)->select('id', 'title', 'course_id')->get();
            $module_id = [];
            foreach ($modules as $mod_id){
                $module_id[] = $mod_id->id;
            }
//            return $module_id;
            $lesson = Lesson::whereIn('module_id',$module_id)->select('id','title','module_id')->orderBy('id','asc')->get();
//            return $module_id;
            // $course_id ni yaratish
            $course_id['course'][] = [
                'id' => $cour_id->id,
                'title' => $cour_id->title,
                'image' => $cour_id->image,
                'modules' => $modules,
                'lessons'=>$lesson,
            ];
        }
//        return $course_id;
//            $answer_check = [];
//            $test = [];
//            $course_ids = [];
            foreach ($course_id['course'] as $course){
                $course_ids[] = $course['id'];
                $modul_ids = [];
                foreach ($course['modules'] as $modul_id){
                    $modul_ids[] = $modul_id['id'];
                }
//                return $modul_ids;
                $group_test = [];
                $test = [];
                $lesson_ids = [];
                $less_ids = [];
//                return $course['lessons'];
                foreach ($course['lessons'] as $lesson_id){
                    $dars_ids[]['lesson_id']  = $lesson_id['id'];
                    $less_ids[] = $lesson_id['id'];
                    $lesson_ids[]['lesson_id']  = $lesson_id['id'];
                    $group_test[] = GroupTest::where('lesson_id',$lesson_id['id'])->select('id','ball','limit','lesson_id')->first();
                    $test[] = Test::where('lesson_id',$lesson_id['id'])->select('id','answer','lesson_id')->first();
                }
//                return $less_ids;
//                return $lesson_ids;
//                return $test;

//                return $lesson_ids;
//                $answer_check[$course['id']]
                $data   = AnswerCheck::
                where([
                    'course_id' => $course['id'],
                    ])
                    ->whereIn('module_id',$modul_ids)
                    ->whereIn('lesson_id',$less_ids)
                    ->whereIn('user_id',$user_id)
                    ->orderBy('lesson_id','asc')
                    ->select(
                        'id',
                        'user_id',
                        'course_id',
                        'module_id',
                        'lesson_id',
                        'user_answers',
                        'correct_answer',
                        'question_numbers',
                        'foiz',
                    )
                    ->get();
                $answer_check[] = [
                  'course_id'=>$course['id'],
                  'lesson_id'=>$lesson_ids,
                  'data'=>$data,
                  'test'=>$test,
                  'group_test'=>$group_test,
                ];
            }
//            return $answer_check;
//            return $lesson_ids;
//            return $dars_ids;
//            return $test;
//            return $course_id;
//            $array = $course_ids[0];
//            return $array;
//            return $course_ids;
//            return $answer_check;
//            return $course['id'];

//            return $users;
//            return $test;
//            return $group_test;
//            return $lesson_ids;
//            return $answer_check;


        return view('user.menu.shogird.index',compact('users','answer_check','user','dars_ids'));
        }else{
            abort(404);
        }
    }
}
