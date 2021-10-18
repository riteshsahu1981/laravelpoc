<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        if (!$request->session()->has('username')) {
            $request->session()->flash('status', 'Unauthorized access. Please login.');
            return redirect('/login');
        }else{
            //echo "I am login action in AuthController";
            $status=$request->session()->get('status', '');
            $user = Users::where(['username'=>$request->session()->get('username')])->first();
            $moodleUrl="http://moodle.localhost.com/create-login.php?firstname=".$user->name."&lastname=LastName&email=".$user->email."&username=".$user->username.'_'.$user->school_code.'_'.$user->class_code;
            return view('home.dashboard', ['status' => $status, 'moodleUrl'=>$moodleUrl]);
        }
    }
}
