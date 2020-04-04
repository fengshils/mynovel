<?php
namespace app\admin\model;

use think\helper\Str;
use think\Model;

class Category extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'category';

    public function catetree(){
        $cateres = $this->where('status','<>', 2)->select();


        return $this->sort($cateres);
    }

    public function sort($data, $f_id=0, $level=0){
        static  $arr=array();
        foreach ($data as $k => $v){
            if($v['f_id'] == $f_id){
                $v['level'] =$level;
                $arr[]=$v;
                $this->sort($data,$v['id'], $level+1);
            }
        }
        return $arr;
    }
}