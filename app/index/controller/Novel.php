<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\index\controller\Common;
use think\facade\Db;
use think\facade\Request;
use think\facade\View;

class Novel extends Common
{
    public function index($id)
    {
        $novel = Db::table("novel")->find($id);
        $last_update = Db::table("chapter")->where('n_id',$novel["id"])->order("id","desc")->find();
        $last_chapters = Db::table('chapter')->where("n_id", $novel['id'])->order("id","desc")->limit(12)->select();
        $chapters = Db::table('chapter')->where("n_id", $novel['id'])->select();
        View::assign([
            "novel"=>$novel,
            "last_update"=>$last_update,
            "chapters"=>$chapters,
            "last_chapters"=>$last_chapters,
        ]);
        return View::fetch($this->sys_set['site_pc_template'].'/novel');
    }

    public function chapter($id)
    {
        $chapter = Db::table('chapter')->find($id);
        if($this->sys_set['site_save_type'] == "txt"){
            $chapter['content'] = file_get_contents($this->sys_set['site_save_path']."/".$chapter['n_id']."/".$chapter['id'].".txt");
        }
        $d_hits = Db::table("novel")->find($chapter["n_id"])["d_hits"]+1;
        Db::table("novel")->where("id",$chapter["n_id"])->update(['d_hits'=>$d_hits]);
        $likes = Db::query("SELECT * FROM novel  ORDER BY RAND()  LIMIT 5");
        $last = Db::table('chapter')->where("n_id", $chapter['n_id'])->where("id","<", $chapter['id'])->order('id', 'desc')->limit(1)->find();
        $next = Db::table('chapter')->where("n_id", $chapter['n_id'])->where("id",">", $chapter['id'])->limit(1)->find();

        View::assign([
            'chapter'=> $chapter,
            'likes'=> $likes,
            'last' => $last,
            'next' => $next
        ]);
        return View::fetch($this->sys_set['site_pc_template'].'/chapter');
    }

    public function test(){
        $file = fopen(__DIR__."/../../../Novel/1/1.txt","r");
        $str = file_get_contents(__DIR__."/../../../Novel/1/1.txt");
        halt($str);
        fclose($file);
//        return 'ok';
    }
}