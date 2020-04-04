<?php
declare (strict_types = 1);

namespace app\m\controller;
use think\facade\Db;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;



class Novel extends Common
{
    public function index($id)
    {
//        halt($id);

        $novel = Db::table('novel')->find($id);
        $likes = Db::query("SELECT * FROM novel where c_id=".$novel['c_id'] ." ORDER BY RAND()  LIMIT 5");
        $chapters = Db::table('chapter')->where("n_id", $novel['id'])->paginate(20 );
        $last_chapters= Db::table('chapter')->where("n_id", $novel['id'])->order("id", 'desc')->limit(5)->select();
        $last_chapter = Db::table('chapter')->where("n_id", $novel['id'])->order("id", 'desc')->limit(1)->find();
        View::assign([
            'likes' => $likes,
            'novel'=> $novel,
            "chapters" => $chapters,
            "last_chapters" => $last_chapters,
            'last_chapter' =>$last_chapter
        ]);

        return View::fetch($this->sys_set['site_m_templte'].'/novel');
    }

    public function chapter($id)
    {
        $chapter = Db::table('chapter')->find($id);
        if(!$this->sys_set['site_save_type'] == "mysql"){
            $chapter['content'] = file_get_contents(__DIR__."/../../../Novel/".$chapter['n_id']."/".$chapter['id'].".txt");
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
        return View::fetch($this->sys_set['site_m_templte'].'/chapter');
    }


}