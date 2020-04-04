<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace app\index;
use think\facade\Route;


Route::rule('','Index/index/', "get");
Route::rule('category/:id','Category/index', "get");
Route::rule('novel/test','Novel/test', "get");
Route::rule('novel/:id','Novel/index', "get");
Route::rule('chapter/:id','Novel/chapter', "get");
Route::rule('login','Login/index', "get");
Route::rule('login','Login/index', "post");
Route::rule('logout','Login/logout', "get");
//Route::rule('novel_list/list/:id','NovelList/index/', "get");
//Route::rule('novel/chapter/:id','Novel/chapter', "get");
//Route::rule('novel/:id','Novel/index/', "get");
