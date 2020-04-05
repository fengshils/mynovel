<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\index\controller\Common;
use think\Exception;
use think\facade\Db;
use think\facade\Request;
use think\facade\View;

class Category extends Common
{
    public function index($id)
    {

        try{
            $all = Request::param();


            $cat['lists'] = Db::table('category')->where('f_id',$all['f_id'])->select();

            $d_top_list = Db::table("novel")->where("status",0)->order("d_hits")->limit(10)->select();
//            $recommend1_novel_list = Db::table("novel")->where("status",0)->order("d_hits")->limit(10)->select();
            $novel_list = Db::table("novel")->where("c_id", $id)->paginate(30);
            View::assign([
                "cat"=> $cat,
                "d_top_list"=>$d_top_list,
                'novel_list'=>$novel_list,
            ]);
            return View::fetch($this->sys_set['site_pc_template'].'/category');
        }catch (Exception $e){
            $cat = Db::table('category')->where("id",$id)->find();
            $cat['lists'] = Db::table('category')->where('f_id',$cat['f_id'])->select();
            $d_top_list = Db::table("novel")->where("status",0)->order("d_hits")->limit(10)->select();
//            $recommend1_novel_list = Db::table("novel")->where("status",0)->order("d_hits")->limit(10)->select();

            $novel_list = Db::table("novel")->whereIn("c_id",$id)->paginate(30 );

            View::assign([
                "cat"=> $cat,
                "d_top_list"=>$d_top_list,
                'novel_list'=>$novel_list,
            ]);
            return View::fetch($this->sys_set['site_pc_template'].'/category');
        }
    }
}