<?php

namespace core;
//定义命名空间

use core\Config;

//使用配置类
use core\Router;

//使用路由类

/**
 * 框架启动类
 */
class App
{
    //启动
    public static $router;    //定义一个静态路由实例

    public static function run()
    {
        self::$router = new Router();    //实例化路由类
        self::$router->setUrlType(Config::get('url_type'));     //读取配置并设置路由类型
        $url_array = self::$router->getUrlArray();    //获取经过路由类处理生成的路由数组
        self::dispatch($url_array);        //根据路由数组分发路由
    }

    //路由分发
    public static function dispatch($url_array = [])
    {
        $module = '';
        $controller = '';
        $action = '';
        if (isset($url_array['module'])) {    //若路由中存在 module，则设置当前模块
            $module = $url_array['module'];
        } else {
            $module = Config::get('default_module');    //不存在，则设置默认的模块（home）
        }
        // var_dump($module);
        if (isset($url_array['controller'])) {    //若路由中存在 controller，则设置当前控制器，首字母大写
            $controller = ucfirst($url_array['controller']);
        } else {
            $controller = ucfirst(Config::get('default_controller'));    //不存在，则设置默认的控制器（index）,首字母大写
        }
        // var_dump($controller);
        //拼接控制器文件路径
        $controller_file = APP_PATH . $module . DS . 'controller' . DS . $controller . 'Controller.php';
        if (isset($url_array['action'])) {        //同上，设置操作方法
            $action = $url_array['action'];
        } else {
            $action = Config::get('default_action');
        }
        // var_dump($action);
        //判断控制器文件是否存在
        if (file_exists($controller_file)) {
            require $controller_file;        //引入该控制器
            $className = 'module\controller\IndexController';        //命名空间字符串示例
            $className = str_replace('module', $module, $className);    //使用字符串替换功能，替换对应的模块名和控制器名
            $className = str_replace('IndexController', $controller . 'Controller', $className);
            $controller = new $className;    //实例化具体的控制器
            //判断访问的方法是否存在
            if (method_exists($controller, $action)) {
                $controller->setTpl($action);    //设置方法对应的视图模板
                $controller->$action();        //执行该方法
            } else {
                die('The method does not exist');
            }
        } else {
            die('The controller does not exist');
        }
    }
}