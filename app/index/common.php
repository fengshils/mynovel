<?php
// 这是系统自动生成的公共文件
namespace app\index\controller;

use think\facade\Db;
use think\facade\View;


class Common extends \app\BaseController
{
    public $sys_set;
    public $friendship_links;

    public function initialize()
    {
        //把字符串解析位数组使用
        $this->sys_set  =   json_decode(Db::table("system_settings")->find(1)['value'], true);
        $this->friendship_links = Db::table("friendship_links")->select();
        View::assign([
            "sys_set"=>$this->sys_set,
            "friendship_links" => $this->friendship_links,
        ]);

//        if (!session('id') || !session('name')) {
//            $this->error('您尚未登录系统', url('login/index'));
//        }
    }
}
