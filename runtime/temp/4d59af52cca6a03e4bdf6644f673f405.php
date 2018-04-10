<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:38:"../tpl/home/wap/userinfo\userinfo.html";i:1522653731;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
    <div class="shezhi qyrz">
        <ul>
            <li>状态<span class="wrz">
            <?php if(!(empty($info['is_check_user']) || (($info['is_check_user'] instanceof \think\Collection || $info['is_check_user'] instanceof \think\Paginator ) && $info['is_check_user']->isEmpty()))): if($info['is_check_user'] == '1'): ?>审核中<?php endif; if($info['is_check_user'] == '2'): ?>已认证<?php endif; if($info['is_check_user'] == '3'): ?>审核不通过<?php endif; else: ?>
                未认证
            <?php endif; ?>
            </span></li>
            <li>账号<span><?php echo (\think\Session::get('user_login.account') ?: ''); ?></span></li>
            <li>姓名<span><?php echo (isset($info['username']) && ($info['username'] !== '')?$info['username']:''); ?></span></li>
            <li>手机号<span><?php echo (\think\Session::get('user_login.mobile') ?: ''); ?></span></li>
            <?php $arr=array(0=>'大陆身份证',1=>'非大陆身份证') ?>
            <li>证件类型<span><?php echo (isset($arr[$info['idcard_type']]) && ($arr[$info['idcard_type']] !== '')?$arr[$info['idcard_type']]:''); ?></span></li>
            <li>身份证<span><?php echo (isset($info['idcard']) && ($info['idcard'] !== '')?$info['idcard']:''); ?></span></li>
            <li>证件有效期<span><?php echo (isset($info['idcar_startdate']) && ($info['idcar_startdate'] !== '')?$info['idcar_startdate']:''); ?> 至 <?php echo (isset($info['idcar_endtdate']) && ($info['idcar_endtdate'] !== '')?$info['idcar_endtdate']:''); ?></span></li>
            <!-- <li>行业分类</li> -->
            <li>所在区域 <span><?php echo (isset($info['area']) && ($info['area'] !== '')?$info['area']:''); ?></span></li>
        </ul>
        <p>认证提交后，工作人员会在7个工作日内完成审核，如有疑问，请联系客服<i><?php echo $tel; ?></i></p>
    </div>
    <?php if(($info['is_check_user'] != 1) AND ($info['is_check_user'] != 2)): ?>
    <span id="anniu"><a href="<?php echo url('Userinfo/checkuser'); ?>">认证</a></span>
    <?php endif; ?>
<div style="padding-bottom: 10vmin"></div>

  </body>
</html>