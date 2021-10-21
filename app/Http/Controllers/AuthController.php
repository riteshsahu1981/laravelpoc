<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Autologin;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        //echo "I am login action in AuthController";
        $status=$request->session()->get('status', '');
        return view('auth.login',['status'=>$status]);
    }

    public function logout(Request $request)
    {
        $username=$request->session()->get('username');
        $user = Users::where(['username'=>$username])->first();
        $autologin=Autologin::where(['laravel_username' => $username])->first();
        if(!is_null($autologin)){
            $autologin->delete();
            $moodleBaseUrl= env('MOODLE_URL', "http://moodle.localhost.com");
            $response = Http::asForm()->post($moodleBaseUrl."/autologin/logout.php", [
                "moodle_username" => $user->username.'_'.$user->school_code.'_'.$user->class_code,
                "laravel_username" => $user->username
            ]);
            //var_dump($response->body()); exit;
        }
        $request->session()->flush();
        $request->session()->flash('status', 'logout');

        return redirect('/login');
    }

    public function authenticate(Request $request)
    {
        $username=$request->input("username");
        $password=$request->input("password");


        $user = Users::where(['username'=>$username])->first();
        if(is_null($user)){
            $request->session()->flash('status', 'Invalid Username.');
            return redirect('/login');
        }else if(Hash::check($password, $user->password)) {
            $request->session()->put('username', $user->username);
            $request->session()->flash('status', 'You have loggedin successfully');
            return redirect('/');
        }
        $request->session()->flash('status', 'Invalid Password.');
        return redirect('/login');
    }

    public function autologout(Request $request){
        $moodle_username=$request->input("moodle_username");
        $autologin=Autologin::where(['moodle_username' => $moodle_username])->first();
        if(!is_null($autologin)){
            $autologin->login_status = 0;
            $autologin->save();
        }
        echo "OK";
    }
}
