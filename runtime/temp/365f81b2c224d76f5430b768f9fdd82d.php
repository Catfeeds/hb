<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:37:"../tpl/mall/wap/user\listaddress.html";i:1514978647;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui">
  <title>宏八商城</title>
  <link rel="stylesheet" href="__CSS__/style.css">
  <link rel="stylesheet" href="__ICON__/iconfont.css">

  <!-- 轮播图 -->
  <script type="text/javascript" src="__JS__/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="__JS__/jquery.touchSlider.js"></script>
  <script type="text/javascript" src="__JS__/js.js"></script>
  <script type="text/javascript" src="__HOME__/layer_mobile/layer.js"></script>

</head>
<body>
  <!-- 轮播图 -->
    <div class="fxm_header">
       <div class="fxm_left"><a href="<?php echo (isset($back_url) && ($back_url !== '')?$back_url:'javascript:history.back();'); ?>"><img src="__IMG__/left0.png"></a></div>
       <div class="fxm_center"><?php echo (isset($title) && ($title !== '')?$title:'宏八商城'); ?></div>
    </div>
 
<div style="margin-top: 13vmin"></div>
<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
<div class="shdz">
    <p class="xm"><span>姓名：</span><i><?php echo $v['user_name']; ?></i><em><?php echo $v['user_mobile']; ?></em></p>
    <p><?php echo $v['province']; ?><?php echo $v['city']; ?><?php echo $v['district']; ?><?php echo $v['detail_address']; ?></p>
    <p class="moren">
    	<?php if($v['is_default'] == '1'): ?>
    	<input url="<?php echo url('Shopcar/goorder',array('id'=>$v['id'])); ?>" type="checkbox">&nbsp;&nbsp;&nbsp;&nbsp;默认地址
    	<?php else: ?>
    	<input url="<?php echo url('Shopcar/goorder',array('id'=>$v['id'])); ?>" type="checkbox">
    	<?php endif; ?>
	    <span>
	    	<a href="<?php echo url('User/editaddress',array('id'=>$v['id'])); ?>">编辑</a>
	    </span>
    </p>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>

<div class="add_address">
<?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
  <img src="__IMG__/kong.png">
<?php endif; ?>
  <p>
    <a href="<?php echo url('User/editaddress'); ?>">添加收货地址</a>
  </p>
</div>

<?php $type=session('cometype'); if($type == '2'): ?>

<script type="text/javascript">
	$("input[type='checkbox']").click(function(){
		location.href=$(this).attr('url');
	})
  
</script>

<?php endif; ?>

  </body>
</html>