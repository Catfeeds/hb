<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:34:"../tpl/home/wap/service\index.html";i:1517538895;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\bottom.html";i:1517050374;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
    <div class="zxzx_xq">
        <h3></h3>
    </div>
    <div class="zxzx_b">
    <?php if(!(empty($info['WEB_TEL']) || (($info['WEB_TEL'] instanceof \think\Collection || $info['WEB_TEL'] instanceof \think\Paginator ) && $info['WEB_TEL']->isEmpty()))): ?>
    <p>服务电话：<?php echo $info['WEB_TEL']; ?></p>
    <?php endif; if(!(empty($info['WEB_MOBILE']) || (($info['WEB_MOBILE'] instanceof \think\Collection || $info['WEB_MOBILE'] instanceof \think\Paginator ) && $info['WEB_MOBILE']->isEmpty()))): ?>
    <p>服务手机：<?php echo $info['WEB_MOBILE']; ?></p>
    <?php endif; if(!(empty($info['WEB_QQ1']) || (($info['WEB_QQ1'] instanceof \think\Collection || $info['WEB_QQ1'] instanceof \think\Paginator ) && $info['WEB_QQ1']->isEmpty()))): ?>
    <p>服务QQ：<?php echo $info['WEB_QQ1']; ?></p>
    <?php endif; if(!(empty($info['WEB_QQ2']) || (($info['WEB_QQ2'] instanceof \think\Collection || $info['WEB_QQ2'] instanceof \think\Paginator ) && $info['WEB_QQ2']->isEmpty()))): ?>
    <p>服务QQ：<?php echo $info['WEB_QQ2']; ?></p>
    <?php endif; if(!(empty($info['WEB_WX']) || (($info['WEB_WX'] instanceof \think\Collection || $info['WEB_WX'] instanceof \think\Paginator ) && $info['WEB_WX']->isEmpty()))): ?>
    <p>服务微信：
      <img style="width:70%;padding:0" src="<?php echo $info['WEB_WX']; ?>" alt="">
    </p>
    <?php endif; ?>
    </div>
    <div style="padding-bottom: 10vmin;float: left;width: 100%"></div>
    <!-- 底部 -->

<!-- 底部菜单 -->
<?php 
  $select_url=controller_name().'-'.action_name();
  $select_btn1='';
  $select_btn2='';
  $select_btn3='';
  $select_btn4='';
  $select_img1='';
  $select_img2='';
  $select_img3='';
  $select_img4='';
  if($select_url=='Index-index'){
     $select_btn1='class="onb"';
     $select_img1='-1';
  }
  if($select_url=='Around-index'){
     $select_btn2='class="onb"';
     $select_img2='-1';
  }
  if($select_url=='Wealth-index'){
     $select_btn3='class="onb"';
     $select_img3='-1';
  }
  if($select_url=='Service-index'){
     $select_btn4='class="onb"';
     $select_img4='-1';
  }
 ?>

<div class="footer">
    <a href="<?php echo url('home/Index/index'); ?>" <?php echo $select_btn1; ?> >
        <img src="__IMG__/footer1<?php echo $select_img1; ?>.png">
        <p>首页</p>
    </a>
     <a href="<?php echo url('home/Around/index'); ?>" <?php echo $select_btn2; ?>>
        <img src="__IMG__/footer2<?php echo $select_img2; ?>.png">
        <p>周边</p>
    </a>
     <a href="<?php echo url('home/Wealth/index'); ?>" <?php echo $select_btn3; ?>>
        <img src="__IMG__/footer3<?php echo $select_img3; ?>.png">
        <p>财富</p>
    </a>
     <a href="<?php echo url('home/Service/index'); ?>" <?php echo $select_btn4; ?> >
        <img src="__IMG__/footer4<?php echo $select_img4; ?>.png">
        <p>客服</p>
    </a>
</div>


  </body>
</html>