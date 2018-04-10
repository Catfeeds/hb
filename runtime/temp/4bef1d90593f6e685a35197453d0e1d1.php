<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/admin\view\shopstatus\detail.html";i:1519725829;s:80:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/admin\view\public\layout.html";i:1515468228;}*/ ?>
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
            <li class="text-muted">审核</li>
        </ul>

        <!-- 主体内容区域 -->
        <div class="tab-content ct-tab-content">
            <div class="panel-body">
                <div class="builder formbuilder-box">
                    <div class="form-group"></div>
                    <div class="builder-container" >
                            <div class="row" >
                                <div class="col-xs-12">
                                    <form action="<?php echo url('setDataStatus'); ?>" method="post" class="form-horizontal form form-builder">
                                        <div class="form-type-list">
                                            <div class="form-group hidden item_id ">
                                                <label class="left control-label">ID：</label>
                                                <div class="right">
                                                    <input type="hidden" class="form-control input" name="uid" value="<?php echo $info['uid']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">类型：</label>
                                                <div style="color:red" class="right">
                                                    <?php echo $info['user_type']==1?'企业用户':'个人用户'; ?>
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">用户：</label>
                                                <div class="right">
                                                   <?php echo $info['username']; ?>(<?php echo $info['mobile']; ?>) 
                                                </div>
                                            </div>
                                            
                                            <div class="form-group item_title ">
                                                <label class="left control-label">所在地区：</label>
                                                <div class="right">
                                                   <?php echo $info['province']; ?>、<?php echo $info['city']; ?>、<?php echo $info['district']; ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <?php if($info['user_type'] == '1'): ?>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">公司名称：</label>
                                                <div class="right">
                                                <?php echo $info['company_name']; ?>
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">是否三证合一：</label>
                                                <div class="right">
                                                <?php echo $info['is_three_card']==1?'是':'否'; ?>
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">是否分公司：</label>
                                                <div class="right">
                                                <?php echo $info['is_child_company']==1?'是':'否'; ?>
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">社会信用代码：</label>
                                                <div class="right">
                                                <?php echo $info['credit_no']; ?>
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">税务登记证：</label>
                                                <div class="right">
                                                <?php echo $info['tax_no']; ?>
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">组织机构证：</label>
                                                <div class="right">
                                                <?php echo $info['organize_no']; ?>
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">法人：</label>
                                                <div class="right">
                                                <?php echo $info['legal_name']; ?>
                                                </div>
                                            </div>
                                             <div class="form-group item_title ">
                                                <label class="left control-label">公司类型：</label>
                                                <div class="right">
                                                <?php echo $info['company_type']; ?>
                                                </div>
                                            </div>
                                             <div class="form-group item_title ">
                                                <label class="left control-label">经营负责人：</label>
                                                <div class="right">
                                                <?php echo $info['manage_parent']; ?>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">证件类型：</label>
                                                <div class="right">
                                                <?php echo $info['idcard_type']==1?'非大陆身份证':'大陆身份证'; ?>
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">身份证号：</label>
                                                <div class="right">
                                                <?php echo $info['idcard']; ?>
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">证件有效期：</label>
                                                <div class="right">
                                                <?php echo $info['idcar_startdate']; ?> 至 <?php echo $info['idcar_endtdate']; ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">证件照片：</label>
                                                <div class="right">
                                                        <a style="margin-right:5vmin" class="left" href="<?php echo $info['idcard_img_face']; ?>">
                                                           <img style="width:100%" src="<?php echo $info['idcard_img_face']; ?>" alt=""> 
                                                           <p style="text-align:center" >正面照</p>
                                                        </a>
                                                        <a style="margin-right:5vmin" class="left" href="<?php echo $info['idcard_img_back']; ?>">
                                                            <img style="width:100%" src="<?php echo $info['idcard_img_back']; ?>" alt="">
                                                            <p style="text-align:center" >反面照</p>
                                                        </a>
                                                         <a style="margin-right:5vmin" class="left" href="<?php echo $info['idcard_img_hand']; ?>">
                                                            <img style="width:100%" src="<?php echo $info['idcard_img_hand']; ?>" alt="">
                                                            <p style="text-align:center" >手持照</p>
                                                        </a>
                                                        <?php if(!(empty($info['company_license_img']) || (($info['company_license_img'] instanceof \think\Collection || $info['company_license_img'] instanceof \think\Paginator ) && $info['company_license_img']->isEmpty()))): ?>
                                                         <a style="margin-right:5vmin" class="left" href="<?php echo $info['company_license_img']; ?>">
                                                            <img style="width:100%" src="<?php echo $info['company_license_img']; ?>" alt="">
                                                            <p style="text-align:center" >营业执照</p>
                                                        </a>
                                                        <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <?php if(($info['user_type'] == 0 and $info['is_check_user'] == 1) OR ($info['user_type'] == 1 and $info['is_check_company'] == 1)): ?>
                                            <div class="form-group ">
                                                <label class="left control-label">回复信息：</label>
                                                <div style="width:61.5%" class="input-group">
                                                    <input type="text" name="content" class="form-control" >
                                                    <span class="check-tips text-muted small">回复内容、拒绝理由</span>
                                                </div>
                                            </div>
                                            <div class="form-group item_type ">
                                                <label class="left control-label">
                                                    <span>是否通过：</span>
                                                </label>
                                                <div class="right">
                                                    <div class="radio-inline lyui-control lyui-radio">
                                                        <label for="typemodule">
                                                            <input type="radio" id="typemodule" class="radio" name="agree" value="2"> 
                                                            <span class="lyui-control-indicator"></span>
                                                            <span>通过</span>
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline lyui-control lyui-radio">
                                                        <label for="typetheme">
                                                            <input type="radio" id="typetheme" class="radio" name="agree" value="3"> 
                                                            <span class="lyui-control-indicator"></span>
                                                            <span>拒绝</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif; ?>
             
                                        <div class="form-group"></div>
                                        <div class="form-group bottom_button_list">
                                        <?php if(($info['user_type'] == 0 and $info['is_check_user'] == 1) OR ($info['user_type'] == 1 and $info['is_check_company'] == 1)): ?>
                                            <a class="btn btn-primary submit ajax-post" type="submit" target-form="form-builder">确定</a>
                                        <?php endif; ?>
                                            <a class="btn btn-danger return" onclick="javascript:history.back(-1);return false;">返回</a>
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
