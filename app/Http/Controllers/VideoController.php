<?php

namespace App\Http\Controllers;

use App\Models\GroupTest;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $video = Video::orderBy('id','asc')->get();
        return view('admin.menu.videos.index' ,compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $group_test = GroupTest::select('id','title')->get();
        return view('admin.menu.videos.create' ,compact('group_test'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'url'=>'required',
            'group_test_id'=>'required',
            'content_type'=>'required',
        ]);

        $data = new Video();
        $data->title = $request->title;
        $data->url = $request->url;
        $data->group_test_id = $request->group_test_id;
        $data->content = $request->content_type;


        if (!$data->save()){
            return redirect(route('video.create'))->with('error','Video created error!');
        }
        return redirect(route('video.index'))->with('success','Video successfully created!');
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
        $video = Video::findOrFail($id);
        $group_test = GroupTest::select('id','title')->get();
//        return $video;
//        $video = Video::where('id',$id)->get();
        return view('admin.menu.videos.edit',compact('video','group_test'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user_data = Video::find($id);
        $input = $request->all();
        $user_data->update($input);
        $request->validate([
            'title'=>'required',
            'url'=>'required',
            'group_test_id'=>'required',
            'content_type'=>'required',
        ]);
        $user_data->title = $request->title;
        $user_data->url = $request->url;
        $user_data->group_test_id = $request->group_test_id;
        $user_data->content = $request->content_type;


        if (!$user_data->save()){
            return redirect(route('video.update'))->with('error','Video updated error');
        }
        return redirect(route('video.index'))->with('success','Video successfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Video::destroy($id);
        return redirect(route('video.index'))->with('success', 'Video successfully deleted!');
    }
}
