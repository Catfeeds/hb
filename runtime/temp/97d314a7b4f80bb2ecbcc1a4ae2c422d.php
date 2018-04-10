<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:36:"../tpl/home/wap/login\agreement.html";i:1514212001;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
        <h3><?php echo $uss['title']; ?></h3>
    <!--    <p><?php echo date("Y-m-d H:i:s",$uss['savetime']); ?></p> -->
       <!-- <p>浏览次数：8084</p> --> 
    </div>
    <div class="zxzx_b">
    <p><?php echo $uss['content']; ?></p>
       <!--  <p>阿里云云市场镜像可以一键部署云服务器所需要的运行环境和个性化的软件应用满足建站,应用开发,可视化管理,bug跟踪管理工具等个性化需求.</p>
       <img src="images/tu.jpg">
       <p>阿里云云市场镜像可以一键部署云服务器所需要的运行环境和个性化的软件应用满足建站,应用开发,可视化管理,bug跟踪管理工具等个性化需求.</p>
       <p>百度新闻是包含海量资讯的新闻服务平台,真实反映每时每刻的新闻热点。您可以搜索新闻事件、热点话题、人物动态、产品资讯等,快速了解它们的最新进展。</p> -->
    </div>
    <div style="padding-bottom: 10vmin;float: left;width: 100%"></div>

  </body>
</html>