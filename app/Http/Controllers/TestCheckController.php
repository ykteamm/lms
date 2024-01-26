<?php

namespace App\Http\Controllers;

use App\Models\AnswerCheck;
use App\Models\Course;
use App\Models\GroupTest;
use App\Models\Lesson;
use App\Models\Medicine;
use App\Models\Passed;
use App\Models\Raspisaniya;
use App\Models\RaspisaniyaUser;
use App\Models\Test;
use App\Models\User;
use App\Models\UserCheck;
use App\Models\Video;
use App\Models\WeekTest;
use App\Models\Zumrad;
use Illuminate\Http\Request;

class TestCheckController extends Controller
{

    public function AllTest(Request $request)
    {
        $userId = auth()->user()->id;

        $questionIds = $request->input('question_ids');
        $answers = $request->input('answers');
        $course_id = $request->input('course_id');
        $module_id = $request->input('module_id');
        $lesson_id = $request->input('lesson_id');
        $ball = $request->input('ball');
        $limit = $request->input('limit');

        $totalScore = 0;
        foreach ($questionIds as $questionId) {
            $correctAnswer = Test::find($questionId)->answer; // Test modelida "answer" haqiqiy savol javobi ustida
            // Agar berilgan javoblar va haqiqiy javob bir xil bo'lsa, 1 qo'shib sanab boramiz, aks holda 0 qo'shib sanab boramiz
            $totalScore += ($answers[$questionId][0] == $correctAnswer) ? 1 : 0;
        }
        $totalQuestions = count($questionIds);
        $foiz = ($totalScore / $totalQuestions) * 100;

        $check_status = Passed::where(['user_id'=>$userId,'course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id])->first();

        $data = new AnswerCheck();
        $data->user_id = $userId;
        $data->course_id = $course_id;
        $data->module_id = $module_id;
        $data->lesson_id = $lesson_id;
        $data->question_ids = $questionIds;
        $data->user_answers = $answers;
        $data->correct_answer = $totalScore;
        $data->question_numbers = $totalQuestions;
        $data->foiz = round($foiz);

        if (!$data->save()){
            return redirect(route('user'))->with('error','Test does not saved!');
        }elseif ($foiz >= $ball){
            if ($check_status == null){
                $answer_id = AnswerCheck::where(['user_id'=>$userId,'course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id])->orderBy('id','desc')->first();
                $ans_id[] = $answer_id->id;
                $pass = new Passed();
                $pass->course_id = $course_id;
                $pass->module_id = $module_id;
                $pass->lesson_id = $lesson_id;
                $pass->user_id = $userId;
                $pass->limit = $limit - 1;
                $pass->limit_number = $limit;
                $pass->answer_check_id = $ans_id;
                $pass->pass_status = 1;
                $pass->save();

                $zumrad_status = Zumrad::where('user_id',$userId)->first();
                $passed_id = Passed::where(['course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id,'user_id'=>$userId,'pass_status'=>1])->orderBy('id','desc')->first();
                $pass_id[] = $passed_id->id;
                if ($zumrad_status == null) {
                    $zumrad = new Zumrad();
                    $zumrad->user_id = $userId;
                    $zumrad->passed_id = $pass_id;
                    $zumrad->zumrad = 1;
                    $zumrad->save();
                }else{
                    $passed_id = Passed::where(['course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id,'user_id'=>$userId,'pass_status'=>1])->orderBy('id','desc')->first();
                    $add_pass_id = $zumrad_status->passed_id;
                    $newPassId = $passed_id->id;
                    $add_pass_id[] = $newPassId;

                    $zumrad = Zumrad::findorFail($zumrad_status->id);
                    $zumrad->user_id = $userId;
                    $zumrad->passed_id = $add_pass_id;
                    $zumrad->zumrad = $zumrad_status->zumrad + 1;
                    $zumrad->save();
                }
                return redirect(url('user/lesson/'.$module_id))->with(['dars_test'=>'Siz testdan muvaffaqiyatli o\'tdingiz!','natija'=>'']);
            }else{
                $answer_id = AnswerCheck::where(['user_id'=>$userId,'course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id])->orderBy('id','desc')->first();
//                $add_check_id = json_decode($check_status->answer_check_id,true) ?? [];
                $add_check_id = $check_status->answer_check_id;
                $newId = $answer_id->id;
                $add_check_id[] = $newId;

                $pass_update = Passed::findOrFail($check_status->id);
                $pass_update->answer_check_id = $add_check_id; // Vergul bilan ajratib yozish
                $pass_update->limit = $check_status->limit - 1;
                $pass_update->pass_status = 1;
                $pass_update->save();

                $zumrad_status = Zumrad::where('user_id',$userId)->first();
                $passed_id = Passed::where(['course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id,'user_id'=>$userId,'pass_status'=>1])->orderBy('id','desc')->first();
                $pass_id[] = $passed_id->id;
                if ($zumrad_status == null) {
                    $zumrad = new Zumrad();
                    $zumrad->user_id = $userId;
                    $zumrad->passed_id = $pass_id;
                    $zumrad->zumrad = 1;
                    $zumrad->save();
                }else{
                    $passed_id = Passed::where(['course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id,'user_id'=>$userId,'pass_status'=>1])->orderBy('id','desc')->first();
                    $add_pass_id = $zumrad_status->passed_id;
                    $newPassId = $passed_id->id;
                    $add_pass_id[] = $newPassId;

                    $zumrad = Zumrad::findorFail($zumrad_status->id);
                    $zumrad->user_id = $userId;
                    $zumrad->passed_id = $add_pass_id;
                    $zumrad->zumrad = $zumrad_status->zumrad + 1;
                    $zumrad->save();
                }
                return redirect(url('user/lesson/'.$module_id))->with(['dars_test'=>'Siz testdan muvaffaqiyatli o\'tdingiz!','natija'=>'']);
            }
        } elseif ($foiz < $ball){
            if ($check_status == null){
                $answer_id = AnswerCheck::where(['user_id'=>$userId,'course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id])->orderBy('id','desc')->first();
                $ans_id[] = $answer_id->id;
                $pass = new Passed();
                $pass->course_id = $course_id;
                $pass->module_id = $module_id;
                $pass->lesson_id = $lesson_id;
                $pass->user_id = $userId;
                $pass->limit = $limit - 1;
                $pass->limit_number = $limit;
                $pass->answer_check_id = $ans_id;
                $pass->pass_status = 0;
                $pass->save();

                $zumrad_status = Zumrad::where('user_id',$userId)->first();
                $passed_id = Passed::where(['course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id,'user_id'=>$userId,'pass_status'=>0])->orderBy('id','desc')->first();
                $pass_id[] = $passed_id->id;
                if ($zumrad_status == null) {
                    $zumrad = new Zumrad();
                    $zumrad->user_id = $userId;
                    $zumrad->passed_id = $pass_id;
                    $zumrad->zumrad = 0;
                    $zumrad->save();
                }else{
                    $passed_id = Passed::where(['course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id,'user_id'=>$userId,'pass_status'=>0])->orderBy('id','desc')->first();
                    $add_pass_id = $zumrad_status->passed_id;
                    $newPassId = $passed_id->id;
                    $add_pass_id[] = $newPassId;

                    $zumrad = Zumrad::findorFail($zumrad_status->id);
                    $zumrad->user_id = $userId;
                    $zumrad->passed_id = $add_pass_id;
                    $zumrad->zumrad = $zumrad_status->zumrad + 0;
                    $zumrad->save();
                }


                return redirect(url('user/lesson-show/'.$lesson_id))->with(['dars_test'=>'Siz testdan o\'ta olmadingiz! Ehtiyotkorlik bilan qaytadan ishlang!','natija'=>'']);
            }
            else{
                $answer_id = AnswerCheck::where(['user_id'=>$userId,'course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id])->orderBy('id','desc')->first();
//                $add_check_id = json_decode($check_status->answer_check_id,true) ?? [];
                $add_check_id = $check_status->answer_check_id;
                $newId = $answer_id->id;
                $add_check_id[] = $newId;

                $pass_update = Passed::findOrFail($check_status->id);

//                $pass_update->answer_check_id = implode(',', $add_check_id); // Vergul bilan ajratib yozish
                $pass_update->answer_check_id = $add_check_id;
                $pass_update->limit = $check_status->limit - 1;
                $pass_update->pass_status = 0;
                $pass_update->save();

                $zumrad_status = Zumrad::where('user_id',$userId)->first();
                $passed_id = Passed::where(['course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id,'user_id'=>$userId,'pass_status'=>0])->orderBy('id','desc')->first();
                $pass_id[] = $passed_id->id;
                if ($zumrad_status == null) {
                    $zumrad = new Zumrad();
                    $zumrad->user_id = $userId;
                    $zumrad->passed_id = $pass_id;
                    $zumrad->zumrad = 0;
                    $zumrad->save();
                }else{
                    $passed_id = Passed::where(['course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id,'user_id'=>$userId,'pass_status'=>0])->orderBy('id','desc')->first();
                    $add_pass_id = $zumrad_status->passed_id;
                    $newPassId = $passed_id->id;
                    $add_pass_id[] = $newPassId;

                    $zumrad = Zumrad::findorFail($zumrad_status->id);
                    $zumrad->user_id = $userId;
                    $zumrad->passed_id = $add_pass_id;
                    $zumrad->zumrad = $zumrad_status->zumrad + 0;
                    $zumrad->save();
                }

                if ($pass_update->limit == 0){
                    return redirect(url('user/lesson/'.$module_id))->with('dars_test_fail','Sizga berilgan imkoniyatlardan foydalana olmadingiz.');
                }else{
                    return redirect(url('user/lesson-show/'.$lesson_id))->with(['dars_test'=>'Siz testdan o\'ta olmadingiz! Ehtiyotkorlik bilan qaytadan ishlang!','natija'=>'']);
                }
            }
        }

        return redirect(route('user'));
    }


    public function CheckTest(Request $request)
    {
        $userId = auth()->user()->id;

        $questionIds = $request->input('question_ids');
        $answers = $request->input('answers');
        $course_id = $request->input('course_id');
        $module_id = $request->input('module_id');
        $lesson_id = $request->input('lesson_id');
        $ball = $request->input('ball');
        $limit = $request->input('limit');

        $totalScore = 0;
        foreach ($questionIds as $questionId) {
            $correctAnswer = Test::find($questionId)->answer; // Test modelida "answer" haqiqiy savol javobi ustida
            // Agar berilgan javoblar va haqiqiy javob bir xil bo'lsa, 1 qo'shib sanab boramiz, aks holda 0 qo'shib sanab boramiz
            $totalScore += ($answers[$questionId][0] == $correctAnswer) ? 1 : 0;
        }
        $totalQuestions = count($questionIds);
        $foiz = ($totalScore / $totalQuestions) * 100;

        $check_status = Passed::where(['user_id'=>$userId,'course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id])->first();

        $data = new AnswerCheck();
        $data->user_id = $userId;
        $data->course_id = $course_id;
        $data->module_id = $module_id;
        $data->lesson_id = $lesson_id;
        $data->question_ids = $questionIds;
        $data->user_answers = $answers;
        $data->correct_answer = $totalScore;
        $data->question_numbers = $totalQuestions;
        $data->foiz = round($foiz);

        if (!$data->save()){
            return redirect(route('user'))->with('error','Test does not saved!');
        }elseif ($foiz >= $ball){
            if ($check_status == null){
                $answer_id = AnswerCheck::where(['user_id'=>$userId,'course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id])->orderBy('id','desc')->first();
                $ans_id[] = $answer_id->id;
                $pass = new Passed();
                $pass->course_id = $course_id;
                $pass->module_id = $module_id;
                $pass->lesson_id = $lesson_id;
                $pass->user_id = $userId;
                $pass->limit = $limit - 1;
                $pass->limit_number = $limit;
                $pass->answer_check_id = $ans_id;
                $pass->pass_status = 1;
                $pass->save();

                return redirect(route('user'))->with(['ishga_kirish'=>'Siz ishga kirish testidan muvaffaqiyatli o\'tdingiz!','ishga_kirish_natija'=>'']);
            }
            else{
                $answer_id = AnswerCheck::where(['user_id'=>$userId,'course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id])->orderBy('id','desc')->first();
//                $add_check_id = json_decode($check_status->answer_check_id,true) ?? [];
                $add_check_id = $check_status->answer_check_id;
                $newId = $answer_id->id;
                $add_check_id[] = $newId;

                $pass_update = Passed::findOrFail($check_status->id);
                $pass_update->answer_check_id = $add_check_id; // Vergul bilan ajratib yozish
                $pass_update->limit = $check_status->limit - 1;
                $pass_update->pass_status = 1;
                $pass_update->save();

                return redirect(route('user'))->with(['ishga_kirish'=>'Siz ishga kirish testidan muvaffaqiyatli o\'tdingiz!','ishga_kirish_natija'=>'']);
            }
        } elseif ($foiz < $ball){
            if ($check_status == null){
                $answer_id = AnswerCheck::where(['user_id'=>$userId,'course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id])->orderBy('id','desc')->first();
                $ans_id[] = $answer_id->id;
                $pass = new Passed();
                $pass->course_id = $course_id;
                $pass->module_id = $module_id;
                $pass->lesson_id = $lesson_id;
                $pass->user_id = $userId;
                $pass->limit = $limit - 1;
                $pass->limit_number = $limit;
                $pass->answer_check_id = $ans_id;
                $pass->pass_status = 0;
                $pass->save();

                return redirect(url('user/lesson-show/'.$lesson_id))->with(['ball_kam'=>'Siz ishga kirish uchun yetarli ball to\'play olmadingiz','ishga_kirish_natija'=>'']);
            }
            else{
                $answer_id = AnswerCheck::where(['user_id'=>$userId,'course_id'=>$course_id,'module_id'=>$module_id,'lesson_id'=>$lesson_id])->orderBy('id','desc')->first();
//                $add_check_id = json_decode($check_status->answer_check_id,true) ?? [];
                $add_check_id = $check_status->answer_check_id;
                $newId = $answer_id->id;
                $add_check_id[] = $newId;

                $pass_update = Passed::findOrFail($check_status->id);

//                $pass_update->answer_check_id = implode(',', $add_check_id); // Vergul bilan ajratib yozish
                $pass_update->answer_check_id = $add_check_id;
                $pass_update->limit = $check_status->limit - 1;
                $pass_update->pass_status = 0;
                $pass_update->save();
                if ($pass_update->limit == 0){
                    return redirect(route('user'))->with(['ishga_kira_olmadi'=>'Sizga berilgan imkoniyatlardan foydalana olmadingiz, Sizni ishga qabul qila olmaymiz!','ishga_kirish_natija'=>'']);
                }else{
                    return redirect(url('user/lesson-show/'.$lesson_id))->with(['ball_kam'=>'Siz ishga kirish uchun yetarli ball to\'play olmadingiz','ishga_kirish_natija'=>'']);
                }
            }
        }

        return redirect(route('user'));
    }

    public function Imkoniyat(Request $request)
    {
        $userID = $request->user_id;
        $lesson_id = $request->lesson_id;

        $zumrad_number = Zumrad::where('user_id',$userID)->first();

        $ayirish = $zumrad_number->zumrad - 1;
//        return $zumrad_number;
        Zumrad::where('user_id',$userID)
            ->update([
                'zumrad'=>$ayirish
            ]);
        Passed::where([
            'lesson_id'=>$lesson_id,
            'user_id'=>$userID
        ])->update([
            'limit'=>1
        ]);

        return redirect(route('lesson-show',['lesson_id'=>$lesson_id]))->with('imkoniyat','Sizning 1ta zumradingiz evaziga, 1ta imkoniyat taqdim etildi!');
    }
}
