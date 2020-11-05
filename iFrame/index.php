<?php

//框架入口文件
define('DS', DIRECTORY_SEPARATOR);    //定义目录分隔符（上面用到过）
define('ROOT_PATH', __DIR__ . DS);    //定义框架根目录
require 'sys/start.php';    //引入框架启动文件
core\App::run();    //框架启动