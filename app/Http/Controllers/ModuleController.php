<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\GroupTest;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Test;
use App\Models\Video;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($course_id)
    {
        $course = Course::findOrFail($course_id);
        $module = Module::where('course_id',$course->id)->orderBy('id','asc')->get();
        return view('admin.menu.module.index',compact('course','module'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'course_id'=>'required',
        ]);
        $data = new Module();
        $data->title = $request->title;
        $data->course_id = $request->course_id;
        $data->status = 0;

        if (!$data->save()){
            return redirect(route('module-index',['course_id'=>$request->course_id]))->with('error','Module qo\'shishda xatolik');
        }
        return redirect(route('module-index',['course_id'=>$request->course_id]))->with('success','Module muvaffaqiyatli qo\'shildi !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required',
            'course_id'=>'required',
        ]);
        $user_data = Module::find($id);
        $user_data->title = $request->title;
        $user_data->status = $request->status;
        if (!$user_data->save()) {
            return redirect(route('module-index',['course_id'=>$request->course_id]))->with('error','Module tahrirlashda xatolik');
        }
        return redirect(route('module-index',['course_id'=>$request->course_id]))->with('success','Module muvaffaqiyatli tahrirlandi !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $course_id = $request->course_id;
        Module::destroy($id);

        $lessonsToDelete = Lesson::where('module_id', $id)->get();
        foreach ($lessonsToDelete as $lesson) {
            GroupTest::where('lesson_id',$lesson->id)->delete();
            Video::where('lesson_id',$lesson->id)->delete();
            Test::where('lesson_id',$lesson->id)->delete();
            $lesson->delete();
        }

        return redirect(route('module-index',['course_id'=>$course_id]))->with('success','Module muvaffaqiyatli o\'chirildi !');
    }
}
