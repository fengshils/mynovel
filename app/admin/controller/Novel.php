<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\Db;
use think\facade\View;
use think\facade\Request;
use \app\admin\model\Category as CategoryModel;
use \app\admin\model\Novel as NovelModel;
class Novel
{
    protected $middleware = ['app\admin\middleware\CheckLogin'];
    public function index()
    {
        $novel = new NovelModel();
        $novel_lists = $novel::where('status','<>',2)->order('id', 'desc')->order('create_time', 'desc')->paginate(20)->each(function($item, $key){
            $item['category'] = Db::table('category')->where('id',$item['c_id'])->value('name');
            return $item;
        });
        $count = $novel_lists->total();
        View::assign([
            'novel_lists'=>$novel_lists,
        ]);

        return View::fetch();
    }

    public function edit()
    {
        if(Request::method() == 'POST'){
            $all = Request::param();
            unset($all['file']);
            $update = Db::table('Novel')->where('id',$all['id'])->update($all);
            $novel = new NovelModel();
            $novel = $novel->find($all['id']);
            if($update){
                return redirect('/admin/novel?id='.$novel['id']);
            }else{
                return redirect('/admin/novel/edit?id='.$novel['id']);
            }
        }else{
            $id = Request::param('id');

            $category = new CategoryModel();
            $cats = $category->catetree();
            $novel = new NovelModel();
            $novel = $novel->find($id);
            View::assign("cats", $cats);
            View::assign("novel", $novel);
            return View::fetch();
        }
    }

    public function del()
    {
        if (Request::method() == 'POST') {
            $id = Request::param('id');
            // $delete = Db::table('shop_goods')->where('id',$id)->delete();
            $delete = Db::table('Novel')->where('id', $id)->update(['status' => 2]);
            if ($delete) {
                echo json_encode(['code' => 0, 'msg' => '删除成功']);
            } else {
                echo json_encode(['code' => 1, 'msg' => '删除失败']);
            }
        }
    }

    public function search()
    {
        $name = Request::param('name');
        $novel = new NovelModel();
        $novel_lists = $novel::where('name', $name)->where('status','<>',2)->order('id', 'desc')->order('create_time', 'desc')->paginate(20)->each(function($item, $key){
            $item['category'] = Db::table('category')->where('id',$item['c_id'])->value('name');
            return $item;
        });

        $count = $novel_lists->total();
        View::assign([
            'novel_lists'=>$novel_lists,
        ]);

        return View::fetch('index');
    }

}
