<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/admin\view\shopstatus\orderlist.html";i:1515125734;s:80:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/admin\view\public\layout.html";i:1515468228;}*/ ?>
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
                    <div class="builder-tabs builder-form-tabs">
                        <?php $type=input('type/d',0); ?>
                        <ul class="nav nav-tabs">
                            <li <?php if($type == '0'): ?>class="active"<?php endif; ?> >
                                <a href="<?php echo url('orderlist'); ?>">待审核</a>
                            </li>
                            <li <?php if($type == '1'): ?>class="active"<?php endif; ?> >
                                <a href="<?php echo url('orderlist',array('type'=>'1')); ?>">已通过</a>
                            </li>
                            <li <?php if($type == '2'): ?>class="active"<?php endif; ?> >
                                <a href="<?php echo url('orderlist',array('type'=>'2')); ?>">已拒绝</a>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group"></div>
                    <div class="builder-container" >
                        <div class="form-group"></div>

                        <!-- 顶部工具栏按钮 -->
                        <div class="builder-toolbar">
                            <div class="row">
                                <!-- 工具栏按钮 -->
                                    <div class="col-xs-12 col-sm-8 button-list clearfix">
                                    </div>
                                   
                                <!-- 搜索框 -->
                                <div class="col-xs-12 col-sm-12 clearfix">
                                        <form class="form" method="get" action="">
                                            <div class="form-group right">
                                                <div style="float:left;width:120px;margin-right:20px" class="">
                                                    <select name="update_type" class="form-control lyui-select select">
                                                        <option value="">类型：</option>
                                                        <option <?php if(input('get.update_type') == '1'): ?>selected="true"<?php endif; ?>  value="1">修改手机号码</option>
                                                        <option <?php if(input('get.update_type') == '2'): ?>selected="true"<?php endif; ?>  value="2">修改姓名</option>
                                                        <option <?php if(input('get.update_type') == '3'): ?>selected="true"<?php endif; ?>  value="3">修改企业名称</option>
                                                        
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
                                                        <option  value="username">姓名</option>
                                                         <option <?php if(input('get.querytype') == 'mobile'): ?>selected="true"<?php endif; ?>  value="mobile">手机</option>
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
                        
                        <!-- 数据列表 -->
                        <div class="builder-container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="builder-table">
                                        <div class="panel panel-default table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                              <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>用户</th>
                                                    <th>修改类型</th>
                                                    <th>修改内容</th>
                                                    <th>时间</th>
                                                    <th>状态</th>
                                                    <th>操作</th>
                                                    
                                                </tr>
                                            </thead>
                                                <tbody>
                                                   
                                                    <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                                                        <tr>
                                                            <td><?php echo $data['id']; ?></td>
                                                            <td><?php echo $data['username']; ?>(<?php echo $data['mobile']; ?>)</td>
                                                            <td>
                                                            <?php if($data['update_type'] == '1'): ?>
                                                                修改手机号码
                                                            <?php endif; if($data['update_type'] == '2'): ?>
                                                                修改姓名
                                                            <?php endif; if($data['update_type'] == '3'): ?>
                                                                修改企业名称
                                                            <?php endif; ?>
                                                            </td>
                                                            <td><?php echo $data['new_info']; ?></td>
                                                            <td><?php echo date('Y-m-d H:i',$data['create_time']); ?></td>
                                                            <td>
                                                                <?php if($data['status'] == '0'): ?>待审核<?php endif; if($data['status'] == '1'): ?>已通过<?php endif; if($data['status'] == '2'): ?>已拒绝<?php endif; ?>
                                                            </td>
                                                           
                                                            <td>
                                                                <a name="edit" title="查看详情" class="label label-primary-outline label-pill" href="<?php echo url('orderdetail',array('id'=>$data['id'])); ?>">详情</a>
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

                                        <?php if(!(empty($table_data_page) || (($table_data_page instanceof \think\Collection || $table_data_page instanceof \think\Paginator ) && $table_data_page->isEmpty()))): ?>
                                            <ul class="pagination"><?php echo $table_data_page; ?></ul>
                                        <?php endif; ?>
                                    </div>
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
