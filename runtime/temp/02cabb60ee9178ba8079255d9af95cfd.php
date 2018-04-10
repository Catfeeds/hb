<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:35:"../tpl/mall/wap/shopcar\payway.html";i:1521197513;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
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
<style type="text/css">
  label{
    width: 80%;
    display: inline-block;
  }

</style>
<div class="commoditys">
  <div class="commoditys-left">
    <img src="__IMG__/ept_1.jpg" alt="">
  </div>
  <div class="commoditys-right">
    <h1>订单号：<?php echo $info['order_no']; ?></h1>
    <h3 style="color: inherit;" >订单总额：<span style="color:#FF2626" >￥<?php echo $info['order_total_price']; ?></span></h3>
  </div>
</div>
<div class="clear"></div>

  <div class="methods">
    <h1>请选择支付方式</h1>

    <p>
      <i class="iconfont" style="color: #f04f37">&#xe60e;</i>
      <label for="money">余额支付（<?php echo $wealth['money']+0; ?>元）</label>
      <input id="money" type="radio" name="payway" value="1">
    </p>

    <p>
      <i class="iconfont" style="color: #00c800">&#xe501;</i>
      <label for="wx">微信支付</label>
      <input id="wx" type="radio" name="payway" value="2" >
    </p>

    <p>
      <i class="iconfont" style="color: #009fe9">&#xe60d;</i>
      <label for="alipay">支付宝支付</label>
      <input id="alipay" type="radio" name="payway" value="3">
    </p>

    <p>
      <i class="iconfont" style="color: #fd7520;font-size: 7.5vmin;">&#xe628;</i>
      <label for="alipay">购物券支付（<?php echo $wealth['coupon']+0; ?>）</label>
      <input id="alipay" type="radio" name="payway" value="5">
    </p>

  </div>

  <div class="lijizhifu">
    <a href="javascript:Pay()">立即支付</a>
  </div>
  <input type="hidden" id="order_id" value="<?php echo input('id'); ?>" >
<script type="text/javascript">
  
  function Pay(){
      var payway=$("input[name='payway']:checked").val();
      if(typeof(payway)=='undefined'){
        layer.open({
          content:  '请选择支付方式'
          ,btn: '我知道了'
        });
        return;
      }
      var id=$('#order_id').val();
      var post_data={'paytype':payway,'id':id};
      $.ajax({
           type: "POST",
           url: "<?php echo url('Shopcar/savepay'); ?>",
           data:post_data,
           dataType: "json",
           success: function(data){
              if(data.status==1){
                window.location.href=data.url;
              }else{
                layer.open({
                  content:  data.info
                  ,btn: '我知道了'
                });
              }
            }    
        });
  }

</script>

  </body>
</html>