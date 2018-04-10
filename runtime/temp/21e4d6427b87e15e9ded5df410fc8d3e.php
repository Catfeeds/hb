<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:41:"../tpl/home/wap/userupdate\tocompany.html";i:1514212004;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
    <div class="shezhi xgmm">
      <form class="postfrom" action="<?php echo url('tocompany'); ?>" >
        <ul>
            <li>公司名称： <span><input  name="companyname" type="text" placeholder="请输入公司名称" ></span></li>
            <li>组织机构： 
              <span>
                <select  name="companyorganize">
                  <option value="">请选择组织机构类型</option>
                  <option value="企业">企业</option>
                  <option value="事业单位">事业单位</option>
                  <option value="机关">机关</option>
                  <option value="社会团体">社会团体</option>
                  <option value="民办非企业单位">民办非企业单位</option>
                  <option value="基金会">基金会</option>
                  <option value="居委会">居委会</option>
                  <option value="村委会">村委会</option>
                  <option value="其他组织机构">其他组织机构</option>
                </select>
            </li>
            <li>营业执照号码： <span><input name="companylicense" type="text" placeholder="请输入营业执照号码"></span></li>
            <li>手机号： <span><input type="text" readonly="" value="<?php echo (\think\Session::get('user_login.mobile') ?: ''); ?>" class="sjh"><i id="yzm" settime="<?php echo (\think\Session::get('set_time') ?: ''); ?>" nowtime="<?php echo time(); ?>" class="sendmsg" onclick="sendMessage('<?php echo url('Common/sendCode'); ?>')" >获取验证码</i></span></li>
            <li>验证码：<span><input type="number" name="code" placeholder="请输入验证码" ></span></li>
        </ul>
      </form>
    </div>

   <div class="grzqy">
     <p>1.升级企业用户后个人身份证信息将被清除，可用于再次注册。</p>
     <p>2.升级成功后企业认证状态为“未认证”，需要进行企业实名认证。</p>
     <p>3.成功后改账号不能退回个人身份！</p>
   </div>

  <span id="anniu" class="button ajax-post" target-from="postfrom">确定</span>
  <div style="padding-bottom: 10vmin"></div>

  <script type="text/javascript" src="__COM__/js/sendmessage.js" ></script>

  </body>
</html>