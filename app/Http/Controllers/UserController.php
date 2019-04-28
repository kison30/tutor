<?php
namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $username = $request->input('username','');
        $password = $request->input('password','');
        $user = User::where('username',$username)->first();
        if (password_verify($password,$user->password)) {
            dd('success');
        } else {
            return redirect('/');
        }
    }
}