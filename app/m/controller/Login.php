<?php
declare (strict_types = 1);

namespace app\m\controller;
use think\facade\Db;
use think\facade\Session;
use think\facade\View;
use think\facade\Request;
use think\response\Redirect;

class Login extends Common
{
    public function index()
    {
        if (Request::method() == 'POST') {
            $username = Request::param('username');
            $password = Request::param('password');

            if ($username && $password) {
                $user = Db::table("front_users")->where("username", $username)->find();
                if (md5($password) == $user['password']) {
                    if(  $user['status'] == 0){
                        Session::set('username', $username);
//                        return json(["code" => 0, "msg" => "登陆成功"]);
                        return \redirect((string) url('/m'));
                    }else{
                        return json(["code" => 1, "msg" => "登陆失败,用户已被禁用"]);
                    }

                } else {
                    return \redirect((string) url('/m'));
//                    return json(["code" => 1, "msg" => "登陆失败,账号或密码错误"]);
                }
            }
        } else {
            return View::fetch($this->sys_set['site_m_templte'].'/login');
        }
    }

        public function logout()
    {
        Session::clear();
        return \redirect((string) url('/m'));
    }
}