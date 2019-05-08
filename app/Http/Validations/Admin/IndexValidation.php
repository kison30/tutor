<?php


namespace App\Http\Validations\Admin;


class IndexValidation
{
    public function login()
    {
        return [
            'rules' => [
                'username' => 'required',
                'password' => 'required'
            ],
            'message' => [
                'username.required' => '用户名必须填',
                'password.required' => '密码必须填'
            ]
        ];

    }
}