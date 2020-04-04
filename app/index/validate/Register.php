<?php
namespace app\idnex\validate;

use think\Validate;

class Register extends Validate
{
    protected $rule =   [
        'username'  => 'require|max:25',
        'password'=>'require|confirm:confirm|length:6,25',
        'nickname' => 'require|max:25',

    ];

    protected $message  =   [
        'username.require' => '名称必须',
        'username.max'     => '名称最多不能超过25个字符',
        'password.require'   => '密码必须',
        'password.length'  => '密码最少6位，最多25位',

    ];

}
