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
namespace app\m;
use think\facade\Route;




Route::rule('novel_list/list/:id','NovelList/index/', "get");
Route::rule('novel/chapter/:id','Novel/chapter', "get");
Route::rule('novel/:id','Novel/index/', "get");
Route::rule('login','Login/index/', "get");
Route::rule('login','Login/index', "post");

Route::rule('logout','Login/logout', "get");
Route::rule('bookshelf/add','BookShelf/add', "get");
Route::rule('bookshelf/del','BookShelf/del', "get");
Route::rule('bookshelf','BookShelf/index', "get");
Route::rule('register','Register/index', "post");
Route::rule('register','Register/index', "get");