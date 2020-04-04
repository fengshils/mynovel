<?php
declare (strict_types = 1);

namespace app\index\controller;

use app\m\controller\Common;

class Lists extends Common
{
    public function index()
    {
        return '您好！这是一个[index]示例应用';
    }
}