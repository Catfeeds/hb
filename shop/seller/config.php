<?php
//配置文件
return [
	
	//静态文件变量
	'view_replace_str' => [
        '__PUBLIC__' => '/public',
        '__ROOT__' => '',
        '__SELLER__' => '/static/seller',
        '__STATIC__' => '/static'
    ],
    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'seller', //session只在seller模块有效
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],
];