<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:35:"../tpl/home/wap/login\password.html";i:1521107560;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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


 <!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui">
  <title>宏八商城</title>
  <link rel="stylesheet" href="__CSS__/style.css">

</head>
<body>
  <!-- 轮播图 -->
    <div class="fxm_header">
       <div class="fxm_left"><a href="javascript:history.back()"><img src="__IMG__/left.png"></a></div>
       <div class="fxm_center">找回密码</div>
    </div>
<div style="margin-top: 20vmin"></div>
  <div class="register">
     <form class="postfrom" action="<?php echo url('setpsw'); ?>" >
      <input class="pmob" placeholder="请输入手机号" type="text" name="mobile" maxlength="11">
      <input name="code" placeholder="验证码" type="text">
      <i id="yzm-code" settime="<?php echo (\think\Session::get('set_time') ?: ''); ?>" nowtime="<?php echo time(); ?>" class="sendmsg" onclick="sendMessage('<?php echo url('Login/sendCode'); ?>','pmob')" >获取验证码</i>
      <input type="password" name="password" placeholder="请输入新密码">
      <input type="password" name="pwdconfirm" placeholder="确认新密码">
      <span class="ajax-post" target-from="postfrom"  id="register">立即修改</span>
    </form>
  </div>
  <script type="text/javascript" src="__COM__/js/sendmessage.js" ></script>
</body>
</html>

  </body>
</html>