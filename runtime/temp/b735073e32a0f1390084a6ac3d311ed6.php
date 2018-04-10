<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:41:"../tpl/home/wap/userinfo\checkmobile.html";i:1514362094;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
  <?php endif; if(!(empty($is_check_mobile) || (($is_check_mobile instanceof \think\Collection || $is_check_mobile instanceof \think\Paginator ) && $is_check_mobile->isEmpty()))): ?>
    <div style="padding-top: 13vmin;"></div>
    <div class="renzhen">
        <img src="__IMG__/sj.jpg">
        <p>您的手机号：<?php echo (\think\Session::get('user_login.mobile') ?: ''); ?></p>
    </div>
    <?php else: ?>
    <div style="padding-top: 13vmin;"></div>
    <div class="shezhi xgmm">
      <form class="postfrom" action="<?php echo url('checkmobile'); ?>" >
        <ul>
            <li>手机号： <span><input type="text" readonly="" value="<?php echo (\think\Session::get('user_login.mobile') ?: ''); ?>" class="sjh"><i id="yzm" settime="<?php echo (\think\Session::get('set_time') ?: ''); ?>" nowtime="<?php echo time(); ?>" class="sendmsg" onclick="sendMessage('<?php echo url('Common/sendCode'); ?>')" >获取验证码</i></span></li>
            <li>验证码：<span><input type="number" name="code" placeholder="请输入验证码" onfocus="this.placeholder=''" onblur="this.placeholder='请输入验证码'"></span></li>
        </ul>
      </form>
    </div>

  <p class="xianshi">您正在进行手机验证</p>
  <span id="anniu" class="button ajax-post" target-from="postfrom" >认证</span>
  <div style="padding-bottom: 10vmin"></div>
  <script type="text/javascript" src="__COM__/js/sendmessage.js" ></script>
  <?php endif; ?>

  </body>
</html>