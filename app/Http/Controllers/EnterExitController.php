<?php

namespace App\Http\Controllers;

use App\Models\EnterLogout;
use Illuminate\Http\Request;

class EnterExitController extends Controller
{
    public function index()
    {
        $enter_exit = EnterLogout::
//        selectRaw()
//        ->
//        where('login_time',now())->
        get();

//        return $enter_exit;
//        return now();
        return view('admin.menu.enter_exit.index');
    }
}
