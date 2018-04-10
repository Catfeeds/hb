<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:35:"../tpl/home/wap/userinfo\index.html";i:1516783757;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
    <div class="shezhi rzzx">
        <ul>
            <li><a href="<?php echo url('Userinfo/checkmobile'); ?>">手机认证<span><?php if($checkinfo['is_check_mobile'] == '1'): ?>已认证<?php else: ?>未认证<?php endif; ?></span></a></li>
            <?php if($user_type != '1'): ?>
            <li><a href="<?php echo url('Userinfo/userinfo'); ?>">个人认证<span>
            <?php if($checkinfo['is_check_user'] == '1'): ?>审核中<?php endif; if($checkinfo['is_check_user'] == '2'): ?>已认证<?php endif; if($checkinfo['is_check_user'] == '3'): ?>认证不通过<?php endif; if($checkinfo['is_check_user'] == '0'): ?>未认证<?php endif; ?>
            </span></a></li>
            <!-- <li><a href="javascript:">个人行业推展<span>未认证</span></a></li> -->
            <?php else: ?>
            <li><a href="<?php echo url('Userinfo/checkcompany'); ?>">企业认证<span>
                <?php if($checkinfo['is_check_company'] == '1'): ?>审核中<?php endif; if($checkinfo['is_check_company'] == '2'): ?>已认证<?php endif; if($checkinfo['is_check_company'] == '3'): ?>认证不通过<?php endif; if($checkinfo['is_check_company'] == '0'): ?>未认证<?php endif; ?>
            </span></a></li>
            <!-- <li><a href="javascript:">联盟商家认证<span>未认证</span></a></li>
            <li><a href="javascript:">购买牌匾<span>未认证</span></a></li> -->
            <?php endif; ?>
        </ul>
    </div>

  </body>
</html>