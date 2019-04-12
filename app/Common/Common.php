<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/25 0025
 * Time: 16:17
 */

namespace App\Common;


class Common
{
    public static function getFirstError($errors)
    {
        if (!is_array($errors)) {
            $errors = json_decode($errors, true);
        }

        $firstError = array_shift($errors);
        if (!is_array($firstError)) {
            return true;
        }
        return array_shift($firstError);
    }
}