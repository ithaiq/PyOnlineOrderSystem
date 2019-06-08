<?php

class db
{
    //定义私有静态变量保存实例
    private static $_instance;
    //定义私有静态变量保存连接
    private static $_conn;

    //定义私有构造函数
    private function __construct()
    {
    }

    //定义静态方法实例化类
    static public function getInstance()
    {
        //如果没有实例化则自己实例化
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        //返回实例
        return self::$_instance;
    }

    //定义数据库连接方法
    public static function connect()
    {
        //如果没有连接
        if (!self::$_conn) {
            //实例化连接
            self::$_conn = new mysqli('127.0.0.1', 'root', '123456', 'category');
            //数据库输出字符UTF8编码。页面中文显示不会乱码
            mysqli_query(self::$_conn, "set names UTF8");
        }
        //返回数据库连接
        return self::$_conn;
    }
}