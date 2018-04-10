<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/admin\view\config\system.html";i:1521184190;s:80:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/admin\view\public\layout.html";i:1515468228;}*/ ?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title>后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="generator" content="CoreThink">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no,email=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="apple-touch-icon" type="image/x-icon" href="__ROOT__/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="__ROOT__/logo.png">
    <link rel="stylesheet" type="text/css" href="__ADMIN__/libs/lyui/dist/css/lyui.min.css">
    <link rel="stylesheet" type="text/css" href="__ADMIN__/css/admin.css">
    
    <link rel="stylesheet" type="text/css" href="__ADMIN__/libs/lyui/dist/css/lyui.extend.min.css">
    <link rel="stylesheet" type="text/css" href="__ADMIN__/css/style.css">

    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="__ADMIN__/libs/jquery/1.x/jquery.min.js"></script>
     <link rel="stylesheet" href="__STATIC__/plugin/themes/default/default.css" />
    <script charset="utf-8" src="__STATIC__/plugin/kindeditor-min.js"></script>
    <script charset="utf-8" src="__STATIC__/plugin/lang/zh_CN.js"></script>

    <script type="text/javascript" src="__ADMIN__/layer/layer.js"></script>
    <script type="text/javascript" src="__ADMIN__/js/upload.js"></script>
    <script type="text/javascript" src="__ADMIN__/js/index.js"></script>

    <!-- 日期 -->
    <script type="text/javascript" src="__ADMIN__/libs/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="__ADMIN__/libs/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <!-- 日期js cs -->
    <link href="__ADMIN__/libs/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
    <link href="__ADMIN__/libs/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
    <style>
        .nav>li>a{
                padding: 6px 15px;
        }
        .navside .navside-nav.navside-second>li>a {
            padding: 3px 10px 3px 42px;
        }
    </style>
</head>
<body class="admin_config_group" >
    <div class="clearfix full-header">
        
                <!-- 顶部导航 -->
                <div class="navbar navbar-default navbar-fixed-top main-nav" role="navigation">
                    <div class="container-fluid">
                        <div>
                            <div class="navbar-header navbar-header-inverse">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-top">
                                    <span class="sr-only">切换导航</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" target="_blank" href="__ROOT__/">
                                    <span><b><span style="color: #2699ed;">后台管理</span></b></span>
                                </a>
                            </div>
                            <div class="collapse navbar-collapse navbar-collapse-top">
                                <ul class="nav navbar-nav">
                                    <!-- 主导航 -->
                                    <li <?php if (controller_name()=='Index' && model_name()=='Admin') {
                                       echo "class='active'";
                                    } ?> ><a href="<?php echo url('admin/Index/index'); ?>"><i class="fa fa-home"></i> 首页</a></li>
                                    <?php if(is_array($_menu_list_g) || $_menu_list_g instanceof \think\Collection || $_menu_list_g instanceof \think\Paginator): if( count($_menu_list_g)==0 ) : echo "" ;else: foreach($_menu_list_g as $key=>$g_val): ?>
                                    <li <?php if ($_menu_tab['gid']==$g_val['id'] && controller_name()!='Index') {
                                       echo "class='active'";
                                    } ?> >
                                    <a href="<?php echo $g_val['url']; ?>" target="">
                                        <i class="fa <?php echo $g_val['icon']; ?>"></i>
                                        <span><?php echo $g_val['name']; ?></span>
                                    </a>
                                    </li> 
                                   <?php endforeach; endif; else: echo "" ;endif; ?>                                                  
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="<?php echo url('admin/Index/removeRuntime'); ?>" style="border: 0;text-align: left" class="btn ajax-get no-refresh"><i class="fa fa-trash"></i> 清空缓存</a></li>
                                    <li><a target="_blank" href="__ROOT__/"><i class="fa fa-external-link"></i> 打开前台</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-user"></i> <?php echo \think\Session::get('user_auth.username'); ?> <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a target="_blank" href="__ROOT__/"><i class="fa fa-external-link"></i> 打开前台</a></li>
                                            <li><a href="<?php echo url('admin/Index/removeRuntime'); ?>" style="border: 0;text-align: left;" class="btn text-left ajax-get no-refresh"><i class="fa fa-trash"></i> 清空缓存</a></li>
                                            <li><a href="<?php echo url('admin/Login/logout'); ?>" class="ajax-get"><i class="fa fa-sign-out"></i> 退出</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        
    </div>

    <div class="clearfix full-container" id="full-container">
        
            <input type="hidden" name="check_version_url" value="<?php echo url('admin/Update/checkVersion'); ?>">
            <div class="container-fluid with-top-navbar" style="height: 100%;overflow: hidden;">
                <div class="row" style="height: 100%;">
                    <!-- 后台左侧导航 S-->
                    <div id="sidebar" class="col-xs-12 col-sm-3 sidebar tab-content">
                        <!-- 模块菜单 -->
                        <nav class="navside navside-default" role="navigation">
                            <?php if($_menu_list_p): ?>
                                <ul class="nav navside-nav navside-first">
                                    <?php if(is_array($_menu_list_p) || $_menu_list_p instanceof \think\Collection || $_menu_list_p instanceof \think\Paginator): $fkey = 0; $__LIST__ = $_menu_list_p;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_first): $mod = ($fkey % 2 );++$fkey;?>
                                        <li>
                                            <a data-toggle="collapse" href="#navside-collapse-<?php echo $_ns_first['id']; ?>-<?php echo $fkey; ?>">
                                                <i class="<?php echo $_ns_first['icon']; ?>"></i>
                                                <span class="nav-label"><?php echo $_ns_first['name']; ?></span>
                                                <span class="angle fa fa-angle-down"></span>
                                                <span class="angle-collapse fa fa-angle-left"></span>
                                            </a>
                                            <?php if(!(empty($_menu_list_c) || (($_menu_list_c instanceof \think\Collection || $_menu_list_c instanceof \think\Paginator ) && $_menu_list_c->isEmpty()))): ?>
                                                <ul class="nav navside-nav navside-second collapse in" id="navside-collapse-<?php echo $_ns_first['id']; ?>-<?php echo $fkey; ?>">
                                                    <?php if(is_array($_menu_list_c) || $_menu_list_c instanceof \think\Collection || $_menu_list_c instanceof \think\Paginator): $skey = 0; $__LIST__ = $_menu_list_c;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_second): $mod = ($skey % 2 );++$skey;if($_ns_first['id'] == $_ns_second['pid']): 
                                                            if($_ns_second['param']){
                                                                $_menu_url=url($_ns_second['mod'].'/'.$_ns_second['col'].'/'.$_ns_second['act'],array($_ns_second['param'] => $_ns_second['param_value'])); 
                                                            }else{
                                                                $_menu_url=url($_ns_second['mod'].'/'.$_ns_second['col'].'/'.$_ns_second['act']); 
                                                            }
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo $_menu_url; ?>" >
                                                                <i class="<?php echo $_ns_second['icon']; ?>"></i>
                                                                <span class="nav-label"><?php echo $_ns_second['name']; ?></span>
                                                            </a>
                                                        </li>
                                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            <?php endif; ?>
                        </nav>
                    </div>
                    <!-- 后台左侧导航 E-->

                    <!-- 右侧内容 S-->
                    
   <div id="main" class="col-xs-12 col-sm-9 main" style="overflow-y: scroll;">
        <!-- 面包屑导航 -->
        <ul class="breadcrumb">
            <li><i class="fa fa-map-marker"></i></li>
            <?php if(is_array($_menu_tab['name']) || $_menu_tab['name'] instanceof \think\Collection || $_menu_tab['name'] instanceof \think\Paginator): if( count($_menu_tab['name'])==0 ) : echo "" ;else: foreach($_menu_tab['name'] as $key=>$tab_v): ?>
            <li class="text-muted"><?php echo $tab_v; ?></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <li class="text-muted">基本设置</li>
        </ul>

        <!-- 主体内容区域 -->
        <div class="tab-content ct-tab-content">
            <div class="panel-body">
                <div class="builder formbuilder-box">
                    <div class="builder-tabs builder-form-tabs">
                        <ul class="nav nav-tabs">
                             <li>
                                <a href="<?php echo url('Config/group',array('group'=>1)); ?>">系统配置</a>
                            </li>
                            <li class="active" >
                                <a href="<?php echo url('Config/group',array('group'=>2)); ?>">基本设置</a>
                            </li>
                            <li class="">
                                <a href="<?php echo url('Config/group',array('group'=>4)); ?>">分销设置</a>
                            </li>
                            <li class="">
                                <a href="<?php echo url('Config/turntable'); ?>">转盘配置</a>
                            </li>
                            <li class="">
                                <a href="<?php echo url('Config/group',array('group'=>3)); ?>">网站开关</a>
                            </li>

                        </ul>
                    </div>
                    <div class="form-group"></div>
                    <div class="builder-container" >
                        <div class="row" >
                            <div class="col-xs-12" >
                                <form action="<?php echo url('Config/groupSave'); ?>" method="post" class="form-horizontal form form-builder" enctype="multipart/form-data">
                                <div class="form-type-list">
                                    <span style="color:#777" >公司收款账户,用于会员线下充值，通过线下转账到公司账户</span>
                                    <div class="form-group ">
                                        <label class="left control-label">公司收款账户名称：</label>
                                        <div style="width:61.5%" class="input-group">
                                            <input type="text" name="company_account_name" class="form-control" value="<?php echo $info['company_account_name']; ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="left control-label">公司收款账户开户行：</label>
                                        <div style="width:61.5%" class="input-group">
                                            <input type="text" name="company_account_bank" class="form-control" value="<?php echo $info['company_account_bank']; ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="left control-label">公司收款银行卡号：</label>
                                        <div style="width:61.5%" class="input-group">
                                            <input type="text" name="company_account_no" class="form-control" value="<?php echo $info['company_account_no']; ?>" >
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group "></div>
                                    <div class="form-group ">
                                        <label class="left control-label">会员注册赠送积分：</label>
                                        <div style="width:61.5%" class="input-group">
                                            <input type="text" name="reg_integral" class="form-control" value="<?php echo $info['reg_integral']; ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group item_config[TOGGLE_WEB_SITE] ">
                                        <label class="left control-label">
                                            <span>邀请注册开关：</span>
                                        </label>
                                        <div class="right">
                                            <div class="checkbox checkbox-slider--b-flat checkbox-slider-md">
                                                <label style="position: relative;">
                                                    <input id="_date_1" type="checkbox" <?php if($info['close_reg'] == '1'): ?>checked="checked"<?php endif; ?>>
                                                    <span style="color: #999;">关闭后不能邀请注册</span>
                                                    <input id="_date_1_input" type="hidden" name="close_reg" value="<?php echo $info['close_reg']; ?>">
                                                </label>
                                            </div>
                                            <script type="text/javascript">
                                                $(function(){
                                                    $(document).on('click', '#_date_1', function() {
                                                        var ch = $(this).is(':checked');
                                                        if (ch == true) {
                                                            $('#_date_1_input').val('1');
                                                        } else {
                                                            $('#_date_1_input').val('0');
                                                        }
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="left control-label">邀请人获得积分：</label>
                                        <div style="width:61.5%" class="input-group">
                                            <input type="text" name="parent_integral" class="form-control" value="<?php echo $info['parent_integral']; ?>" >
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label class="left control-label">默认库存：</label>
                                        <div style="width:61.5%" class="input-group">
                                            <input type="text" name="good_default" class="form-control" value="<?php echo $info['good_default']; ?>" >
                                            <span class="check-tips text-muted small">添加商品的默认库存</span>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label class="left control-label">库存预警：</label>
                                        <div style="width:61.5%" class="input-group">
                                            <input type="text" name="good_less" class="form-control" value="<?php echo $info['good_less']; ?>" >
                                            <span class="check-tips text-muted small">当商品库存少于库存预警数，将在商品列表页库存显示红色</span>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group ">
                                        <label class="left control-label">单笔最大提现额度：</label>
                                        <div style="width:61.5%" class="input-group">
                                            <input type="text" name="money_max" class="form-control" value="<?php echo $info['money_max']; ?>" >
                                            <span class="check-tips text-muted small">单笔最大提现额度，超出不能提现</span>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="left control-label">每天提现次数：</label>
                                        <div style="width:61.5%" class="input-group">
                                            <input type="text" name="money_date_count" class="form-control" value="<?php echo $info['money_date_count']; ?>" >
                                            <span class="check-tips text-muted small">每天最多可提现多少次,设置0不限制次数</span>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="left control-label">提现倍数：</label>
                                        <div style="width:61.5%" class="input-group">
                                            <input type="text" name="money_beishu" class="form-control" value="<?php echo $info['money_beishu']; ?>" >
                                            <span class="check-tips text-muted small">如填100，每次只能提100的倍数</span>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group ">
                                        <label class="left control-label">提现手续费：</label>
                                        <div style="width:61.5%" class="input-group">
                                            <p>T+0 工作日 手续费 <input type="text" name="money_fee_one" value="<?php echo $info['money_fee_one']; ?>" >%</p>
                                            <p>T+1 工作日 手续费 <input type="text" name="money_fee_three" value="<?php echo $info['money_fee_three']; ?>" >%</p>
                                            <p>T+3 工作日 手续费 <input type="text" name="money_fee_five" value="<?php echo $info['money_fee_five']; ?>" >%</p>
                                            <p>T+7 工作日 手续费 <input type="text" name="money_fee_seven" value="<?php echo $info['money_fee_seven']; ?>" >%</p>
                                            
                                        </div>
                                    </div> -->

                                <div class="form-group"></div>
                                <div class="form-group bottom_button_list">
                                    <a class="btn btn-primary submit ajax-post" type="submit" target-form="form-builder">确定</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>                   
</div>

                    <!-- 右侧内容 E-->
                    
                </div>


            </div>
        

    </div>

    <div class="clearfix full-footer">
        
    </div>

    <div class="clearfix full-script">
        <div class="container-fluid">
            <script type="text/javascript" src="__ADMIN__/libs/lyui/dist/js/lyui.min.js"></script>
            <script type="text/javascript" src="__ADMIN__/js/admin.js"></script>
            
    <script type="text/javascript" src="__ADMIN__/libs/lyui/dist/js/lyui.extend.min.js"></script>

        </div>
    </div>
    
</body>
</html>
