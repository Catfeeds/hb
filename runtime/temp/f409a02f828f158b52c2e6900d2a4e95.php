<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/adminmall\view\good\add.html";i:1514947361;s:80:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/admin\view\public\layout.html";i:1515468228;}*/ ?>
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
                  <form action="<?php echo url('goodsave'); ?>" method="post" class="form-horizontal form form-builder" enctype="multipart/form-data" >
                        <ul class="nav-tabs nav">
                            <li class="active" ><a href="#tab1" data-toggle="tab" aria-expanded="true">基本信息</a></li>
                            <li >
                                <a href="#tab2" data-toggle="tab" aria-expanded="false">商品模型</a>
                            </li>
                             <li >
                                <a href="#tab3" data-toggle="tab" aria-expanded="false">商品图片</a>
                            </li>                
                        </ul>
                       
                        <div class="tab-content" >
                        
                            <!-- 卡片1 -->
                            <div id="tab1" class="tab-pane active" >
                                <div class="col-xs-12">
                                        <div style="height:20px;" ></div>
                                        <div class="form-type-list">
                                            <input type="hidden" name="good_id" value="">
                                            <div class="form-group item_title ">
                                                <label class="left control-label">商品名称：</label>
                                                <div style="width:60%" class="right">
                                                    <input type="text" class="form-control input" name="good_name" value="" placeholder="商品名称" >
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">商品编号：</label>
                                                <div style="width:60%" class="right">
                                                    <input type="text" class="form-control input text" name="good_no" placeholder="商品编号"  >
                                                    <span style="color: #999;">商品编号，商品的唯一标识。</span>
                                                </div>
                                            </div>
                                            <div class="form-group item_title">
                                                <label class="left control-label">商品分类：</label>
                                                <div style="width:60%" class="right">
                                                    <select name="category_id" class="form-control select">
                                                        <option value="">请选择</option>
                                                        <?php echo (isset($good_type) && ($good_type !== '')?$good_type:''); ?>
                                                    </select>
                                                    <span style="color: #999;">推荐选择最底层分类</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="left control-label">商品品牌：</label>
                                                <div style="width:60%" class="right">
                                                    <select name="brand_id" class="form-control lyui-select select">
                                                        <option value="">请选择</option>
                                                        <?php echo (isset($good_brand) && ($good_brand !== '')?$good_brand:''); ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group item_title ">
                                                <label class="left control-label">供应商：</label>
                                                <div style="width:60%" class="right">
                                                    <input type="text" class="form-control input" name="good_supplier" value="" placeholder="供应商" >
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">关键词：</label>
                                                <div style="width:60%" class="right">
                                                    <input type="text" class="form-control input text" name="keywords" value="" placeholder="关键词" >
                                                    <span style="color: #999">设置关键便于搜索</span>
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">售价：</label>
                                                <div style="width:60%" class="right">
                                                    <input type="text" class="form-control input text" name="good_price" value="" placeholder="销售价格" >
                                                    <span style="color: #999">多参数价格请在商品模型添加</span>
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">市场价：</label>
                                                <div style="width:60%" class="right">
                                                    <input type="text" class="form-control input" name="market_price" value="" placeholder="市场价" >
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">成本价：</label>
                                                <div style="width:60%" class="right">
                                                    <input type="text" class="form-control input" name="cost_price" value="" placeholder="成本价" >
                                                </div>
                                            </div>

                                            <div class="form-group item_title">
                                                <label class="left control-label">佣金比例：</label>
                                                <div style="width:42%" class="input-group">
                                                    <input type="text" name="good_commission" class="form-control text" value="0" placeholder="佣金比例">
                                                    <span class="input-group-addon">%</span>
                                                </div>
                                                    <span style="color: #999;margin-left:12%">用于商城分销,微信三级分销。0不设置分佣比例</span>
                                            </div>
                                            
                                           <div class="form-group ">
                                                <label class="left control-label">商品重量：</label>
                                                <div style="width:42%" class="input-group">
                                                    <input type="text" name="good_weight" class="form-control"  placeholder="商品重量" value="" >
                                                     <span class="input-group-addon">g</span>
                                                </div>
                                                <span style="color: #999;margin-left:12%">务必设置商品重量, 用于计算物流费.以克为单位</span>
                                            </div>
                                            
                                            <div class="form-group item_type ">
                                                <label class="left control-label">
                                                    <span>是否包邮：</span>
                                                </label>
                                                <div class="right">
                                                    <div class="radio-inline lyui-control lyui-radio">
                                                        <label for="typemodule">
                                                            <input type="radio" id="typemodule" class="radio" name="ship_fee" value="module"> 
                                                            <span class="lyui-control-indicator"></span>
                                                            <span>是</span>
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline lyui-control lyui-radio">
                                                        <label for="typetheme">
                                                            <input type="radio" checked="true" id="typetheme" class="radio" name="ship_fee" value="theme"> 
                                                            <span class="lyui-control-indicator"></span>
                                                            <span>否</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group item_title">
                                                <label class="left control-label">商品总库存：</label>
                                                <div style="width:60%" class="right">
                                                    <input type="text" name="good_store" class="form-control input text" placeholder="商品库存" >
                                                    <span class="check-tips text-muted small">多参数商品库存请在商品模型添加</span>
                                                </div>
                                            </div>

                                            <div class="form-group item_ysj ">
                                                <label class="left control-label">
                                                  <span>商城属性：</span>
                                                </label>
                                                <div class="right">
                                                    <div class="checkbox-inline lyui-control lyui-checkbox">
                                                        <label class="checkbox-label">
                                                            <input type="checkbox" name="is_hot" value="1">
                                                            <span class="lyui-control-indicator"></span>
                                                            <span>热销商品</span>
                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inline lyui-control lyui-checkbox">
                                                        <label class="checkbox-label">
                                                            <input type="checkbox" name="is_recommend" value="1">
                                                                <span class="lyui-control-indicator"></span>
                                                                <span>精品推荐</span>
                                                        </label>
                                                    </div> 
                                                    <div class="checkbox-inline lyui-control lyui-checkbox">
                                                        <label class="checkbox-label">
                                                            <input type="checkbox" name="is_new" value="1">
                                                                <span class="lyui-control-indicator"></span>
                                                                <span>新品上市</span>
                                                        </label>
                                                    </div>        
                                                </div>
                                            </div>
                                            
                                            <div class="form-group item_title">
                                                <label class="left control-label">赠送积分：</label>
                                                <div style="width:60%" class="right">
                                                    <input type="text" name="good_integral" class="form-control input text" placeholder="赠送积分" >
                                                    <span style="color: #999">订单完成后赠送积分,如果设置0，不赠送积分</span>
                                                </div>
                                            </div>
                                            <div class="form-group item_title ">
                                                <label class="left control-label">商品排序：</label>
                                                <div style="width:60%" class="right">
                                                    <input type="text" class="form-control input text" name="good_sort" placeholder="商品编号"  >
                                                    <span style="color: #999;">数值越大越靠前。</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="left control-label">商品详情描述：</label>
                                                <div class="right">
                                                    <textarea style="min-height:400px" class="form-control" rows="5" name="good_content"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                </div> 
                            </div>
                            <!-- 卡片2 -->
                            <div id="tab2" class="tab-pane" >
                                <div class="col-xs-12">
                                
                                    <div style="height:20px;" ></div>
                                    <div class="form-type-list">

                                         <div class="form-group">
                                            <label class="left control-label">商品模型：</label>
                                            <div style="width:60%" class="right">
                                                <select name="model_id" id="spec_type" class="form-control  select">
                                                    <option value="">请选择</option>
                                                    <?php echo $good_model; ?>
                                                </select>
                                                <span style="color: #999;">选择商品模型后添加对应参数</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="left control-label">商品规格：</label>
                                            <div style="width:60%" class="right">
                                                <!-- 规格数据 S -->
                                                <div  id="ajax_spec_data">
                                                </div>
                                                 <!-- 规格数据 E -->
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div> 
                            </div>
                            <!-- 卡片3 -->
                            <div id="tab3" class="tab-pane" >
                                <div class="col-xs-12">
                                    <div style="height:20px;" ></div>
                                    <div class="form-type-list">
                                        
                                         <div class="form-group">
                                            <label class="left control-label">封面：</label>
                                            <div style="width:60%" class="right">
                                                <input type="hidden" id="imagetext" name="good_cover_img" value="" class="type-file-text">
                                                <div style="width:20%;height:100px;border:1px solid #ccc;text-align:center" >
                                                    <img style="max-width:100%;max-height:100%;display: block;" id="cover_img" src="" alt="">
                                                </div>

                                                <input type="button" name="button" id="button1" value="选择上传..." class="btn btn-primary" onClick="GetUploadify('<?php echo url('admin/Uploadify/upload',array('num'=>1,'func'=>'img_call_back')); ?>')" >
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="left control-label">商品图集：</label>
                                            <div style="width:60%" class="right">
                                               <div class="tab-pane" id="tab_goods_images">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="goods_xc" style="width:100px; text-align:center; margin: 5px; display:inline-block;">
                                                                    <input type="hidden" name="good_image[]" value="">
                                                                    <a href="javascript:void(0);" onclick="GetUploadify('<?php echo url('admin/Uploadify/upload',array('num'=>6,'func'=>'call_back2')); ?>')"><img src="__ADMIN__/images/add-button.jpg" width="100" height="100"></a>
                                                                    <br>
                                                                    <a href="javascript:void(0)">&nbsp;&nbsp;</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="form-group bottom_button_list">
                                <a class="btn btn-primary submit ajax-post" type="submit" target-form="form">保存</a>
                                <a class="btn btn-danger return" onclick="javascript:history.back(-1);return false;">取消</a>
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
            editor = K.create('textarea[name="good_content"]', {
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
