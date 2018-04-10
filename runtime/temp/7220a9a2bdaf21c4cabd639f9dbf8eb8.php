<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:43:"../tpl/home/wap/userorder\updatemobile.html";i:1514212003;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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


     <script type="text/javascript" src="__COM__/js/ajaxfileupload.js"></script>
    <div style="padding-top: 13vmin;"></div>
    <form class="postfrom" action="<?php echo url('updatemobile'); ?>" >
    <div class="shezhi xgmm">
        <h5>原手机号码能接收验证码 <a href="<?php echo url('Userorder/updatemobileself'); ?>">自动修改></a></h5>
        <h6 class="ts">修改信息</h6>
        <ul>
            <li>原手机号：<span><input type="text" readonly="" value="<?php echo (\think\Session::get('user_login.mobile') ?: ''); ?>"><i id="yzm" settime="<?php echo (\think\Session::get('set_time') ?: ''); ?>" nowtime="<?php echo time(); ?>" class="sendmsg" onclick="sendMessage('<?php echo url('Common/sendCode'); ?>')" >获取验证码</i></span></li>
            <li>验证码：<span><input name="code" type="text" placeholder="请输入验证码"></span></li>
            <li>新手机号： <span><input name="new_mobile" type="text" placeholder="请输入新手机号码" maxlength="11"></span></li>
        </ul>
        
    </div>

    <div class="shezhi xgmm">
        <h6 class="ts">修改信息</h6>
        <textarea name="content" rows="6" placeholder="在此输入需要解决的问题及发生的原因，请尽量描述清楚，以便工作人员更好的为你服务。" class="textarea"></textarea>
    </div>
    <?php if(user_type() == 1): ?>
    <div class="shezhi xgmm">
        <div class="upload">
          <h6 class="ts">上传附件<i>请上传营业执照！</i></h6>
          <div id="preview">
              <img id="imghead" width=100% height=auto border=0 src="__IMG__/a1.png">
          </div>
           <input type="file" id="img_license" data="license" name="img_license" onchange="uploadFile('img_license','<?php echo url('Common/uplodeimg'); ?>')" class="tijiao" />  
          
        </div>        
    </div>
    <?php else: ?>
    <div class="shezhi xgmm">
        <div class="upload">
          <h6 class="ts">上传附件<i>请上身份证照！</i></h6>
          <div id="preview">
              身份证正面
              <img id="imghead" width=100% height=auto border=0 src="__IMG__/a1.png">
          </div>
           <input type="file" id="img_license" data="license" name="img_license" onchange="uploadFile('img_license','<?php echo url('Common/uplodeimg'); ?>')" class="tijiao" />  
          
        </div>  
        <div id="preview1">
          身份证反面
          <img id="imghead1" width=100% height=auto border=0 src="__IMG__/a1.png">
        </div>
        <input type="file" id="img_back" data="back" name="img_back" onchange="uploadFile('img_back','<?php echo url('Common/uplodeimg'); ?>')" class="tijiao" />       
    </div>
    <?php endif; ?>
    <input type="hidden" name="back">
    <input type="hidden" name="license">
    </form>

    <span id="anniu"><a class="ajax-post" target-from="postfrom" href="javascript:">确定</a></span>
    <div style="padding-bottom: 10vmin"></div>
    <script type="text/javascript" src="__COM__/js/sendmessage.js" ></script>

  </body>
</html>