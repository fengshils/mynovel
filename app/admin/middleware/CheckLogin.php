<?php

namespace app\admin\middleware;

use think\facade\Session;

class CheckLogin
{
    public function handle($request, \Closure $next)
    {
        $username = Session::get('Admin_username');

        if(!$username){
            return redirect(url('Login/index'));
        }else{
            return $next($request);
        }
    }
}