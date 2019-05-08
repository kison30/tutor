<?php
namespace App\Http\Controllers\Admin;


use App\Model\User;

class UserController extends Controller
{
    public function login()
    {
        $username = request('username','');
        $password = request('password','');
        $user = User::where('username',$username)->firstOrFail();
        if (!password_verify($password,$user->password)) {
            return $this->failed('登陆失败');
        }
        return $this->success(['token' => 'admin-token'],'success');
    }

    public function info()
    {
        $data = [
            'roles' => ['admin'],
            'introduction' => 'I am a super administrator',
            'avatar' => 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
            'name' => 'Super Admin'
        ];
        return $this->success($data,'success');
    }
}