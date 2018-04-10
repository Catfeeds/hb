<?php
//配置文件
$view_path='../tpl/mall/pc/';
$divs='pc';
// if(isMobile()){
	$view_path='../tpl/mall/wap/';
	$divs='wap';
// }
return [
	'template' => [
		// 模板路径
        'view_path' => $view_path,
        'layout_on'     =>  true,
    	'layout_name'   =>  'layout',
	],

	//静态文件变量
	'view_replace_str' => [
        '__JS__' => '/static/home/'.$divs.'/mall/js',
        '__ICON__' => '/static/home/'.$divs.'/mall/iconfont',
        '__IMG__' => '/static/home/'.$divs.'/mall/images',
        '__CSS__' => '/static/home/'.$divs.'/mall/css',
        '__HOME__' => '/static/home',
        '__COM__' => '/static/home/common',
    ],
];