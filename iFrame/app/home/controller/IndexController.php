<?php

namespace home\controller;

use core\Controller;

/**
 * index控制器
 */
class IndexController extends Controller
{
    public function index()
    {
        $this->assign('name', 'test---Admin');    //模板变量赋值
        $this->display();    //模板展示
    }
}