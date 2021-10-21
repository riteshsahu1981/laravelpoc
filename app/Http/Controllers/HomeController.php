<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Autologin;
class HomeController extends Controller
{
    public function dashboard(Request $request)
    {

        if (!$request->session()->has('username')) {
            $request->session()->flash('status', 'Unauthorized access. Please login.');
            return redirect('/login');
        }else{
            $autologin=Autologin::where(['laravel_username' => $request->session()->get('username')])->first();
            if(!is_null($autologin) && $autologin->login_status==0){
                $autologin->delete();

                $request->session()->flush();
                $request->session()->flash('status', 'logout');
                return redirect('/');
            }
            $status=$request->session()->get('status', '');
            return view('home.dashboard', ['status' => $status]);
        }
    }
    public function autologin(Request $request){
        $username=$request->session()->get('username');
        $user = Users::where(['username'=>$username])->first();
        $autologin = Autologin::firstOrNew(array('laravel_username' => $username));
        $autologin->moodle_username = $user->username.'_'.$user->school_code.'_'.$user->class_code;
        $autologin->login_status=1;
        $autologin->save();

        $arrParams=array(
            "firstname" => $user->name,
            "lastname" => "LastName",
            "email" => $user->email,
            "moodle_username" => $user->username.'_'.$user->school_code.'_'.$user->class_code,
            "laravel_username" => $user->username
        );
        $moodleBaseUrl= env('MOODLE_URL', "http://moodle.localhost.com");
        $jsonPayload=base64_encode(json_encode($arrParams));
        $moodleUrl=$moodleBaseUrl."/autologin/login.php?enc_pl=".$jsonPayload;
        return redirect($moodleUrl);
    }
}
