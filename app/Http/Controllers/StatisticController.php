<?php

namespace App\Http\Controllers;

use App\Models\AnswerCheck;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index()
    {
        $course = Course::where('status',0)->first();
        $module = Module::where('course_id',$course->id)->first();
        $lesson = Lesson::where('module_id',$module->id)->first();
        $user = auth()->user();
        $user_foiz = AnswerCheck::selectRaw(
            'lms_answer_check.user_id,
            ROUND(AVG(lms_answer_check.foiz)) as average_foiz,
            lms_zumrad.zumrad,
            lms_users.first_name,
            lms_users.last_name,
            lms_users.image
            ')
            ->where('lms_answer_check.lesson_id', '<>', $lesson->id)
            ->whereNotNull('lms_answer_check.lesson_id')
            ->join('lms_zumrad', 'lms_zumrad.user_id', '=', 'lms_answer_check.user_id')
            ->join('lms_users', 'lms_users.id', '=', 'lms_answer_check.user_id')
            ->groupBy('lms_answer_check.user_id', 'lms_zumrad.zumrad', 'lms_users.first_name', 'lms_users.last_name', 'lms_users.image')
            ->orderBy('average_foiz','desc')
            ->get();

        // Keyingi qadamlarda natijalarni tahlil qilish va har bir foydalanuvchi uchun orinlarini aniqlash
        $rankedResults = [];
        $previousRank = 1;
        foreach ($user_foiz as $index => $result) {
            if ($index > 0 && $result->average_foiz < $user_foiz[$index - 1]->average_foiz) {
                // Natija avvalgi foydalanuvchidan pastroq bo'lsa, yangi orin aniqlash
                $previousRank = $index + 1;
            }
            // Foydalanuvchini natijasi va orini arrayga qo'shish
            $rankedResults[] = [
                'user_id' => $result->user_id,
                'average_foiz' => $result->average_foiz,
                'zumrad' => $result->zumrad,
                'first_name' => $result->first_name,
                'last_name' => $result->last_name,
                'image' => $result->image,
                'rank' => $previousRank,
            ];
        }
//        $rankedResults = [];
//        $previousRank = 1;
//
//        foreach ($user_foiz as $index => $result) {
//            if ($index > 0) {
//                // Natija avvalgi foydalanuvchidan pastroq bo'lsa, yangi orin aniqlash
//                if ($result->average_foiz < $user_foiz[$index - 1]->average_foiz) {
//                    $previousRank = $index + 0;
//                } elseif ($result->average_foiz === $user_foiz[$index - 1]->average_foiz) {
//                    // Agar ikkita bir xil rank bo'lsa, keyingi foydalanuvchiga keyingi rankni boshlash
//                    $previousRank = $index + 0;
//                }
//            }
//
//            // Foydalanuvchini natijasi va orini arrayga qo'shish
//            $rankedResults[] = [
//                'user_id' => $result->user_id,
//                'average_foiz' => $result->average_foiz,
//                'zumrad' => $result->zumrad,
//                'first_name' => $result->first_name,
//                'last_name' => $result->last_name,
//                'image' => $result->image,
//                'rank' => $previousRank,
//            ];
//        }


//        return $rankedResults;

//        return $user_foiz;


        return view('user.menu.statistika.index',compact('rankedResults','user'));
    }


    public function admin()
    {
        $user = auth()->user();

        $course = Course::where('status',0)->first();
        $module = Module::where('course_id',$course->id)->first();
        $lesson = Lesson::where('module_id',$module->id)->first();

//        DB::table('lms_answer_check')->where()
        $user_foiz = AnswerCheck::selectRaw(
            'lms_answer_check.user_id,
            ROUND(AVG(lms_answer_check.foiz)) as average_foiz,
            lms_zumrad.zumrad,
            lms_users.first_name,
            lms_users.last_name,
            lms_users.image
            ')
            ->where('lms_answer_check.lesson_id', '<>', $lesson->id)
            ->whereNotNull('lms_answer_check.lesson_id')
            ->join('lms_zumrad', 'lms_zumrad.user_id', '=', 'lms_answer_check.user_id')
            ->join('lms_users', 'lms_users.id', '=', 'lms_answer_check.user_id')
            ->groupBy('lms_answer_check.user_id', 'lms_zumrad.zumrad', 'lms_users.first_name', 'lms_users.last_name', 'lms_users.image')
            ->orderBy('average_foiz','desc')
            ->get();

        // Keyingi qadamlarda natijalarni tahlil qilish va har bir foydalanuvchi uchun orinlarini aniqlash
        $rankedResults = [];
        $previousRank = 1;
        foreach ($user_foiz as $index => $result) {
            if ($index > 0 && $result->average_foiz < $user_foiz[$index - 1]->average_foiz) {
                // Natija avvalgi foydalanuvchidan pastroq bo'lsa, yangi orin aniqlash
                $previousRank = $index + 1;
            }
            // Foydalanuvchini natijasi va orini arrayga qo'shish
            $rankedResults[] = [
                'user_id' => $result->user_id,
                'average_foiz' => $result->average_foiz,
                'zumrad' => $result->zumrad,
                'first_name' => $result->first_name,
                'last_name' => $result->last_name,
                'image' => $result->image,
                'rank' => $previousRank,
            ];
        }
//        $rankedResults = [];
//        $previousRank = 1;
//
//        foreach ($user_foiz as $index => $result) {
//            if ($index > 0) {
//                // Natija avvalgi foydalanuvchidan pastroq bo'lsa, yangi orin aniqlash
//                if ($result->average_foiz < $user_foiz[$index - 1]->average_foiz) {
//                    $previousRank = $index + 0;
//                } elseif ($result->average_foiz === $user_foiz[$index - 1]->average_foiz) {
//                    // Agar ikkita bir xil rank bo'lsa, keyingi foydalanuvchiga keyingi rankni boshlash
//                    $previousRank = $index + 0;
//                }
//            }
//
//            // Foydalanuvchini natijasi va orini arrayga qo'shish
//            $rankedResults[] = [
//                'user_id' => $result->user_id,
//                'average_foiz' => $result->average_foiz,
//                'zumrad' => $result->zumrad,
//                'first_name' => $result->first_name,
//                'last_name' => $result->last_name,
//                'image' => $result->image,
//                'rank' => $previousRank,
//            ];
//        }


//        return $rankedResults;

//        return $user_foiz;


        return view('admin.menu.statistika.index',compact('rankedResults','user'));
    }
}
