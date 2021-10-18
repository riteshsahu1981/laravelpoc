<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
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
        $request->session()->flush();
        $request->session()->flash('status', 'You have been loggedout successfully');
        return redirect('/login');
    }
    public function authenticate(Request $request)
    {
        $username=$request->input("username");
        $password=$request->input("password");


        $user = Users::where(['username'=>$username])->first();
        if(is_null($user)){
            $request->session()->flash('status', 'Invalid Username.');
        }else if(Hash::check($password, $user->password)) {
            $request->session()->put('username', $user->username);
            $request->session()->flash('status', 'You have loggedin successfully');
            return redirect('/');
        }else{
            $request->session()->flash('status', 'Invalid Password.');
        }


    }
}
