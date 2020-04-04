<?php
declare (strict_types = 1);

namespace app\admin\controller;
use app\admin\model\Novel as NovelModel;
use app\admin\model\Chapter as ChapterModel;
use think\facade\Request;
use think\facade\Db;
use think\facade\View;

class Chapter
{
    protected $middleware = ['app\admin\middleware\CheckLogin'];
    public function index()
    {
//        $name = Request::param('name');
        $n_id = Request::param('n_id');
        $novel = Db::table("novel")->find($n_id);
        $novel_chapter = new ChapterModel();
        $novel_chapters = $novel_chapter::where('n_id', $n_id)->select();
        View::assign([
            'novel_chapters'=>$novel_chapters,
            "novel" =>$novel
        ]);

        return View::fetch('index');
    }

    public function edit()
    {
        if(Request::method() == 'POST'){
            $all = Request::param();
            $id = Request::param('id');

            $update = Db::table('chapter')->where('id',$id)->update(["name"=>$all['name'], "content"=>$all['content']]);
            $chapter = Db::table("chapter")->find($id);
            if($update){
                return redirect('/admin/chapter?n_id='.$chapter['n_id']);
            }else{
                return redirect('/admin/chapter/edit?id='.$all['id']);

            }
        }else{
            $id = Request::param('id');

            $chapter = Db::table("chapter")->find($id);
            $novel = Db::table("novel")->where("id",$chapter['n_id'])->find();
            View::assign("chapter", $chapter);
            View::assign("novel", $novel);
            return View::fetch();
        }
    }

}