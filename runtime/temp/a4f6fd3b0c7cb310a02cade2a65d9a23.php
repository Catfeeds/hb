<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/seller\view\index\webcome.html";i:1519457349;s:79:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/seller\view\public\head.html";i:1515468240;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>商家后台</title>
    <link rel="stylesheet" href="__SELLER__/common/css/pintuer.css">
    <link rel="stylesheet" href="__SELLER__/lib/css/admin.css">
    <script src="__SELLER__/js/jquery.js"></script>
    <script src="__SELLER__/common/js/pintuer.js"></script>
    <script src="__SELLER__/common/js/respond.js"></script>
    <script type="text/javascript" src="__SELLER__/layer/layer.js"></script>
    <script type="text/javascript" src="__SELLER__/js/ajax_alert.js"></script>
    
    <!-- 编辑器 -->
    <link rel="stylesheet" href="__STATIC__/plugin/themes/default/default.css" />
    <script charset="utf-8" src="__STATIC__/plugin/kindeditor-min.js"></script>
    <script charset="utf-8" src="__STATIC__/plugin/lang/zh_CN.js"></script>

    <style>
        body /*overflow-x:hidden; */background-color: #eff3f6;
    </style>
</head>
<body>
    <div class="dux-tools">
        <div class="bread-head">首页
            <span class="small">网站首页</span>
        </div>
    </div>
    <div class="admin-main">
        <div class="line-big">
            <div class="xm12">
                <div class="alert alert-yellow"><strong>提示：</strong>尊敬的会员<?php echo \think\Session::get('user_login.username'); ?>(<?php echo \think\Session::get('user_login.mobile'); ?>)，欢迎您的使用，您的本次登录时间为 <?php echo date('Y-m-d H:i:s',\think\Session::get('in_time')); ?></div>
            </div>
        </div>
        <div class="line-big">
            <div class="xm3">
                <div class="panel dux-box dux-dashboard">
                    <div class="clearfix">
                        <div class="media media-x ">
                            <div class="float-left">
                                <div class="txt dashboard-head radius-small bg-red  icon-dashboard"></div>
                            </div>
                            <div class="media-body text-center">
                                <h2><strong><?php echo $info['money']; ?></strong></h2>
                                现 金
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="xm3">
                <div class="panel dux-box dux-dashboard">
                    <div class="clearfix">
                        <div class="media media-x ">
                            <div class="float-left">
                                <div class="txt dashboard-head radius-small bg-yellow icon-bar-chart-o"></div>
                            </div>
                            <div class="media-body text-center">
                                <h2><strong><?php echo $info['integral']; ?></strong></h2>
                                积 分
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="xm3">
                <div class="panel dux-box dux-dashboard">
                    <div class="clearfix">
                        <div class="media media-x ">
                            <div class="float-left">
                                <div class="txt dashboard-head radius-small bg-blue icon-paw"></div>
                            </div>
                            <div class="media-body text-center">
                                <h2><strong><?php echo $info['anzi']; ?></strong></h2>
                                华 宝
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="xm3">
                <div class="panel dux-box dux-dashboard">
                    <div class="clearfix">
                        <div class="media media-x ">
                            <div class="float-left">
                                <div class="txt dashboard-head radius-small bg-green icon-puzzle-piece"></div>
                            </div>
                            <div class="media-body text-center">
                                <h2><strong><?php echo $info['kucun_integral']; ?></strong></h2>
                                 库存积分
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>

        <div class="line-big">
            <div class="xm12">
                <div class="panel dux-box">
                    <div class="panel-head">商品信息</div>
                    <div class="panel-body">
                        <div style="height:200px;">
                            <canvas id="chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

