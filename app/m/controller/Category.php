<?php
declare (strict_types = 1);

namespace app\m\controller;

use think\facade\Db;
use think\facade\Request;
use think\facade\View;

class Category extends Common
{
    public function index()
    {
        $id =  Request::param('id');
        $cats = Db::table("category")->where("id", $id)->select()->each(function($item, $key){
        $item['lists'] = Db::table("category")->where("f_id", $item['id'])->select();
        return $item;
    });
        View::assign([
            "cats"=>$cats,
        ]);
        return View::fetch($this->sys_set['site_m_templte'].'/cate');
    }
}