<?php
declare (strict_types = 1);

namespace app\m\controller;

use think\facade\Db;
use think\facade\View;


class Index extends Common
{



    public function index()
    {

        $rotation_charts = Db::table("rotation_chart")->select();
        $recommend1 = Db::table("recommend")->where("name","wap首页编辑推荐")->find();
        $recommend2 = Db::table("recommend")->where("name","wap首页经典推荐")->find();
//        halt( gettype($recommend1['n_id']));
        $recommend1_novel_list = Db::table('novel')->whereIn('id', $recommend1['n_id'])->select();
        $recommend2_novel_list= Db::table('novel')->whereIn('id', $recommend2['n_id'])->select();
        $last_update = Db::table('novel')->order('update_time','desc')->limit(10)->select();
        View::assign([
            'rotation_charts'=>$rotation_charts,
            'recommend1_novel_list'=>$recommend1_novel_list,
            'recommend2_novel_list'=>$recommend2_novel_list,
            'last_update'=>$last_update,
        ]);
        return View::fetch($this->sys_set['site_m_templte'].'/index');
    }
}
