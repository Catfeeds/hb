<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:36:"../tpl/home/wap/userorder\index.html";i:1521107559;}*/ ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui">
  <title>宏八商城</title>
  <link rel="stylesheet" href="__CSS__/style.css">

</head>
<body class="body_bg">
  <div class="fxm_header">
       <div class="fxm_left"><a href="javascript:history.back();"><img src="__IMG__/left.png"></a></div>
       <div class="fxm_center" style="width: 70%;">工单类型</div>
       <div class="fxm_right" style="width: 18%;line-height: 13vmin;padding-right: 1%;"><a href="<?php echo url('Userorder/detail',array('type'=>0)); ?>" style="color: #fff;font-size: 4vmin;">工单记录</a></div>
    </div>
    <div style="padding-top: 13vmin;"></div>

    <div class="shezhi">
        <ul>
            <!-- <li><a href="xgfxr.html">修改分享人</a></li> -->
            <li><a href="<?php echo url('Userorder/updatemobile'); ?>">修改手机号码</a></li>
            <!-- <li><a href="xgyx.html">修改邮箱</a></li> -->
            <li><a href="<?php echo url('Userorder/updateusername'); ?>">修改真实姓名</a></li>
            <li><a href="<?php echo url('Userorder/updatecompanyname'); ?>">修改企业名称</a></li>

        </ul>
    </div>

</body>
</html>