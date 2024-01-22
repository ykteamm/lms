<?php

namespace App\Http\Controllers;

use App\Models\GroupTest;
use App\Models\Test;
use Illuminate\Http\Request;

class GroupTestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $group_test = GroupTest::orderBy('id','asc')->get();
        return view('admin.menu.group_test.index',compact('group_test'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $question = Test::orderBy('id','asc')->get();
        return view('admin.menu.group_test.create',compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $data = $request->all();
//        return $data;
        $request->validate([
            'title'=>'required',
            'test_json'=>'required',
        ]);

        $data = new GroupTest();
        $data->title = $request->title;
        $data->test_json = $request->test_json;
        $data->ball = $request->ball;
        $data->limit = $request->limit;

//        return $data;
        if (!$data->save()){
            return redirect(route('group_test.create'))->with('error','Group test created error!');
        }
        return redirect(route('group_test.index'))->with('success','Group test successfully created!');
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
        $groupTest = GroupTest::findOrFail($id);


        $testIds = $groupTest->test_json;
        $relatedTests = Test::select('id','title')->get();

        return view('admin.menu.group_test.edit',compact('groupTest','relatedTests','testIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $groupTest = GroupTest::findOrFail($id);


        $request->validate([
            'title'=>'required',
            'test_json'=>'required',
            'ball'=>'required',
            'limit'=>'required',
        ]);
        $groupTest->update([
            'title'=>$request->title,
            'test_json' => $request->input('test_json', []),
            'ball'=>$request->ball,
            'limit'=>$request->limit,
        ]);

//        return $groupTest;

        if (!$groupTest){
            return redirect()->route('group_test.edit')->with('error', 'GroupTest updated error');
        }
        return redirect()->route('group_test.index')->with('success', 'GroupTest updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        GroupTest::destroy($id);
        return redirect(route('group_test.index'))->with('success', 'Group test successfully deleted!');
    }
}
