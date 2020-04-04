<?php
declare (strict_types = 1);

namespace app\m\controller;
use think\exception\ValidateException;
use think\facade\Db;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;

class Register extends Common {
    public function index(){
        $all = Request::param();
        array_shift($all);

        if(Request::method() == "POST"){
            try {
                validate(\app\m\validate\Register::class)->check($all);
            } catch (ValidateException $e) {
                // 验证失败 输出错误信息
                dump($e->getError());
                return json(['code'=>1, "msg"=>$e->getError()]);
            }
            $insert = Db::table("front_users")->insert([
                'username'=> $all['username'],
                'password'=> md5($all['password']),
                'nickname'=> $all['nickname'],
            ]);
//            $user = Db::table("front_users")->where('username', $all['username'])->find();

            if($insert){
                Session::set('username', $all['username']);
                return json(['code'=>0, "msg"=>'注册成功']);
            }else{
                return json(['code'=>1, "msg"=>'注册失败，原因未知']);
            }
        }else{
            return View::fetch($this->sys_set['site_m_templte'].'/register');
        }
    }


}