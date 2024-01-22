<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserCheck;
use Illuminate\Http\Request;

class UserCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_check = UserCheck::orderBy('id','asc')->get();
        return view('admin.menu.users_check.index',compact('user_check'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userCheckId = UserCheck::pluck('user_id')->toArray();
        $users = User::where('rol_id','user')->orderBy('id','asc')->whereNotIn('id', $userCheckId)->get();
        return view('admin.menu.users_check.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
        ]);

        $data = new UserCheck();
        $data->user_id = $request->user_id;
        if ($request->video){
            $data->video = $request->video;
        }
        if($request->one_day_apteka){
            $data->one_day_apteka = $request->one_day_apteka;
        }
//        return $data;
        if (!$data->save()){
            return redirect(route('users_check.create'))->with('error','User Check created error!');
        }
        return redirect(route('users_check.index'))->with('success','Users Check successfully created!');
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
        $user_check = UserCheck::findOrFail($id);
        $users = User::where('id',$user_check->user_id)->select('id','first_name','last_name','username')->get();
//        return  $users;
        return view('admin.menu.users_check.edit',compact('user_check','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id'=>'required',
        ]);
        $user_data = UserCheck::find($id);
        $user_data->user_id = $request->user_id;
        if($request->video){
            $user_data->video = $request->video;
        }else{
            $user_data->video = 0;
        }
        if ($request->one_day_apteka){
            $user_data->one_day_apteka = $request->one_day_apteka;
        }else{
            $user_data->one_day_apteka = 0;
        }

        if (!$user_data->save()){
            return redirect(route('users_check.edit'))->with('error','User Check updated error!');
        }
        return redirect(route('users_check.index'))->with('success','Users Check successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        UserCheck::destroy($id);
        return redirect(route('users_check.index'))->with('success', 'Medicine successfully deleted!');
    }
}
