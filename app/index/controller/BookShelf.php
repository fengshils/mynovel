<?php
declare (strict_types = 1);

namespace app\index\controller;
use think\facade\Db;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;



class BookShelf extends Common
{
    protected $middleware = ['app\m\middleware\CheckLogin'];

    public function index()
    {
        $user = Db::table("front_users")->where("username", Session::get('username'))->find();
        $likes = Db::query("SELECT * FROM novel  ORDER BY RAND()  LIMIT 5");
        $novel_lists = Db::table("bookshelf")->where("u_id", $user['id'])->select()->each(function($item, $key){
        $item['detail'] = Db::table('novel')->where('id',$item['n_id'])->find();
        return $item;
    });
        // halt($novel_lists);
        View::assign([
            "likes"=>$likes,
            'novel_lists'=>$novel_lists,
        ]);

        return View::fetch($this->sys_set['site_pc_template'].'/bookshelf');
    }

    public function add(){

        $all = Request::param();
        $user = Db::table("front_users")->where("username", Session::get('username'))->find();
        try{
            $insert = Db::table("bookshelf")->insert(['n_id' => $all['n_id'], 'u_id' => $user['id'], 'chapter_id' => $all['chapter_id']]);
            if ($insert) {
                Session::flash('msg',"添加书架成功");
                return \redirect((string) url('Novel/index',['id'=>$all['n_id']]));
            } else {
                Session::flash('msg',"添加书架失败");
                return \redirect((string) url('Novel/index',['id'=>$all['n_id']]));
            }
        }catch(\Exception $e) {
            Session::flash('msg',"书籍已存在");
            return \redirect((string) url('Novel/index',['id'=>$all['n_id']]));
        }
    }

    public function del(){
            $all = Request::param();
            $del = Db::table("bookshelf")->where("id", $all['id'])->delete();
            if($del){
                Session::flash('msg',"删除成功");
                return \redirect((string) url('index'));
            }else{
                Session::flash('msg',"删除失败");
                return \redirect((string) url('index'));
                return \redirect((string) url('index'));
            }
        }


}