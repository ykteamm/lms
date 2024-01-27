<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseMedicine;
use App\Models\GroupTest;
use App\Models\Lesson;
use App\Models\Medicine;
use App\Models\Module;
use App\Models\Test;
use App\Models\Video;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($module_id)
    {
        $module = Module::findOrFail($module_id);
//        $course_id = Course::where('id',$module_id);
        $lessons = Lesson::where('module_id',$module_id)->orderBy('id','asc')->get();

        return view('admin.menu.lessons.index',compact('lessons','module','module_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($lesson_id)
    {
        $module_id = Lesson::where('id',$lesson_id)->first();
//        $course_id = Module::where('id',$module_id->id)->first();
        return view('admin.menu.lessons.create',compact('lesson_id','module_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'module_id'=>'required',
        ]);
        $module_id = $request->module_id;
        $data = new Lesson();
        $data->title = $request->title;
        $data->module_id = $module_id;

//        return $data;
        if (!$data->save()){
            return redirect(route('lessons-index',['module_id'=>$module_id]))->with('error','Dars yaratilishida xatolik!');
        }
        return redirect(route('lessons-index',['module_id'=>$module_id]))->with('success','Dars muvaffaqiyatli yaratildi!');
    }

    public function VideoDars(Request $request)
    {
//        return $request;

//        return $request->questions;

        $lesson_id = $request->lesson_id;
        $url = $request->url;
        $content = $request->video_content;
//        return $content;
        $questions = $request->questions;

//        $dom = new DOMDocument();
//
////        return $dom;
//        $dom->loadHTML($content,9);
//        $images = $dom->getElementsByTagName('img');
//        foreach ($images as $key => $img){
//            $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
//            $image_name = "/uploads/".time().$key.'.png';
//            file_put_contents(public_path().$image_name,$data);
//
//            $img->removeAttribute('src');
//            $img->setAttribute('src',$image_name);
//        }
//        $content = $dom->saveHTML();

        $data = new Video();
        $data->url = $url;
        $data->content = $content;
        $data->lesson_id = $lesson_id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(5) .'.'.$image->getClientOriginalExtension();
            $directory = 'video_image';
            $image->storeAs("public/{$directory}", $imageName);
            $data->image = $directory.'/'.$imageName;
        }
        $data->save();
// tests databasega saqlash
        foreach ($questions as $question) {
            // Map the JSON data to the model's attributes
            $test = new Test();
            $test->title = $question['title'];
            $test->variant_a = $question['variants']['variant_a'];
            $test->variant_b = $question['variants']['variant_b'];
            $test->variant_c = $question['variants']['variant_c'];
            $test->variant_d = $question['variants']['variant_d'];
            $test->answer = $question['answer'];
            $test->lesson_id = $lesson_id;
            // Save the model to the database
            $test->save();
        }
//        end database

// group test
        $test_json = Test::where('lesson_id',$lesson_id)->pluck('id');
        $level = $request->level;
        $ball = $request->ball;
        $limit = $request->limit;
//        save database
        $group_test = new GroupTest();
        $group_test->level = $level;
        $group_test->ball = $ball;
        $group_test->limit = $limit;
        $group_test->test_json = $test_json;
        $group_test->lesson_id = $lesson_id;
        $group_test->save();
// end group test

//        module->id
        $module_id = Lesson::where('id',$lesson_id)->first();
//        return $module_id;
        if (!$data->save()){
            return redirect(route('lessons-index',['module_id'=>$module_id->module_id]))->with('error','Video dars va test yaratilishida xatolik!');
        }
        return redirect(route('lessons-index',['module_id'=>$module_id->module_id]))->with('success','Video dars va testlar muvaffaqiyatli yaratildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $lesson)
    {
        $lesson_id = Lesson::where('id',$lesson)->first();
        $video_dars = Video::where('lesson_id',$lesson)->first();
        $tests = Test::where('lesson_id',$lesson)->orderBy('id','asc')->get();
        $group_test = GroupTest::where('lesson_id',$lesson)->first();
        return view('admin.menu.lessons.show',compact('video_dars','group_test','tests','lesson_id'));
    }

    public function VideoDarsUpdate(Request $request, $video_id)
    {
        $video = Video::find($video_id);

        $content = $request->video_content;
//        $dom = new DOMDocument();
//        $dom->loadHTML($content,9);
//        $images = $dom->getElementsByTagName('img');
//        foreach ($images as $key => $img){
//            if (strpos($img->getAttribute('src'),'data:image/') === 0) {
//
//                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
//                $image_name = "/uploads/" . time() . $key . '.png';
//                file_put_contents(public_path() . $image_name, $data);
//
//                $img->removeAttribute('src');
//                $img->setAttribute('src', $image_name);
//            }
//        }
//        $content = $dom->saveHTML();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(5) .'.'.$image->getClientOriginalExtension();
            $directory = 'video_image';
            $image->storeAs("public/{$directory}", $imageName);
            $video->update(['image'=>$directory.'/'.$imageName]);
        }
        $video->update([
            'url'=>$request->url,
            'content'=>$content,
            'lesson_id'=>$request->lesson_id,
        ]);
        $lesson = $request->lesson_id;

        return redirect(route('lessons.show',['lesson'=>$lesson]))->with('success','Video dars muvaffaqiyatli tahrirlandi!');

    }


    public function GroupTestUpdate(Request $request, $id)
    {
        $group_test = GroupTest::find($id);

        $lesson = $request->lesson_id;
        $group_test->update([
            'lesson_id'=>$lesson,
            'level'=>$request->level,
            'ball'=>$request->ball,
            'limit'=>$request->limit,
        ]);

        return redirect(route('lessons.show',['lesson'=>$lesson]))->with('success','Test qoidalari muvaffaqiyatli tahrirlandi!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lessons = Lesson::findOrFail($id);

//        return $course_medicine;
        $course = Course::select('id','title')->get();
        $medicine = Medicine::select('id','title')->get();
        $video = Video::select('id','title')->get();

        return view('admin.menu.lessons.edit',compact('lessons','course','medicine','video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->update([
            'title'=>$request->title,
            'module_id'=>$request->module_id,
        ]);

        return redirect(route('lessons-index',['module_id'=>$request->module_id]))->with('success', 'Dars muvaffaqiyatli tahrirlandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $module_id = $request->module_id;

      $test_delete = Test::where('lesson_id',$id)->get();
      $video_delete = Video::where('lesson_id',$id)->first();
      $group_test_delete = GroupTest::where('lesson_id',$id)->first();


        foreach ($test_delete as $test) {
            $test->delete();
        }
        if ($video_delete){
            Video::destroy($video_delete->id);
        }
        if ($group_test_delete) {
            GroupTest::destroy($group_test_delete->id);
        }
        Lesson::destroy($id);
        return redirect(route('lessons-index',['module_id'=>$module_id]))->with('success', 'Darsni muvaffaqiyatli o\'chirdingiz!');
    }
}
