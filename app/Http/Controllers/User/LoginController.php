<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/22 0022
 * Time: 16:59
 */

namespace App\Http\Controllers\User;


use App\Common\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests\regValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        $return = ['title' => '登录'];
        return view('user/login', $return);
    }

    public function register()
    {
        $return = ['title' => '注册'];
        return view('user/register', $return);
    }

    //关于验证器--方法一
    public function user_reg(Request $request)
    {
        $data = $request->all();
        $rules = [
            'user_name' => 'required|max:45',
            'email' => 'required|email|unique:user',  //unique:user代表user表中的email字段为唯一值
            'password' => 'required'
        ];
        $messages = [
            'user_name.required' => '用户名不能为空',
            'email.require' => '邮箱不能为空',
            'email.email' => '邮箱地址不合法',
            'email.unique' => '邮箱已注册',
            'password.require' => '密码不能为空'
        ];


        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            /* $errors = $validator->errors()->toArray();
              $error = Common::getFirstError($errors);
             return $this->jsonReturn(0, $error);*/
            //或者
            $errors = $validator->errors()->first();
            return $this->jsonReturn(0, $errors);
        } else {
            //写数据
            $data['password'] = md5($data['password']);
            $data['update_time'] = $data['create_time'] = date('Y-m-d H:i:s', time());
            $res = DB::table('user')->insert($data);
            if ($res) {
                return $this->jsonReturn(1, '注册成功');
            } else {
                return $this->jsonReturn(0, '注册失败');
            }
        }

    }

    //关于验证器--方法二
    //创建regValidate.php验证器的命令 php artisan make:request regValidate
    /*   public function user_reg(regValidate $request)
       {
           $data = $request->all();
           if ($request->fails()) {
               $errors = $request->errors()->toArray();
               var_dump($errors); //得到的是json字符串  而不是对象
   //            return $this->jsonReturn(0, $errors);
           }else{
               return $this->jsonReturn(1, '注册成功');
           }

       }*/

    /**
     * 用户登录
     */
    public function user_login(Request $request)
    {

        $data = $request->all();
        if (!$data['email']) return $this->jsonReturn(0, '邮箱地址不能为空');
        if (!$data['password']) return $this->jsonReturn(0, '密码不能为空');

        $pattern = "/^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/";
        if (!preg_match($pattern, $data['email'])) return $this->jsonReturn(0, '邮箱地址不合法');

        //查找用户是否存在
        $user_info = DB::table('user')->select('*')->where('email', $data['email'])->first();

        if (!$user_info) return $this->jsonReturn(0, '用户不存在');
        if ($user_info->password == md5($data['password'])) {
            //记录session
            $map = [
                'id' => $user_info->id,
                'user_name' => $user_info->user_name,
                'pic_url' => $user_info->pic_url,
                'address' => $user_info->address
            ];
            $this->setSession($request, $map);
            return $this->jsonReturn(1, '登录成功');
        } else {
            $this->jsonReturn(0, '登录失败');
        }
    }

    //设置session
    private function setSession($request, $data)
    {
        if (!is_array($data)) {
            $request->session()->put($data, $data);
        } else {
            foreach ($data as $key => $datum) {
                $request->session()->put($key, $datum);
            }
        }
    }
}