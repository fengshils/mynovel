<?php
declare (strict_types = 1);

namespace app\admin\controller;
use think\facade\Request;
use think\facade\View;

class Index
{
    protected $middleware = ['app\admin\middleware\CheckLogin'];
    public function index()
    {
        return View::fetch('');
    }

    public function upload(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        // 上传到本地服务器
        $savename = \think\facade\Filesystem::putFile( 'topic', $file);
        $path=\think\Facade\Filesystem::getDiskConfig('public', 'url') . '/' . str_replace('\\', '/', $savename);
        $data = [
            "code"=> 0 //0表示成功，其它失败
          ,"msg"=> "" //提示信息 //一般上传失败后返回
          ,"data"=> [
                    "src"=>$path
            ,"title"=> $savename //可选
          ]
        ];
        return json($data);
    }



}
