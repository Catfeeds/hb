<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/adminmall\view\order\detail.html";i:1515406462;s:80:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/admin\view\public\layout.html";i:1515468228;}*/ ?>
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
            <li class="text-muted">添加商品</li>
        </ul>

        <!-- 主体内容区域 -->
        <div class="tab-content ct-tab-content">
                <div class="builder formbuilder-box">
                  <div class="panel-body">
                  <form action="<?php echo url('save'); ?>" method="post" class="form-horizontal form form-builder" enctype="multipart/form-data" >
                        <div class="tab-content" >

                                <div class="col-xs-12">
                                        <div style="height:20px;" ></div>
                                        <div class="form-type-list">
                                            <input type="hidden" name="order_id" value="<?php echo $info['order_id']; ?>">
                                            <div class="form-group item_title">
                                                <label class="left control-label">收货信息</label>
                                                <div style="width:60%" class="right">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td><span style="color:#999" >姓名：</span><?php echo $info['user_name']; ?></td>
                                                        <td><span style="color:#999" >联系方式：</span><?php echo $info['user_mobile']; ?></td>
                                                    </tr>
                                                     <tr>
                                                        <td colspan="2" ><span style="color:#999" >收货地址：</span><?php echo $info['user_province']; ?>、<?php echo $info['user_city']; ?>、<?php echo $info['user_district']; ?>、<?php echo $info['user_address']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" ><span style="color:#999" >留言：</span><?php echo $info['order_user_note']; ?></td>
                                                    </tr>
                                                </table>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-type-list">
                                            <input type="hidden" name="order_id" value="<?php echo $info['order_id']; ?>">
                                            <div class="form-group item_title">
                                                <label class="left control-label">基本信息</label>
                                                <div style="width:60%" class="right">
                                                <table class="table table-bordered">
                                                <tr>
                                                    <td><span style="color:#999" >订单ID：</span><?php echo $info['order_id']; ?></td>
                                                    <td><span style="color:#999" >订单号：</span><?php echo $info['order_no']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><span style="color:#999" >订单总额：</span><?php echo $info['order_total_price']; ?></td>
                                                    <td> <span style="color:#999" >会员：</span><?php echo (isset($info['username']) && ($info['username'] !== '')?$info['username']:''); ?> &nbsp;&nbsp;<?php echo (isset($info['mobile']) && ($info['mobile'] !== '')?$info['mobile']:''); ?></td>
                                                </tr>
                                                
                                                </table>
                                               
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="form-type-list">
                                            <input type="hidden" name="order_id" value="<?php echo $info['order_id']; ?>">
                                            <div class="form-group item_title">
                                                <label class="left control-label">商品信息</label>
                                                <div style="width:60%" class="right">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>商品</th>
                                                            <th>规格属性</th>
                                                            <th>数量</th>
                                                            <th>单价</th>
                                                            <th>小计</th>
                                                        </tr>
                                                        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<?php echo url('good/edit',array('ids'=>$v['good_id'])); ?>">
                                                                <span style="width: 150px;white-space: nowrap;overflow:  hidden;text-overflow: ellipsis;margin:0;display: inline-block;" ><?php echo $v['good_name']; ?></span></a>
                                                                <img style="width:50px" src="<?php echo $v['good_cover_img']; ?>" alt="">
                                                            </td>
                                                            <td><?php echo $v['attr_text']; ?></td>
                                                            <td><?php echo $v['good_num']; ?></td>
                                                            <td><?php echo $v['good_price']+0; ?></td>
                                                            <td><?php echo $v['good_price']*$v['good_num']; ?></td>
                                                        </tr>
                                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                                        <tr>
                                                            <td colspan="5" style="text-align: right;" ><span style="color:#999" >订单总额：</span><?php echo $info['order_total_price']; ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                </div> 
                                <hr />
                                
                                <?php if($info['order_status'] < 3): ?>
                                <div class="form-group item_type ">
                                    <label class="left control-label">
                                        <span>当前状态：</span>
                                    </label>
                                    <div class="right">
                                        <?php 
                                           $status_name=array(0=>'未支付',1=>'已支付',2=>'已发货',3=>'已完成');
                                         ?>
                                        <span style="color: #2699ed;" ><?php echo $status_name[$info['order_status']]; ?></span>
                                    </div>
                                </div>
                        
                                <div class="form-group item_type ">
                                    <label class="left control-label">
                                        <span>订单状态：</span>
                                    </label>
                                    <div class="right">
                                        <?php if($info['order_status'] < 1): ?>
                                        <div class="radio-inline lyui-control lyui-radio">
                                            <label for="typemodule">
                                                <input type="radio" id="typemodule" class="radio" name="order_status" value="1"> 
                                                <span class="lyui-control-indicator"></span>
                                                <span>已支付</span>
                                            </label>
                                        </div>
                                        <?php endif; if($info['order_status'] < 2): ?>
                                        <div class="radio-inline lyui-control lyui-radio">
                                            <label for="typetheme">
                                                <input type="radio" id="typetheme" class="radio" name="order_status" value="2"> 
                                                <span class="lyui-control-indicator"></span>
                                                <span>已发货</span>
                                            </label>
                                        </div>
                                        <?php endif; ?>
                                        
                                         <div class="radio-inline lyui-control lyui-radio">
                                            <label for="three">
                                                <input type="radio" id="three" class="radio" name="order_status" value="3"> 
                                                <span class="lyui-control-indicator"></span>
                                                <span>已完成</span>
                                            </label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <?php endif; ?>

                            <div class="form-group bottom_button_list">
                                <?php if($info['order_status'] < 3): ?>
                                <a class="btn btn-primary submit ajax-post" type="submit" target-form="form">保存</a>
                                <?php endif; ?>
                                <a class="btn btn-danger return" onclick="javascript:history.back(-1);return false;">返回</a>
                            </div>
                            <div class="form-group"></div>
                        </div>
                    </form>
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
        var editor;
        KindEditor.ready(function(K) {
            editor = K.create('textarea[name="content"]', {
                allowFileManager : true,
                afterBlur: function () { this.sync(); }
            });
        });
        

       /** 以下 商品规格相关 js*/
        $(document).ready(function(){   
            // 商品模型切换时 ajax 调用  返回不同的属性输入框
            $("#spec_type").change(function(){  
                var goods_id = $("input[name='good_id']").val();
                var spec_type = $(this).val();
                    $.ajax({
                            type:'GET',
                            data:{goods_id:goods_id,spec_type:spec_type}, 
                            url:"<?php echo url('Good/ajaxGetSpecSelect'); ?>",
                            success:function(data){                            
                                   $("#ajax_spec_data").html('')
                                   $("#ajax_spec_data").append(data);
                                    // ajaxGetSpecInput();  // 触发完  马上触发 规格输入框
                            }
                    });           
            });
            // 触发商品规格
            $("#spec_type").trigger('change'); 
            
        });

        function img_call_back(fileurl_tmp)
        {
                $("#imagetext").val(fileurl_tmp);
                $("#cover_img").attr('src', fileurl_tmp);
        }

        // 上传商品相册回调函数
        function call_back2(paths){
            
            var  last_div = $(".goods_xc:last").prop("outerHTML");  
            for (i=0;i<paths.length ;i++ )
            {                    
                $(".goods_xc:eq(0)").before(last_div);  // 插入一个 新图片
                    $(".goods_xc:eq(0)").find('a:eq(0)').attr('href',paths[i]).attr('onclick','').attr('target', "_blank");// 修改他的链接地址
                $(".goods_xc:eq(0)").find('img').attr('src',paths[i]);// 修改他的图片路径
                    $(".goods_xc:eq(0)").find('a:eq(1)').attr('onclick',"ClearPicArr2(this,'"+paths[i]+"')").text('删除');
                $(".goods_xc:eq(0)").find('input').val(paths[i]); // 设置隐藏域 要提交的值
            }              
        }
        /*
         * 上传之后删除组图input     
         * @access   public
         * @val      string  删除的图片input
         */
        function ClearPicArr2(obj,path)
        {
            $.ajax({
                type:'GET',
                url:"<?php echo url('admin/Uploadify/delupload'); ?>",
                data:{action:"del", filename:path},
                success:function(){
                       $(obj).parent().remove(); // 删除完服务器的, 再删除 html上的图片                
                }
            });
            // 删除数据库记录
            // $.ajax({
            //             type:'GET',
            //             url:"<?php echo url('admin/Goods/del_goods_images'); ?>",
            //             data:{filename:path},
            //             success:function(){
            //                   //         
            //             }
            // });     
        }

    </script>
    <script type="text/javascript" src="__ADMIN__/libs/lyui/dist/js/lyui.extend.min.js"></script>

        </div>
    </div>
    
</body>
</html>
