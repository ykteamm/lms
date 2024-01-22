<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Raspisaniya;
use Illuminate\Http\Request;

class RaspisaniyaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $raspisaniya = Raspisaniya::orderBy('id','asc')->get();
        return view('admin.menu.raspisaniya.index',compact('raspisaniya'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lesson = Lesson::orderBy('id','asc')->get();
        return view('admin.menu.raspisaniya.create',compact('lesson'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'lesson_id'=>'required',
            'day'=>'required',
        ]);

        $data = new Raspisaniya();
        $data->title = $request->title;
        $data->lesson_id = $request->lesson_id;
        $data->day = $request->day;

//        return $data;
        if (!$data->save()){
            return redirect(route('raspisaniya.create'))->with('error','Raspisaniya created error!');
        }
        return redirect(route('raspisaniya.index'))->with('success','Raspisaniya successfully created!');
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
        $raspisaniya = Raspisaniya::findOrFail($id);
        $testIds = $raspisaniya->lesson_id;
        $relatedTests = Lesson::select('id','title')->get();

        return view('admin.menu.raspisaniya.edit',compact('raspisaniya','relatedTests','testIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $raspisaniya = Raspisaniya::findOrFail($id);


        $request->validate([
            'title'=>'required',
            'lesson_id'=>'required',
            'day'=>'required',
        ]);
        $raspisaniya->update([
            'title'=>$request->title,
            'lesson_id' => $request->input('lesson_id', []),
            'day'=>$request->day,
        ]);

//        return $groupTest;

        if (!$raspisaniya){
            return redirect()->route('raspisaniya.edit')->with('error', 'Raspisaniya updated error');
        }
        return redirect()->route('raspisaniya.index')->with('success', 'Raspisaniya updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Raspisaniya::destroy($id);
        return redirect(route('raspisaniya.index'))->with('success', 'Raspisaniya successfully deleted!');
    }
}
