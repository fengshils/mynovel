<?php

namespace app\idnex\middleware;

use think\facade\Session;

class CheckLogin
{
    public function handle($request, \Closure $next)
    {
        $username = Session::get('username');

        if(!$username){
            return redirect(url('Login/index'));
        }else{
            return $next($request);
        }
    }
}