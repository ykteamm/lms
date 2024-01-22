<?php

namespace App\Http\Controllers;

use App\Models\GroupTest;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $question = Test::orderBy('id','asc')->get();

        return view('admin.menu.test.index',compact('question'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.menu.test.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lesson = $request->lesson_id;
        $data = new Test();
        $data->title = $request->title;
        $data->variant_a = $request->variant_a;
        $data->variant_b = $request->variant_b;
        $data->variant_c = $request->variant_c;
        $data->variant_d = $request->variant_d;
        $data->answer = $request->answer;
        $data->lesson_id = $lesson;
//        return $data;
        if (!$data->save()){
            return redirect(route('lessons.show',['lesson'=>$lesson]))->with('error','Test qo\'shishda xatolik!');
        }
        $test_json = Test::where('lesson_id',$lesson)->pluck('id');
        GroupTest::where('lesson_id',$lesson)->update([
            'test_json'=>$test_json,
        ]);
        return redirect(route('lessons.show',['lesson'=>$lesson]))->with('success','Test muvaffaqiyatli qo\'shildi!');
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
        $question = Test::where('id',$id)->get();
        return view('admin.menu.test.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user_data = Test::find($id);
        $lesson =  $request->lesson_id;
        $user_data->title = $request->title;
        $user_data->variant_a = $request->variant_a;
        $user_data->variant_b = $request->variant_b;
        $user_data->variant_c = $request->variant_c;
        $user_data->variant_d = $request->variant_d;
        $user_data->answer = $request->answer;
        $user_data->lesson_id = $lesson;

        if (!$user_data->save()){
            return redirect(route('lessons.show',['lesson'=>$lesson]))->with('error','Testni tahrirlashda xatolik!');
        }
        return redirect(route('lessons.show',['lesson'=>$lesson]))->with('success','Test muvaffaqiyatli tahrirlandi!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Test::destroy($id);
        return redirect(route('test.index'))->with('success', 'Test successfully deleted!');
    }
}
