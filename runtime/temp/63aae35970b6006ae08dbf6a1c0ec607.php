<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/admin\view\user\userlist.html";i:1521178740;s:80:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/admin\view\public\layout.html";i:1515468228;}*/ ?>
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
        </ul>

        <!-- 主体内容区域 -->
        <div class="tab-content ct-tab-content">
            <div class="panel-body">
                <div class="builder formbuilder-box">
                        
                        <div class="form-group"></div>

                        <!-- 顶部工具栏按钮 -->
                        <div class="builder-toolbar">
                            <div class="row">
                                <!-- 工具栏按钮 -->
                                   <!--  <div class="col-xs-12 col-sm-8 button-list clearfix">
                                        <div class="form-group">
                                            <a title="新增" class="btn btn-primary-outline btn-pill" href="<?php echo url('User/add'); ?>">新增</a>&nbsp;
                                        </div>
                                    </div> -->

                                <!-- 搜索框 -->
                                <div class="col-xs-12 col-sm-12 clearfix">
                                        <form class="form" method="get" action="">
                                            <div class="form-group right">
                                                <div style="float:left;width:120px;margin-right:20px" class="">
                                                    <select name="level" class="form-control lyui-select select">
                                                        <option value="">等级：</option>
                                                        <option <?php if(input('get.level') == '0'): ?>selected="true"<?php endif; ?>  value="0">消费商</option>
                                                        <option <?php if(input('get.level') == '1'): ?>selected="true"<?php endif; ?>  value="1">宏客</option>
                                                        <option <?php if(input('get.level') == '2'): ?>selected="true"<?php endif; ?>  value="2">宏投</option>
                                                        <option <?php if(input('get.level') == '3'): ?>selected="true"<?php endif; ?>  value="3">联盟商家</option>
                                                        <option <?php if(input('get.level') == '4'): ?>selected="true"<?php endif; ?>  value="4">代理商</option>
                                                        <option <?php if(input('get.level') == '5'): ?>selected="true"<?php endif; ?>  value="5">GA代理商</option>
                                                        <option <?php if(input('get.level') == '6'): ?>selected="true"<?php endif; ?>  value="6">EA代理商</option>
                                                    </select>                                            
                                                </div>

                                                <div style="float:left;width:150px;margin-right:20px" class="">
                                                    <input type="text" name="date_start" class="search-input form-control date" value="<?php echo input('get.date_start'); ?>" placeholder="开始日期">
                                                </div>
                                                <div style="float:left;width:150px;margin-right:20px" class="">
                                                    <input type="text" name="date_end" class="search-input form-control date" value="<?php echo input('get.date_end'); ?>" placeholder="结束日期">
                                                </div>

                                                <div style="float:left;width:120px;margin-right:20px" class="">
                                                    <select name="querytype" class="form-control lyui-select select">
                                                        <option  value="account">账号</option>
                                                         <option <?php if(input('get.querytype') == 'mobile'): ?>selected="true"<?php endif; ?>  value="mobile">手机</option>
                                                        <option <?php if(input('get.querytype') == 'username'): ?>selected="true"<?php endif; ?>  value="username">姓名</option>
                                                    </select>                                            
                                                </div>
  
                                                <div style="width:250px" class="input-group search-form">
                                                    <input  type="text" name="keyword" class="search-input form-control" value="<?php echo input('get.keyword'); ?>" placeholder="输入搜索内容">
                                                    <span class="input-group-btn"><a class="btn btn-default search-btn"><i class="fa fa-search"></i></a></span>
                                                </div>
                                            </div>
                                        </form>
                                </div>



                            </div>
                        </div>
                        

                        <style type="text/css">
                            tr,td{
                               margin: 0 !important;
                               padding: 5px 5px !important;
                            }
                        </style>

                        <!-- 数据列表 -->
                        <div class="builder-container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="builder-table">
                                        <div class="panel panel-default table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                              <thead>
                                                <tr>
                                                    <th>UID</th>
                                                    <th>等级</th>
                                                    <th>用户</th>
                                                    <th>财富</th>
                                                    <th>类别</th>
                                                    <th>状态</th>
                                                    <th style="width:23%" >操作</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                    <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                                                        <tr>
                                                            <td><?php echo $data['userid']; ?></td>
                                                            <td>
                                                                <?php echo user_level($data['level']); ?>
                                                            </td>
                                                            <td>
                                                                账号：<?php echo $data['account']; ?> <br />
                                                                姓名：<?php echo $data['username']; ?> <br />
                                                                手机：<?php echo $data['mobile']; ?>
                                                            </td>
                                                            <!-- 财富 -->
                                                            <td style="white-space: nowrap;" >
                                                               金额：<span style="color:#dc3300" ><?php echo $data['money']+0; ?></span>
                                                               <br />
                                                               积分：<span style="color:#dc3300" ><?php echo $data['integral']+0; ?></span>
                                                               <br />
                                                               宏宝：<span style="color:#dc3300" ><?php echo $data['anzi']+0; ?></span>
                                                            </td>
                                                            
                                                            <td>
                                                                <?php echo $data['user_type']==1?'企业用户':'个人用户'; ?>
                                                            </td>
                                                            <td>
                                                               <?php if($data['status'] == '1'): ?>
                                                                    <i title="正常" class="fa fa-check text-success"></i>
                                                               <?php else: ?>
                                                                    <i title="拉黑冻结" class="fa fa-ban text-danger"></i>
                                                               <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <a name="edit" title="编辑" class="label label-primary-outline label-pill" href="<?php echo url('User/edit',array('id'=>$data['userid'])); ?>">编辑</a>

                                                                <?php if($data['status'] == '1'): ?>
                                                                <a name="forbid" title="锁定" class="label label-warning-outline label-pill ajax-get confirm" href="<?php echo url('User/setStatus',array('status'=>'forbid','ids'=>$data['userid'])); ?>">锁定</a>
                                                                <?php else: ?>
                                                                <a name="forbid" title="解锁" class="label label-success-outline label-pill ajax-get confirm" href="<?php echo url('User/setStatus',array('status'=>'resume','ids'=>$data['userid'])); ?>">解锁</a>
                                                                <?php endif; ?>
                                                                <a name="edit" title="修改财富" class="label label-primary-outline label-pill" href="<?php echo url('User/AddFruits',array('id'=>$data['userid'])); ?>">财富</a>
                                                                 
                                                                 <a title="设置代理" class="label label-primary-outline label-pill" href="<?php echo url('User/setarea',array('userid'=>$data['userid'])); ?>">设代理</a>
                                                            </td>

                                                        </tr>
                                                    <?php endforeach; endif; else: echo "" ;endif; else: ?>
                                                        <tr class="builder-data-empty">
                                                            <td class="text-center empty-info" colspan="20">
                                                                <i class="fa fa-database"></i> 暂时没有数据<br>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                            <ul class="pagination"><?php echo $table_data_page; ?></ul>
                                    </div>
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
            
     <script type="text/javascript">
        $('.date').datetimepicker({
            format: 'yyyy-mm-dd',
            language:"zh-CN",
            minView:2,
            autoclose:true,
            todayBtn:1, //是否显示今日按钮
        });
    </script>
    <script type="text/javascript" src="__ADMIN__/libs/lyui/dist/js/lyui.extend.min.js"></script>

        </div>
    </div>
    
</body>
</html>
