<?php
namespace App\Http\Controllers\Admin;


class IndexController extends Controller
{
    public function login()
    {
        return $this->success(['info' => 2],'success');
    }
}