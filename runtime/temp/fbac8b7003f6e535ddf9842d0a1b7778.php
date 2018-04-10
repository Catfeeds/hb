<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/seller\view\index\index.html";i:1521121334;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>网站后台管理</title>
    <link rel="stylesheet" href="__SELLER__/common/css/pintuer.css">
    <link rel="stylesheet" href="__SELLER__/lib/css/admin.css">
    <script src="__SELLER__/js/jquery-1.9.1.min.js"></script>
    <script src="__SELLER__/common/js/pintuer.js"></script>
    <script src="__SELLER__/common/js/respond.js"></script>
    
</head>
<style>
    body,html{overflow: hidden;}
</style>
<body>
    <div class="dux-head clearfix">
        <div class="dux-logo">
            <a style="
    color: #fff;
    font-size: 20px;
    padding-top: 9px;
    display: block;
    font-weight: bold;
" href="javascript:" target="_blank">
                <!-- <img src="__SELLER__/lib/images/logo.png" alt="后台管理系统" /> -->
                商家管理系统
            </a>
            <button class="button icon-navicon admin-nav-btn" data-target=".admin-nav"></button>
            <button class="button icon-navicon icon-ellipsis-v admin-menu-btn" data-target=".admin-menu"></button>
        </div>
        <div class="dux-nav">
            <ul class="nav  nav-navicon nav-inline admin-nav" id="nav">
            </ul>
            <ul class="nav  nav-navicon nav-menu nav-inline admin-nav nav-tool">
			
               <!-- <li> <a href="" target="_blank" class="icon-home"></a></li> -->
                <!-- <li> <a href="" target="dux-iframe" class="icon-user"></a></li> -->
                <li> <a href="<?php echo url('Login/logout'); ?>" class="dux-logout bg-red icon-power-off"></a></li>
            </ul>
        </div>
    </div>
    <div class="dux-sidebar">
        <ul class="nav  nav-navicon admin-menu">
            <div class="nav-head icon-chevron-down" id="nav-head"></div>
            <div id="menu">
                <li><a href="" class="icon-"> </a></li>
            </div>
        </ul>
    </div>    
    <div class="dux-admin">
            <iframe id="dux-iframe" name="dux-iframe" class="dux-iframe" src="" frameborder="0"></iframe>
    </div>
</body>
<script>
    //生成主菜单icon-times
    var data = <?php echo $menu; ?>;
    var topNav = '';
    for(var i in data){
        if(data[i]['menu'] != ''){
            topNav += '<li><a href="javascript:;" data="'+i+'" url="" class="'+data[i].icon+'"> '+data[i].name+'</a></li>';
        }
    }
    $('#nav').html(topNav);
    //绑定导航连接
    $('#nav').on('click','a',function(){
        $('#nav-head').text($(this).text());
        var n = $(this).attr('data');
        var menu = data[n]['menu'];
        var menuHtml =  '';
        if(menu != ''){
            for(var i in menu){
                menuHtml += '<li><a href="javascript:;" url="'+menu[i].url+'" class="'+menu[i].icon+'"> '+menu[i].name+'</a></li>';
            }
        }
        $('#menu').html(menuHtml);
        //设置样式
        $('#nav li').removeClass('active');
        $(this).parent('li').addClass('active');
        //打开菜单
        $('#menu a:first').click();
    });
    //绑定菜单连接
    $('#menu').on('click','a',function(){
        var url = $(this).attr('url');
        $('.dux-iframe').attr('src',url);
        //设置样式
        $('#menu li').removeClass('active');
        $(this).parent('li').addClass('active');
    });
	var jsArray = {};	
    $('#nav a:first').click();
</script>
</html>