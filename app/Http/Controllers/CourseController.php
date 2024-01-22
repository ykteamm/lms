<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::orderBy('id','asc')->get();

        return view('admin.menu.courses.index',compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'image'=>'required|image|mimes:png,jpg,jpeg',
        ]);

        $data = new Course();
        $data->title = $request->title;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(5) .'.'.$image->getClientOriginalExtension();
            $directory = 'courses';
            $image->storeAs("public/{$directory}", $imageName);
            $data->image = $directory.'/'.$imageName;
        }

        if (!$data->save()){
            return redirect(route('course.create'))->with('error','Course qo\'shishda xatolik!');
        }
        return redirect(route('course.index'))->with('success','Course muvaffaqiyatli qo\'shildi !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::findOrFail($id);
        $module = Module::where('course_id',$course->id)->get();
        return view('admin.menu.courses.show',compact('course','module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);

        return view('admin.menu.courses.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required',
        ]);
        $user_data = Course::find($id);
        $user_data->status = $request->status;
        $user_data->title = $request->title;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(5) .'.'.$image->getClientOriginalExtension();
            $directory = 'courses';
            $image->storeAs("public/{$directory}", $imageName);
            $user_data->image = $directory.'/'.$imageName;
        }

        if (!$user_data->save()){
            return redirect(route('course.update'))->with('error','Course updated error');
        }
        return redirect(route('course.index'))->with('success','Course successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Course::destroy($id);
        return redirect(route('course.index'))->with('success', 'Course successfully deleted!');
    }
}
