<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:33:"../tpl/home/wap/wealth\index.html";i:1521191723;s:34:"../tpl/home/wap/public\bottom.html";i:1517050374;}*/ ?>

<!-- 不使用布局文件 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui">
    <title>宏八</title>
    <link rel="stylesheet" href="__CSS__/style.css">

</head>
<body>
    <div class="fxm_header">
       <div class="fxm_left">&nbsp;&nbsp;</div>
       <div class="fxm_center">财富</div>
       <!-- <div class="fxm_right"><img src="__IMG__/zf.png"></div> -->
    </div>

<div style="margin-top: 16vmin"></div>

    <div class="mywallet-top">
      <strong><?php echo $wealth['money']; ?></strong>
      <p>可用金额（元）</p>
      <a href="<?php echo url('Wealth/detail',array('type'=>'0','f_type'=>0)); ?>">
        详情
        <img src="__IMG__/right2.png" alt="">
      </a>
    </div>
    <div class="clear"></div>


    <div class="wallet-cards">
      <a href="<?php echo url('Wealth/detail',array('type'=>'1','status'=>0)); ?>">
        <img src="__IMG__/cf1.png" alt="">
        <p>积分</p>
        <p><?php echo $wealth['integral']; ?></p>

      </a>
      <a href="<?php echo url('Wealth/detail',array('type'=>'2','status'=>0)); ?>" style="border:none">
        <img src="__IMG__/cf2.png" alt="">
      <p>宏宝</p>
        <p><?php echo $wealth['anzi']; ?></p>
      </a>
      <a href="<?php echo url('Wealth/kucunintegral'); ?>">
        <img src="__IMG__/cf3.png" alt="">
        <p>库存积分</p>
        <p><?php echo $wealth['kucun_integral']; ?></p>

      </a>
      <!-- <a href="<?php echo url('Wealth/mywallet'); ?>" style="border:none">
        <img src="__IMG__/cf4.png" alt="">
      <p>钱包</p>
        <p>&nbsp;</p>
      </a> -->
      
      <a href="<?php echo url('Wealth/bankcard'); ?>" style="border:none">
        <img src="__IMG__/wallet03.png" alt="">
      <p>我的银行卡</p>
        <p><?php echo $wealth['bank_count']; ?></p>
      </a>
      <a href="<?php echo url('Wealth/coupon'); ?>">
        <img src="__IMG__/wallet02.png" alt="">
        <p>购物券</p>
        <p><?php echo $wealth['coupon']+0; ?></p>

      </a>
    </div>

    <p id="jftj"><img src="__IMG__/cf5.png">上一天积分增长统计：<span><?php echo (isset($lastdate_integral) && ($lastdate_integral !== '')?$lastdate_integral:0); ?></span></p>

    <div class="wallet-buttons">
      <a href="<?php echo url('Wealth/recharge'); ?>">充值</a>
      <a href="<?php echo url('Wealth/getmoney'); ?>">提现</a>
    </div>
<div style="padding-bottom: 20vmin;float: left;width: 100%"></div>
 


<!-- 底部 -->
<!-- 底部菜单 -->
<?php 
  $select_url=controller_name().'-'.action_name();
  $select_btn1='';
  $select_btn2='';
  $select_btn3='';
  $select_btn4='';
  $select_img1='';
  $select_img2='';
  $select_img3='';
  $select_img4='';
  if($select_url=='Index-index'){
     $select_btn1='class="onb"';
     $select_img1='-1';
  }
  if($select_url=='Around-index'){
     $select_btn2='class="onb"';
     $select_img2='-1';
  }
  if($select_url=='Wealth-index'){
     $select_btn3='class="onb"';
     $select_img3='-1';
  }
  if($select_url=='Service-index'){
     $select_btn4='class="onb"';
     $select_img4='-1';
  }
 ?>

<div class="footer">
    <a href="<?php echo url('home/Index/index'); ?>" <?php echo $select_btn1; ?> >
        <img src="__IMG__/footer1<?php echo $select_img1; ?>.png">
        <p>首页</p>
    </a>
     <a href="<?php echo url('home/Around/index'); ?>" <?php echo $select_btn2; ?>>
        <img src="__IMG__/footer2<?php echo $select_img2; ?>.png">
        <p>周边</p>
    </a>
     <a href="<?php echo url('home/Wealth/index'); ?>" <?php echo $select_btn3; ?>>
        <img src="__IMG__/footer3<?php echo $select_img3; ?>.png">
        <p>财富</p>
    </a>
     <a href="<?php echo url('home/Service/index'); ?>" <?php echo $select_btn4; ?> >
        <img src="__IMG__/footer4<?php echo $select_img4; ?>.png">
        <p>客服</p>
    </a>
</div>


   

</body>
</html>