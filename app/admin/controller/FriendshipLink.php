<?php
declare (strict_types = 1);

namespace app\admin\controller;
use function PHPSTORM_META\type;
use think\facade\Db;
use think\facade\View;
use think\facade\Request;

class FriendshipLink
{
    protected $middleware = ['app\admin\middleware\CheckLogin'];
    public function index()
    {
        $cats = Db::table('friendship_links')->select();

        View::assign("cats", $cats);
        return View::fetch('');
    }

    public  function  add() {

        if(Request::method() == 'POST'){
            $all = Request::param();

            $insert = Db::table('friendship_links')->insert($all);
            if($insert){
                echo json_encode(['code'=>0,'msg'=>'添加成功']);
            }else{
                echo json_encode(['code'=>1,'msg'=>'添加失败']);
            }
        }else{
            return View::fetch();
        }
    }


    public function edit()
    {
        if(Request::method() == 'POST'){
            $all = Request::param();

            $update = Db::table('friendship_links')->where('id',$all['id'])->update($all);
            if($update){
                echo json_encode(['code'=>0,'msg'=>'修改成功']);
            }else{
                echo json_encode(['code'=>0,'msg'=>'修改失败']);

            }
        }else{
            $id = Request::param('id');
            $cats = Db::table('friendship_links')->find($id);

            View::assign("cats", $cats);

            return View::fetch();
        }
    }

    public function del()
    {
        if (Request::method() == 'POST') {
            $id = Request::param('id');
            // $delete = Db::table('shop_goods')->where('id',$id)->delete();
            $delete = Db::table('friendship_links')->where('id', $id)->delete();
            if ($delete) {
                echo json_encode(['code' => 0, 'msg' => '删除成功']);
            } else {
                echo json_encode(['code' => 1, 'msg' => '删除失败']);
            }
        }
    }


}
