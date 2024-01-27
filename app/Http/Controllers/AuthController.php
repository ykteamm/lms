<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function registerView()
    {
        if (Auth::check()){
            $user = Auth::user();
            if ($user && $user->rol_id === 'admin'){
                return redirect(route('admin'));
            }elseif ($user && $user->rol_id === 'assistant'){
                return redirect(route('admin'));
            }
            elseif ($user && $user->rol_id === 'user'){
                return redirect(route('user'));
            }
        }
        $region = Region::get(['name','id']);

        return view('auth.register',compact('region'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'birthday'=>'required',
            'region_id'=>'required|integer',
            'district_id'=>'required|integer',
            'phone'=>'required|unique:lms_users',
            'image'=>'required|image|mimes:png,jpg,jpeg',
            'passport_image'=>'required|image|mimes:png,jpg,jpeg',
        ]);
        $phone = $request->phone;
        $data = new User();
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->birthday = $request->birthday;
        $data->region_id = $request->region_id;
        $data->district_id = $request->district_id;
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
        }else{
            $data->rol_id = 'user';
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
            'message' => 'Assalomu alaykum, siz Novatio kompaniyasiga ishga kirish bo\'yicha ro\'yxatdan o\'tdingiz!' . ' ' . ' ' . 'Login: ' . $username . ' ' . '  ' . 'Parol: ' . $number,
            'from' => '4546',
            'callback_url' => 'http://0000.uz/test.php'
        ]);
        return redirect(route('login'))->with('success','Siz muvaffaqiyatli ro\'yxatdan o\'tdingiz!');
    }


    public function loginView()
    {
        if (Auth::check()){
            $user = Auth::user();
            if ($user && $user->rol_id === 'admin'){
                return redirect(route('admin'));
            }elseif ($user && $user->rol_id === 'assistant'){
                return redirect(route('admin'));
            }
            elseif ($user && $user->rol_id === 'user'){
                return redirect(route('user'));
            }
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        $credentials = $request->only('username','password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check the user's role and redirect accordingly
            if ($user->rol_id === 'admin') {
                return redirect(route('admin'))->with('success', 'Successfully logged in!');
            } elseif ($user->rol_id === 'assistant') {
                return redirect(route('admin'))->with('success', 'Successfully logged in!');
            }
            elseif ($user->rol_id === 'user' || $user->rol_id === 'old_user' || $user->rol_id === 'teacher') {
                return redirect(route('user'))->with('success', 'Successfully logged in!');
            }
            // Authentication passed
//            return redirect(route('user'))->with('success','Successfully enter!'); // Change the redirection URL
        }
        return redirect(route('login'))->with('error','Login details are not valid!');

    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }



    public function ChooseRegion(Request $request)
    {
        $data = District::select('id','name')->where('region_id',$request->region_id)->get();
        return response()->json($data);
    }


}
