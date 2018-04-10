<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:32:"../tpl/mall/wap/user\wallet.html";i:1521110004;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui">
  <title>宏八商城</title>
  <link rel="stylesheet" href="__CSS__/style.css">
  <link rel="stylesheet" href="__ICON__/iconfont.css">

  <!-- 轮播图 -->
  <script type="text/javascript" src="__JS__/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="__JS__/jquery.touchSlider.js"></script>
  <script type="text/javascript" src="__JS__/js.js"></script>
  <script type="text/javascript" src="__HOME__/layer_mobile/layer.js"></script>

</head>
<body>
  <!-- 轮播图 -->
    <div class="fxm_header">
       <div class="fxm_left"><a href="<?php echo (isset($back_url) && ($back_url !== '')?$back_url:'javascript:history.back();'); ?>"><img src="__IMG__/left0.png"></a></div>
       <div class="fxm_center"><?php echo (isset($title) && ($title !== '')?$title:'宏八商城'); ?></div>
    </div>
 <div style="margin-top: 18vmin"></div>
    <div class="mywallet-top">
      <strong><?php echo $info['money']; ?></strong>
      <p>可用金额(元)</p>
      <a href="<?php echo url('home/Wealth/detail',array('type'=>'0','f_type'=>0)); ?>">
        详情
        <img src="__IMG__/left.png" alt="">
      </a>
    </div>

    <div class="mywallet-top">
      <strong style="color:#FF860E"><?php echo $info['anzi']; ?></strong>
      <p>宏宝</p>
      <a href="<?php echo url('home/Wealth/detail',array('type'=>'2','status'=>0)); ?>">
        详情
        <img src="__IMG__/left.png" alt="">
      </a>
    </div>

    <div class="mywallet-top">
      <strong style="color:#FF860E"><?php echo $info['integral']; ?></strong>
      <p>积分</p>
      <a href="<?php echo url('home/Wealth/detail',array('type'=>'1','status'=>0)); ?>">
        详情
        <img src="__IMG__/left.png" alt="">
      </a>
    </div>

    <div class="clear"></div>


    <div class="wallet-cards">
      <a href="youhuiquan.html">
        <img src="__IMG__/wallet02.png" alt="">
        <p>优惠券</p>
        <p><?php echo $info['coupon_count']; ?></p>

      </a>
      <a href="<?php echo url('home/Wealth/bankcard'); ?>" style="border:none">
        <img src="__IMG__/wallet03.png" alt="">
      <p>我的银行卡</p>
        <p><?php echo $info['bank_count']; ?></p>
      </a>
    </div>
    <div class="wallet-buttons">
      <a href="<?php echo url('home/Wealth/recharge'); ?>">充值</a>
      <a href="<?php echo url('home/Wealth/getmoney'); ?>">提现</a>
    </div>


  </body>
</html>