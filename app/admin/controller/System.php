<?php
declare (strict_types = 1);

namespace app\admin\controller;

use function PHPSTORM_META\type;
use think\facade\Db;
use think\facade\View;
use think\facade\Request;

use app\admin\model\System as SystemModel;

class system
{
    protected $middleware = ['app\admin\middleware\CheckLogin'];
    public function index()
    {
        $value = Db::table("system_settings")->find(1);

        if($value){
            $value = json_decode($value['value'], true);

            View::assign('value', $value);
            return View::fetch('edit');
        }else{
            return View::fetch();
        }

    }

    public function add(){
        if(Request::method() == 'POST'){
            $all = Request::param();

            $value = json_encode($all);

            $insert = Db::table("system_settings")->insert(['value'=>$value]);
            if($insert){
                echo json_encode(['code'=>0,'msg'=>'添加成功']);
            }else{
                echo json_encode(['code'=>1,'msg'=>'添加失败']);
            }
        }
    }

    public function edit(){
        if(Request::method() == 'POST'){
            $all = Request::param();

            $value = json_encode($all);

            $insert = Db::table("system_settings")->where('id',1)->update(['value'=>$value]);
            if($insert){
                echo json_encode(['code'=>0,'msg'=>'添加成功']);
            }else{
                echo json_encode(['code'=>1,'msg'=>'添加失败']);
            }
        }
    }

}
