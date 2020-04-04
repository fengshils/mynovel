<?php
declare (strict_types = 1);

namespace app\admin\controller;
use function PHPSTORM_META\type;
use think\facade\Db;
use think\facade\View;
use think\facade\Request;
use app\admin\model\AdminUser as AdminUserModel;

class AdminUser
{
    protected $middleware = ['app\admin\middleware\CheckLogin'];
    public function index()
    {
        $cats = Db::table("admin_users")->where('status','<>',2)->select();

        View::assign("cats", $cats);
        return View::fetch('');

    }

    public  function  add() {

        if(Request::method() == 'POST'){
            $all = Request::param();
            $all['password'] = md5($all['password']);
            $admin_user = new AdminUserModel();
            $insert = $admin_user->insert($all);
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
            $id = Request::param('id');
            $all = Request::param();
            if(!$all['password']){
                $update = AdminUserModel::update(['username' => $all['username']], ['id' => $id]);
            }else{
                $all['password'] = md5($all['password']);
                $update = AdminUserModel::update(['username' => $all['username'],'password' => $all['password']], ['id' => $id]);
            }


            if($update){
                echo json_encode(['code'=>0,'msg'=>'修改成功']);
            }else{
                echo json_encode(['code'=>0,'msg'=>'修改失败']);

            }
        }else{
            $id = Request::param('id');
            $admin_user = new AdminUserModel();
            $admin_user = $admin_user->find($id);
          View::assign("admin_user", $admin_user);
            return View::fetch();
        }
    }

    public function del()
    {
        if (Request::method() == 'POST') {
            $id = Request::param('id');
            // $delete = Db::table('shop_goods')->where('id',$id)->delete();
            $delete = Db::table('category')->where('id', $id)->update(['status' => 2]);
            if ($delete) {
                echo json_encode(['code' => 0, 'msg' => '删除成功']);
            } else {
                echo json_encode(['code' => 1, 'msg' => '删除失败']);
            }
        }
    }


}
