<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:36:"../tpl/mall/wap/user\usercenter.html";i:1517552428;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\bottom.html";i:1514212007;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
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
     <div style="margin-top: 13vmin"></div>
    <div class="mine-top">
      <div class="touxiang">
          <a href="javascript:">
            <span>
              <?php if(!(empty($u_info['head_img']) || (($u_info['head_img'] instanceof \think\Collection || $u_info['head_img'] instanceof \think\Paginator ) && $u_info['head_img']->isEmpty()))): ?>
              <img src="<?php echo $u_info['head_img']; ?>">
              <?php else: ?>
              <img src="__IMG__/touxiang.png">
              <?php endif; ?>
            </span>
          </a>
          <p><?php echo $u_info['username']; ?></p>
          <p class="ps">账号:<?php echo $u_info['account']; ?></p>
      </div>
      
      <div class="links">
          <a href="<?php echo url('userinfo'); ?>">个人资料</a>
          <a href="<?php echo url('wallet'); ?>">个人钱包</a>
      </div>
    </div>

    <div class="myorder">
      <a href="<?php echo url('Order/orderlist',array('type'=>'all')); ?>">
          <p>
              我的订单
              <!-- <span>全部订单</span> -->
          </p>
      </a>
        
        <div class="optionss">
            
            <a href="<?php echo url('Order/orderlist',array('type'=>'0')); ?>">
                <img src="__IMG__/optionss01.png" alt="">
                待付款
                <?php if(!(empty($order['pay_count']) || (($order['pay_count'] instanceof \think\Collection || $order['pay_count'] instanceof \think\Paginator ) && $order['pay_count']->isEmpty()))): ?>
                <span><?php echo $order['pay_count']; ?></span>
                <?php endif; ?>
            </a>
            <a href="<?php echo url('Order/orderlist',array('type'=>'1')); ?>">
                <img src="__IMG__/optionss02.png" alt="">
                待发货
                <?php if(!(empty($order['waitf_count']) || (($order['waitf_count'] instanceof \think\Collection || $order['waitf_count'] instanceof \think\Paginator ) && $order['waitf_count']->isEmpty()))): ?>
                <span><?php echo $order['waitf_count']; ?></span>
                <?php endif; ?>
            </a>
            
            <a href="<?php echo url('Order/orderlist',array('type'=>'2')); ?>" style="position:relative">
                <img src="__IMG__/optionss03.png" alt="">
               待收货
                <?php if(!(empty($order['waits_count']) || (($order['waits_count'] instanceof \think\Collection || $order['waits_count'] instanceof \think\Paginator ) && $order['waits_count']->isEmpty()))): ?>
                <span><?php echo $order['waits_count']; ?></span>
                <?php endif; ?>
            </a>
            <a href="<?php echo url('Order/orderlist',array('type'=>'2')); ?>">
                <img src="__IMG__/optionss04.png" alt="">
                已完成
            </a>

        </div>
    </div>

    <div class="additional" style="margin-bottom:5vmin;">
        <p>
            <a href="<?php echo url('News/newslist'); ?>">
            <img src="__IMG__/additional01.png" alt="">
                最新动态
            </a>
            <a href="<?php echo url('home/usercenter/updatepassword'); ?>">
                <img src="__IMG__/additional02.png" alt="">
                修改密码
            </a>
            <a href="<?php echo url('home/usercenter/safepassword'); ?>">
                <img src="__IMG__/additional03.png" alt="">
                安全密码
            </a>
            <a href="<?php echo url('Usercomment/commentlist'); ?>">
            <img src="__IMG__/additional05.png" alt="">
                我的评价
            </a>
        </p>

        <p>
           
            <a href="<?php echo url('User/listaddress',array('type'=>1)); ?>">
             <img src="__IMG__/additional06.png" alt="">
                收货地址
            </a>
            <a href="<?php echo url('Collection/collecgood'); ?>">
                <img src="__IMG__/additional07.png" alt="">
                我的收藏
            </a>
            <a href="<?php echo url('User/userhelp'); ?>">
                <img src="__IMG__/additional08.png" alt="">
                新手上路
            </a>
            <a href="<?php echo url('User/service'); ?>">
                <img src="__IMG__/additional09.png" alt="">
                在线客服
            </a>
        </p>
       <!--  <p>
            <a href="tuikuan.html">
           <img src="__IMG__/tui.png" alt="">
                我的退款
            </a>
        </p> -->

    </div>
    
    <div class="quit"><a href="<?php echo url('home/login/logout'); ?>" style="display: block;color:#a4a4a4">安全退出</a></div>


<div style="height:10vmin;float: left;display: block;width: 100%;"></div>

    <!-- 底部 -->
    <!-- 底部菜单 -->
<?php 
  $select_url=controller_name().'-'.action_name();
  $select_btn1='';
  $select_btn2='';
  $select_btn3='';
  $select_btn4='';
  if($select_url=='Index-index')
     $select_btn1='class="onb"';
  if($select_url=='Goodtype-index')
     $select_btn2='class="onb"';
  if($select_url=='Shopcar-index')
     $select_btn3='class="onb"';
  if($select_url=='User-usercenter')
     $select_btn4='class="onb"';
 ?>

<div class="footer">
      <a href="<?php echo url('mall/Index/index'); ?>" <?php echo $select_btn1; ?> >
          <i class="iconfont"></i>
          <p>首页</p>
      </a>
       <a href="<?php echo url('mall/Goodtype/index'); ?>" <?php echo $select_btn2; ?> >
          <i class="iconfont"></i>
          <p>产品分类</p>
      </a>
       <a href="<?php echo url('mall/Shopcar/index'); ?>" <?php echo $select_btn3; ?> >
          <i class="iconfont"></i>
          <p>购物车</p>
      </a>
       <a href="<?php echo url('mall/User/usercenter'); ?>" <?php echo $select_btn4; ?> >
          <i class="iconfont"></i>
          <p>我的</p>
      </a>
  </div>

  </body>
</html>