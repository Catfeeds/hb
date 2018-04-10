<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:35:"../tpl/home/wap/login\usercode.html";i:1520236458;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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


 <style type="text/css">

html,body{ height: 100%; width: 100%;}



</style>
<div class="fxm-bg fx_bg">
<div class="fxm_main" style="padding-top: 8%">
    <h3 style="text-align: center;padding-bottom: 0;background: #fbfbfb;width: 64%;margin-left: 24%;line-height: 9vmin;border-radius: 6vmin;padding: 0;">分享ID：<?php echo $account; ?></h3>
    <p id="ewma"><img src="<?php echo $code_path; ?>"></p>
    <p style="text-align: left;background: #fff;padding: 1%;border-radius: 2vmin;margin-top: 4%;font-size: 3.5vmin;">分享链接：
    	<input readonly="true" type="text" style="word-wrap:break-word;width: 100%" id="txt" value="<?php echo $url; ?>" />
    </p>
	<span onclick="copyUrl()" style="background:#088eeb;width: 100%;line-height: 12vmin;border-radius: 2vmin;">复制链接</span>
    
</div>
</div>

<script type="text/javascript">
	function copyUrl()
	{
		var txt=document.getElementById("txt").value;
		copy(txt);
	}

	function copy(message) {
        var input = document.createElement("input");
            input.value = message;
            document.body.appendChild(input);
            input.select();
            input.setSelectionRange(0, input.value.length), document.execCommand('Copy');
            document.body.removeChild(input);
            msg_alert("复制成功");
	}

</script>

  </body>
</html>