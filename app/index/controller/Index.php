<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\index\controller\Common;
use think\facade\Db;
use think\facade\Request;
use think\facade\View;

class Index extends Common
{

    public function index()
    {
        $last_updates = Db::table('novel')->where(['status'=>0])->order("update_time", "desc")->limit(50)->select();
        $recommend1 = Db::table("recommend")->where("name","web首页推荐")->find();
        $recommend2 = Db::table("recommend")->where("name","web首页经典好书")->find();
        $recommend1_novel_list = Db::table('novel')->whereIn('id', $recommend1['n_id'])->select();
        $recommend2_novel_list= Db::table('novel')->whereIn('id', $recommend2['n_id'])->select();
        $d_top_list = Db::table("novel")->where("status",0)->order("d_hits")->limit(10)->select();
        $m_top_list = Db::table("novel")->where("status",0)->order("m_hits")->limit(10)->select();
        $a_top_list = Db::table("novel")->where("status",0)->order("a_hits")->limit(10)->select();
        View::assign([
           "last_updates"=>$last_updates,
            'recommend1_novel_list'=>$recommend1_novel_list,
            'recommend2_novel_list'=>$recommend2_novel_list,
            "d_top_list"=>$d_top_list,
            "m_top_list"=>$m_top_list,
            "a_top_list"=>$a_top_list
        ]);
        return View::fetch($this->sys_set['site_pc_template'].'/index');
    }
}
