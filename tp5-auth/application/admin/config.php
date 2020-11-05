<?php
//配置文件
return [
	'app_trace' =>  true,
	    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],
    // 是否自动转换URL中的控制器和操作名
    'url_convert'            => false,
];