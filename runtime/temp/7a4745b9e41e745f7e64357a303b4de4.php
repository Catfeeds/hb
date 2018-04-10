<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:29:"../tpl/home/wap/news\sxy.html";i:1522809476;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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


 <div style="padding-top: 3rem;"></div>
<?php if(is_array($pple) || $pple instanceof \think\Collection || $pple instanceof \think\Paginator): if( count($pple)==0 ) : echo "" ;else: foreach($pple as $key=>$v): ?>
<div class="sxy">
	<div class="sxy_top">
	<div class="sxy_img"><img src="<?php echo $v['image']; ?>"></div>
	<div class="sxy_right">
		<p>姓名：<span style="color: #00b7f1"><?php echo $v['name']; ?></span></p>
		<p>地区：<span><?php echo $v['addres']; ?></span></p>
		<p>年龄：<span><?php echo $v['age']; ?>岁</span></p>
		<p>粉丝：<span style="color: #00b7f1"><?php echo $v['fans']; ?>人</span></p>
		<p style="width: 50%">评分：<span style="color: #f00;"><?php echo $v['graded']; ?></span></p>
		<p style="width: 50%">总播放数：<span ><?php echo $v['numeration']; ?></span></p>
		<!-- <div class="sxy_jj">
			<?php echo $v['content']; ?>
		</div> -->
	</div>
	</div>
	<div class="sxy_bottom">
		<a href="<?php echo url('sxy2',array('people_id'=>$v['id'])); ?>">展示全部</a>
	</div>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>




  </body>
</html>