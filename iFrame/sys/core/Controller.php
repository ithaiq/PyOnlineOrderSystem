<?php

namespace core;

use core\View;

//使用视图类

/**
 * 控制器基类
 */
class Controller
{
    protected $vars = [];    //模板变量
    protected $tpl;        //视图模板

    //变量赋值
    //将其设置为 final，子类不能改写
    final protected function assign($name, $value = '')
    {
        if (is_array($name)) {
            $this->vars = array_merge($this->vars, $name);
            return $this;
        } else {
            $this->vars[$name] = $value;
        }
    }
    //设置模板
    //同样为 final 类型，子类不能改写
    final public function setTpl($tpl = '')
    {
        $this->tpl = $tpl;
    }
    //模板展示
    //同上
    final protected function display()
    {
        $view = new View($this->vars);    //调用视图类
        $view->display($this->tpl);    //视图类展示方法
    }
}