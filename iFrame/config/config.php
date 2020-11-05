<?php

return [
    //数据库相关配置
    'db_host' => '127.0.0.1',
    'db_user' => 'root',
    'db_pwd' => '',
    'db_name' => 'iframe',
    'db_table_prefix' => 'iframe_',    //数据表前缀
    'db_charset' => 'utf8',

    'default_module' => 'home',    //默认模块
    'default_controller' => 'Index',    //默认控制器
    'default_actions' => 'index',    //默认操作方法
    'url_type' => 2,    // RUL模式：【1：普通模式，采用传统的 url 参数模式】【2：PATHINFO 模式，也是默认模式】

    'cache_path' => RUNTIME_PATH . 'cache' . DS,    //缓存存放路径
    'cache_prefix' => 'cache_',    //缓存文件前缀
    'cache_type' => 'file',        //缓存类型（只实现 file 类型）
    'compile_path' => RUNTIME_PATH . 'compile' . DS,    //编译文件存放路径

    'view_path' => APP_PATH . 'home' . DS . 'view' . DS,    // 模板路径
    'view_suffix' => '.php',    // 模板后缀

    'auto_cache' => true,    //开启自动缓存
    'url_html_suffix' => 'html',     // URL伪静态后缀

];