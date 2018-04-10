<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:36:"../tpl/mall/wap/shopcar\goorder.html";i:1515984771;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
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
<form>  
 <div class="address">
  <a style="width:100%" href="<?php echo url('User/listaddress',array('type'=>2)); ?>">
  <?php if(empty($address) || (($address instanceof \think\Collection || $address instanceof \think\Paginator ) && $address->isEmpty())): ?>
  选择收货地址
  <?php else: ?>
  <?php echo $address['province']; ?><?php echo $address['city']; ?><?php echo $address['district']; ?><?php echo $address['detail_address']; endif; ?>
  <img src="__IMG__/right.png" alt="">
  </a>
</div>
<input type="hidden" name="address_id" id="address" value="<?php echo (isset($address['id']) && ($address['id'] !== '')?$address['id']:''); ?>">
<?php if(is_array($list['good_list']) || $list['good_list'] instanceof \think\Collection || $list['good_list'] instanceof \think\Paginator): if( count($list['good_list'])==0 ) : echo "" ;else: foreach($list['good_list'] as $k=>$vo): ?>
<div class="commoditys">
  <h2><?php echo get_shop_name($k); ?></h2>
  <?php if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): if( count($vo)==0 ) : echo "" ;else: foreach($vo as $key=>$v): ?>
  <div style="float:left;width:100%" >
      <div class="commoditys-left">
        <a href="<?php echo url('Good/details',array('good_id'=>$v['good_id'])); ?>"><img src="<?php echo $v['good_cover_img']; ?>" alt=""></a>
      </div>
      <div class="commoditys-right">
        <h1><?php echo $v['good_name']; ?></h1>
        <p><?php echo (isset($v['good_attr']) && ($v['good_attr'] !== '')?$v['good_attr']:''); ?></p>
        <h3>￥<?php echo $v['good_price']; ?><em>×<?php echo $v['good_num']; ?></em></h3>
      </div>
  </div>
  <?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="shouhuostyle">
  <label>备注:</label>
  <input type="text" class="beizhu" id="content" data="<?php echo $k; ?>" name="content[<?php echo $k; ?>]" placeholder="选填 : 对本次交易的说明最多50个字" style="width:75%;height:10vmin;"  onfocus="this.placeholder=''" onblur="this.placeholder='选填 : 对本次交易的说明最多50个字'">
</div>
<div class="clear"></div>
<?php endforeach; endif; else: echo "" ;endif; ?>
</form>
<!-- <div class="shouhuostyle">
  <label>货运方式:</label>
  <input type="text" placeholder="请输入货运方式(默认为韵达快递)"  onfocus="this.placeholder=''" onblur="this.placeholder='请输入货运方式(默认为韵达快递)'"style="width:75%;height:10vmin;" >
</div> -->

<!-- <div class="shouhuostyle">
  <label>运费:</label>
  <span style="color:#FF2626" >￥10</span>
</div> -->
<div style="height:30vmin;"></div>
<div class="footerss">
  <p>
  共<span><?php echo $list['total_num']; ?></span>件
  合计:<strong style="color: #ff5500">￥<?php echo $list['total_price']; ?></strong>
  <a href="javascript:SaveOrder();">提交订单</a>
  </p>
</div>

<script type="text/javascript">
  function SaveOrder(){
    var address_id=$('#address').val();
    if(address_id=='' || address_id==null){
        layer.open({
          content:  '请选择收货地址',
          btn: '我知道了',
          time: 2 
        });
        return false;
    }

    var post_data=$('form').serialize();
    $.ajax({
        type:"POST",
        url:"<?php echo url('Shopcar/saveorder'); ?>",
        dataType:'json',
        data:post_data,
        success:function(data){
          if(data.status==1){
            location.href=data.url;
          }else{
            layer.open({
              content: data.info,
              btn: '我知道了',
              time: 2 //2秒后自动关闭
            });
          }
        }
    });
  }
</script>

  </body>
</html>