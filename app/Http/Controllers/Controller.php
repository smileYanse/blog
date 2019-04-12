<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function jsonReturn($code = 1, $msg = '', $info = '')
    {
        $arr = [
            'code' => $code,
            'msg' => $msg,
            'info' => $info
        ];

//        return response()->json($arr);
        return response($arr);
    }
}
