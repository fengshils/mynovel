<?php
namespace app\admin\model;

use think\Model;

class FrontUser extends Model
{
    //
    // 设置当前模型对应的完整数据表名称
    protected $table = 'front_users';
    protected $autoWriteTimestamp = true;
}