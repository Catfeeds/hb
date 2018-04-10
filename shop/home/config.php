<?php
//配置文件
$view_path='../tpl/home/pc/';
$divs='pc';
// if(isMobile()){
	$view_path='../tpl/home/wap/';
	$divs='wap';
// }
return [
	'template' => [
		// 模板路径
        'view_path' => $view_path,
        'layout_on'     =>  true,
        'layout_name'   =>  'layout',
	],

	'view_replace_str' => [
        '__JS__' => '/static/home/'.$divs.'/home/js',
        '__ICON__' => '/static/home/'.$divs.'/home/iconfont',
        '__IMG__' => '/static/home/'.$divs.'/home/images',
        '__CSS__' => '/static/home/'.$divs.'/home/css',
        '__HOME__' => '/static/home',
        '__COM__' => '/static/home/common',
    ],
];