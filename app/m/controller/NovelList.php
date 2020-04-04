<?php
declare (strict_types = 1);

namespace app\m\controller;

use app\m\controller\Common;
use think\facade\Request;
use think\facade\View;
use think\facade\Db;


class NovelList extends  Common
{
    public function index($id)
    {
        $all = Request::param();
        $cats = Db::table('novel')->where('status',0)->where("c_id", $id)->order('update_time','desc')->paginate(20 );
        $likes = Db::query("SELECT * FROM novel where c_id=".$id ." ORDER BY RAND()  LIMIT 5");

        View::assign([
            'likes' => $likes,
            'cats'=> $cats,
        ]);

        return View::fetch($this->sys_set['site_m_templte'].'/list');
    }


}