<?php


namespace App\Http\Validations\Admin;


class IndexValidation
{
    public function login()
    {
        return [
            'rules' => [
                'name'     => 'required',
                'password' => 'required'
            ],
            'message' => [
                'name.required'     => '用户名必须填',
                'password.required' => '密码必须填'
            ]
        ];
    }
}