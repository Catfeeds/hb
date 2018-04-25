<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:38:"../tpl/home/wap/usercenter\parent.html";i:1514212002;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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


 <div class="centent_640 pt45">
    <div class="pl15 bg_white solid_last_a mb20">
        
            <a class="db solid_b pr15 pt10">
                <p class="mg0 pb10 c-222">账号
                    <span class="fr text_blue"><?php echo (isset($info['account']) && ($info['account'] !== '')?$info['account']:''); ?></span>
                </p>
            </a>
            <div class="db solid_b">
                <a class="db solid_b pr15 pt10" href="">
                    <p class="mg0 pb10 c-222">姓名
                        <span class="fr text_blue"><?php echo (isset($info['username']) && ($info['username'] !== '')?$info['username']:''); ?></span>
                    </p>
                </a>
                <a class="db solid_b pr15 pt10" href="">
                    <p class="mg0 pb10 c-222">手机
                        <span class="fr text_blue"><?php echo (isset($info['mobile']) && ($info['mobile'] !== '')?$info['mobile']:''); ?></span>
                    </p>
                </a>
                <a class="db solid_b pr15 pt10" href="">
                    <p class="mg0 pb10 c-222">邮箱
                        <span class="fr text_blue"><?php echo (isset($info['email']) && ($info['email'] !== '')?$info['email']:''); ?></span>
                    </p>
                </a>
            </div>
        
    </div>
</div>

  </body>
</html>