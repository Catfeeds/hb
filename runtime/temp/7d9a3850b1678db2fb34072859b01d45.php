<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/seller\view\good\index.html";i:1519457497;s:79:"D:\UPUPW_ANK_W64\WebRoot\Vhosts\web\public/../shop/seller\view\public\head.html";i:1515468240;}*/ ?>
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
        <div class="bread-head">商品管理
            <span class="small">商品列表</span>
        </div>
        <div class="tools-function clearfix">
            <div class="float-left">
                <a class="button button-small bg-dot icon-plus" href="<?php echo url('Good/add'); ?>">添加</a>
                </div>
        </div>
    </div>
        
    <div class="admin-main">
    <div class="panel dux-box">
    <div class="table-tools clearfix ">
        <div class="float-left">
            <form method="GET" action="?">
                <div class="form-inline">
                    <div class="form-group">
                        <div class="field">
                            <input type="text" class="input" id="keyword" name="keyword" size="20" value="<?php echo input('get.keyword'); ?>" placeholder="输入搜索内容">
                        </div>
                    </div>
                    <div class="form-button">
                        <button class="button" type="submit">搜索</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="float-right">

        </div>
    </div>
    <div class="table-responsive">
        <table id="table" class="table table-hover ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>名称</th>
                        <th>编号</th>
                        <th>分类</th>
                        <th>价格</th>
                        <th>库存</th>
                        <th>销量</th>
                        <th>排序</th>
                        <th>上/下架</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo $data['good_id']; ?></td>
                        <td><p style="width: 208px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;margin: 0;padding: 0;" ><?php echo $data['good_name']; ?></p></td>
                        <td><?php echo $data['good_no']; ?></td>
                        <td><?php echo category_name($data['category_id']); ?></td>
                        <td><?php echo $data['good_price']; ?></td>
                        <td><?php echo $data['good_store']; ?></td>
                        <td><?php echo $data['good_sell_num']; ?></td>
                        <td>
                            <input class="inputtxt" data="<?php echo $data['good_id']; ?>" type="text" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" size="4" value="<?php echo $data['good_sort']; ?>">
                        </td>
                        <td>
                           <?php if($data['status'] == '1'): ?>
                                 <a name="forbid" title="下架" class="label label-warning-outline label-pill ajax-get confirm" href="<?php echo url('setStatus',array('status'=>'forbid','ids'=>$data['good_id'])); ?>">下架</a>
                           <?php else: ?>
                                <a name="forbid" title="上架" class="label label-success-outline label-pill ajax-get confirm" href="<?php echo url('setStatus',array('status'=>'resume','ids'=>$data['good_id'])); ?>">上架</a>
                           <?php endif; ?>
                        </td>
                        <td>
                            <a class="button bg-blue button-small icon-pencil" href="<?php echo url('edit',array('ids'=>$data['good_id'])); ?>">编辑</a>
                           <a class="button bg-red button-small icon-trash-o js-del ajax-get confirm" model="Admin" href="<?php echo url('setStatus',array('status'=>'delete','ids'=>$data['good_id'])); ?>">删除</a>
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

    <div class="panel-foot table-foot clearfix"><?php echo $table_data_page; ?></div>
</div>
    <script type="text/javascript">
        // 表格快速编辑功能，input失去焦点时自动保存数据。
        $(document).on('change', '.inputtxt', function() {

            var id = $(this).attr('data');
            var val = $(this).val();
            if(val=='' || val==null){
              layer.msg('请填写一个值');
              return false;
            }
            
            var url="<?php echo url('changeorder'); ?>";
            $.ajax({
                dataType: "json",
                url: url,
                data:{id:id,sort_order:val},
                type:'POST',
                success:function(data){
                    if (data.code == 1) {
                        layer.msg(data.msg,{time:500});
                    } else {
                        layer.msg(data.msg);
                    }
                },
                error: function(e) {
                    if (e.responseText) {
                        alert(e.responseText);
                    }
                }
            });
        });

    </script>
</div>
</body>
</html>
