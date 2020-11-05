<?php
//框架启动文件
define('APP_PATH', ROOT_PATH . 'app' . DS);    //定义应用程序目录路径
define('RUNTIME_PATH', ROOT_PATH . 'runtime' . DS);    //定义框架运行时目录路径
define('CONF_PATH', ROOT_PATH . 'config' . DS);        //定义全局配置目录路径
define('CORE_PATH', ROOT_PATH . 'sys' .DS . 'core' . DS);    //定义框架核心目录路径

//引入自动加载文件
require CORE_PATH.'Loader.php';

//实例化自动加载类
$loader = new core\Loader();
$loader->addNamespace('core',ROOT_PATH . 'sys' .DS . 'core');        //添加命名空间对应base目录
$loader->addNamespace('home',APP_PATH . 'home');
$loader->register();    //注册命名空间

//加载全局配置
\core\Config::set(include CONF_PATH . 'config.php');