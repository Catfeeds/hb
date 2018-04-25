<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:39:"../tpl/home/wap/wealth\addbankcard.html";i:1519718555;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
    <style type="text/css">
        .setpassword select,.setpassword input {
            display: block;
            width: 90%;
            height: 12vmin;
            margin-top: 5vmin;
            margin-left: 4.5vmin;
            border: 0.2vmin solid #ccc;
            border-radius: 1vmin;
            text-indent: 3vmin;
            font-size: 4vmin;
        }
    </style>
    <form class="postfrom" action="<?php echo url('addbankcard'); ?>">
    <div class="setpassword">
          <select name="bankname" >
            <option value="">请选择开户银行</option>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
            <option value="<?php echo $v['id']; ?>"><?php echo $v['bank_name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
          <input name="bank_branch" type="text" placeholder="开户支行" onfocus="this.placeholder=''" onblur="this.placeholder='开户支行'">
          <input name="username" type="text" placeholder="开户名" onfocus="this.placeholder=''" onblur="this.placeholder='开户名'">
          <input type="text" name="bankno" placeholder="银行卡号" onfocus="this.placeholder=''" onblur="this.placeholder='银行卡号'">
      </div>

      <div class="setting-natrue">
          <label for="">设置该卡默认提现</label><br>
          <input name="default" type="radio" checked="true" value="1`" class="xuanze">是 
          <input name="default" type="radio"  value="0" class="xuanze">否 
      </div>
      </form>

      <div class="buttones">
        <a class="ajax-post" target-from="postfrom" href="javascript:">添 加</a>
      </div>

  </body>
</html>