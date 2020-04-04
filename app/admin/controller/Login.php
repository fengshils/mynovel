<?php
declare (strict_types = 1);

namespace app\admin\controller;
use think\facade\Db;
use think\facade\Session;
use think\facade\View;
use think\facade\Request;
use think\response\Redirect;

class Login
{
    public function index()
    {
        if (Request::method() == 'POST') {
            $username = Request::param('username');
            $password = Request::param('password');
            if ($username && $password) {
                $user = Db::table("admin_users")->where("username", $username)->find();
                if (md5($password) == $user['password']) {
                    Session::set('Admin_username', $username);
                    return json(["code" => 0, "message" => "登陆成功"]);
                } else {
                    return json(["code" => 1, "message" => "登陆失败,账号或密码错误"]);
                }
            }
        } else {
            return View::fetch('');
        }
    }

        public function logout()
    {
        Session::clear();
        return \redirect('/admin/login');
    }
}