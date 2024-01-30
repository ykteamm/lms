<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ElchilarController extends Controller
{
    public function ElchiIndex()
    {
        $region = Region::get(['name','id']);
        $district = District::get(['name','id','region_id']);

        $elchi = User::whereIn('rol_id',['old_user','teacher'])->get();

        $teacher = DB::table('teachers')->select('teachers.*', 'tg_user.first_name as user_first_name', 'tg_user.last_name as user_last_name')
            ->join('tg_user', 'tg_user.id', 'teachers.user_id')
            ->get();

        $data = DB::table('tg_user')->select('tg_user.*', 'tg_user.id as user_id','tg_user.first_name as user_first_name', 'tg_user.last_name as user_last_name')
            ->leftJoin('teachers', 'teachers.user_id', '=', 'tg_user.id')
            ->whereNull('teachers.user_id')
            ->whereNotIn('tg_user.id', function ($query) {
                $query->select('user_id')->from('tg_jamoalar');
            })
            ->orderBy('id','asc')
            ->get();

        return view('admin.menu.elchi.index',compact('elchi','region','district','data','teacher'));
    }

    public function TgTeacher(Request $request)
    {
        if ($request->rol_id == 'teacher'){
            $data = DB::table('teachers')->select('teachers.*', 'tg_user.first_name as user_first_name', 'tg_user.last_name as user_last_name')
                ->join('tg_user', 'tg_user.id', 'teachers.user_id')
                ->get();
            return response()->json($data);
        }elseif ($request->rol_id == 'old_user'){
            $data = DB::table('tg_user')->select('tg_user.*', 'tg_user.id as user_id','tg_user.first_name as user_first_name', 'tg_user.last_name as user_last_name')
                ->leftJoin('teachers', 'teachers.user_id', '=', 'tg_user.id')
                ->whereNull('teachers.user_id')
                ->whereNotIn('tg_user.id', function ($query) {
                    $query->select('user_id')->from('tg_jamoalar');
                })
                ->orderBy('id','asc')
                ->get();
            return response()->json($data);
        }
        return response()->json('Not Found');
    }

    public function ElchiCreate(Request $request){

        $request->validate([
            'rol_id'=>'required',
            'status'=>'required',
            'phone'=>'required|unique:lms_users',
            'image'=>'required|image|mimes:png,jpg,jpeg',
            'passport_image'=>'required|image|mimes:png,jpg,jpeg',
        ]);
        $phone = $request->phone;
        $tg_user_id = $request->tg_user_id;
        $tg_user = DB::table('tg_user')->where('id',$tg_user_id)->first();

        $data = new User();
        $data->first_name = $tg_user->first_name;
        $data->last_name = $tg_user->last_name;
        $data->birthday = $tg_user->birthday;
        $data->region_id = $tg_user->region_id;
        $data->district_id = $tg_user->district_id;
        $data->status = $request->status;
        $data->tg_user_id = $tg_user_id;
        $data->date_joined = now();
        $data->phone = $phone;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(5) .'.'.$image->getClientOriginalExtension();
            $directory = 'users';
            $image->storeAs("public/{$directory}", $imageName);
            $data->image = $directory.'/'.$imageName;
        }
        if ($request->hasFile('passport_image')) {
            $image = $request->file('passport_image');
            $imageName = Str::random(5) .'.'.$image->getClientOriginalExtension();
            $directory = 'passport';
            $image->storeAs("public/{$directory}", $imageName);
            $data->passport_image = $directory.'/'.$imageName;
        }
        $number = rand(1000,10000);
        $username = 'nvt'.$number;
        $data->username = $username;
        $data->password = Hash::make($number);

        if ($request->rol_id){
            $data->rol_id = $request->rol_id;
        }
        if (!$data->save()){
            return redirect(route('register'))->with('error','Ro\'yxatdan o\'tishda xatolik bor');
        }

        $response = Http::post('notify.eskiz.uz/api/auth/login', [
            'email' => 'mubashirov2002@gmail.com',
            'password' => 'PM4g0AWXQxRg0cQ2h4Rmn7Ysoi7IuzyMyJ76GuJa'
        ]);
        $token = $response['data']['token'];

        $sms = Http::withToken($token)->post('notify.eskiz.uz/api/message/sms/send', [
            'mobile_phone' => substr($phone,1),
            'message' => 'Assalomu alaykum, siz Novatio kompaniyasing Akademiyasiga qabul qilindingiz! '  .  ' Login: ' . $username . '. ' . ' Parol: ' . $number,
            'from' => '4546',
            'callback_url' => 'http://0000.uz/test.php'
        ]);

        return redirect(route('elchi-index'))->with('success','Elchi muvaffaqiyatli qo\'shildi');

    }

    public function ElchiUpdate(Request $request, $id){

        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'birthday'=>'required',
            'rol_id'=>'required',
            'region_id'=>'required|integer',
            'district_id'=>'required|integer',
            'status'=>'required',
//            'phone'=>'required|unique:lms_users',
//            'image'=>'required|image|mimes:png,jpg,jpeg',
//            'passport_image'=>'required|image|mimes:png,jpg,jpeg',
        ]);
        $elchi = User::find($id);
//        return $elchi;
        $elchi->first_name = $request->first_name;
        $elchi->last_name =$request->last_name;
        $elchi->birthday =$request->birthday;
        $elchi->status = $request->status;
        $elchi->region_id = $request->region_id;
        $elchi->district_id = $request->district_id;
        $elchi->tg_user_id = $request->tg_user_id;
        $elchi->rol_id = $request->rol_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(5) .'.'.$image->getClientOriginalExtension();
            $directory = 'users';
            $image->storeAs("public/{$directory}", $imageName);
            $elchi->image = $directory .'/'.$imageName;
        }
        if ($request->hasFile('passport_image')) {
            $image = $request->file('passport_image');
            $imageName = Str::random(5) .'.'.$image->getClientOriginalExtension();
            $directory = 'passport';
            $image->storeAs("public/{$directory}", $imageName);
            $elchi->passport_image = $directory.'/'.$imageName;
        }
        $elchi->save();
        return redirect(route('elchi-index'))->with('success','Elchi muvaffaqiyatli tahrirlandi!');
    }

    public function ElchiDelete($id){
        User::destroy($id);
        return redirect(route('elchi-index'))->with('success','Elchi muvaffaqiyatli o\'chirildi!');
    }
}
