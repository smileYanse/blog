<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/22 0022
 * Time: 11:46
 */

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $return = [
            'title' => '首页'
        ];
        return view('user/index', $return);

    }


}