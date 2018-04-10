<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:36:"../tpl/home/wap/news\newscenter.html";i:1514211998;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $site_info['WEB_SITE_TITLE']; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui">
  <meta name="description" content="<?php echo $site_info['WEB_SITE_DESCRIPTION']; ?>">
  <meta name="Keywords" content="<?php echo $site_info['WEB_SITE_KEYWORD']; ?>">
  <link rel="stylesheet" href="__CSS__/style.css">
  <script type="text/javascript" src="__JS__/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="__HOME__/layer_mobile/layer.js"></script>
  <script type="text/javascript" src="__COM__/js/home_index.js"></script>
</head>
<body>
  <?php if(empty($head_datail_url) || (($head_datail_url instanceof \think\Collection || $head_datail_url instanceof \think\Paginator ) && $head_datail_url->isEmpty())): ?>
    <div class="fxm_header">
       <div class="fxm_left"><a href="<?php echo (isset($back_url) && ($back_url !== '')?$back_url:'javascript:history.back();'); ?>"><img src="__IMG__/left.png"></a></div>
       <div class="fxm_center"><?php echo (isset($title) && ($title !== '')?$title:$site_info['WEB_SITE_TITLE']); ?></div>
    </div>
    <?php else: ?>
    <div class="fxm_header">
       <div class="fxm_left"><a href="<?php echo (isset($back_url) && ($back_url !== '')?$back_url:'javascript:history.back();'); ?>"><img src="__IMG__/left.png"></a></div>
       <div class="fxm_center" style="width: 75%;"><?php echo (isset($title) && ($title !== '')?$title:$site_info['WEB_SITE_TITLE']); ?></div>
       <div class="fxm_right" style="width: 13%;line-height: 13vmin;padding-right: 1%;">
          <a href="<?php echo $head_datail_url; ?>" style="color: #fff">记录</a>
       </div>
    </div>
  <?php endif; ?>


 <div style="padding-top: 13vmin;"></div>
<div class="zxzx">
<img src="__IMG__/zxzx.jpg">
<ul id="ulal">
	<?php if(is_array($menu_son) || $menu_son instanceof \think\Collection || $menu_son instanceof \think\Paginator): if( count($menu_son)==0 ) : echo "" ;else: foreach($menu_son as $key=>$v): ?>
	<a href="<?php echo url('News/newscenter',array('new_ids'=>$v['id'])); ?>" >
	<li  <?php if($v['id'] == input('new_ids')){echo 'class="currental"';}?>>
	<?php echo $v['title']; ?></li>
	</a>
	<?php endforeach; endif; else: echo "" ;endif; ?>  
	<a href="<?php echo url('usercenter/helpcenter',array('new_ids'=>$help_son[0]['id'])); ?>" >
	<li >帮助中心</li>
	</a>         
</ul>
<div id ="contental">
<div class="show">
<div class="zxzx_bottom zxzxa">
<ul>
	<?php if(is_array($tit) || $tit instanceof \think\Collection || $tit instanceof \think\Paginator): if( count($tit)==0 ) : echo "" ;else: foreach($tit as $key=>$v): ?>
	<li <?php if($v['newtop']==2){echo 'class=""';}else{echo 'class="new"';}?>>
	<a href="<?php echo url('News/newsdetail',array('news_id'=>$v['id'])); ?>">
	<?php echo $v['title']; ?>
	</a>
	<span><?php echo date('Y-m-d',$v['addtime']); ?></span>
	</li>
	<?php endforeach; endif; else: echo "" ;endif; ?>  
</ul>
</div>
</div>
</div>
<script>
	$('#ulal>li').click(function()
	{
		$(this).addClass('currental').siblings().removeClass('currental');
		$('#contental>div').eq($(this).index()).show().siblings().hide();
	})
</script>
</div>
<div style="padding-bottom: 10vmin;float: left;width: 100%"></div>

  </body>
</html>