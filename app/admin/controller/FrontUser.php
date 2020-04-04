<?php
declare (strict_types = 1);

namespace app\admin\controller;
use function PHPSTORM_META\type;
use think\facade\Db;
use think\facade\View;
use think\facade\Request;
use app\admin\model\FrontUser as FontUserModel;


class FrontUser
{
    protected $middleware = ['app\admin\middleware\CheckLogin'];
    public function index()
    {
        $cats = FontUserModel::where('status','<>',2)->paginate(20);

        View::assign("cats", $cats);
        return View::fetch('');

    }

    public  function  add() {

        if(Request::method() == 'POST'){
            $all = Request::param();
            $all['password'] = md5($all['password']);
            $front_user = new FontUserModel();
            $insert = $front_user->insert($all);
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
                $arr = ['username' => $all['username'],
                    'nickname' => $all['nickname'],
                    'email' => $all['email'],
                    'phone' => $all['phone']
                ];
                $update = FontUserModel::update($arr, ['id' => $id]);
            }else{
                $arr = ['username' => $all['username'],
                    'password' => md5($all['password']),
                    'nickname' => $all['nickname'],
                    'email' => $all['email'],
                    'phone' => $all['phone']
                ];
                $update = FontUserModel::update($arr, ['id' => $id]);
            }


            if($update){
                echo json_encode(['code'=>0,'msg'=>'修改成功']);
            }else{
                echo json_encode(['code'=>0,'msg'=>'修改失败']);

            }
        }else{
            $id = Request::param('id');
            $front_user = FontUserModel::find($id);
            View::assign("front_user", $front_user);
            return View::fetch();
        }
    }

    public function del()
    {
        if (Request::method() == 'POST') {
            $id = Request::param('id');
            // $delete = Db::table('shop_goods')->where('id',$id)->delete();
            $delete = Db::table('front_users')->where('id', $id)->update(['status' => 2]);
            if ($delete) {
                echo json_encode(['code' => 0, 'msg' => '删除成功']);
            } else {
                echo json_encode(['code' => 1, 'msg' => '删除失败']);
            }
        }
    }


}
