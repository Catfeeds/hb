<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:36:"../tpl/mall/wap/order\orderlist.html";i:1517554186;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
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
   <link rel="stylesheet" href="__CSS__/product.css">
  <link rel="stylesheet" href="__ICON__/iconfont.css">
  <style type="text/css">
    .wordcil{
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      width: 79%;
      display: block;
      float: right;
    }
    .myorder li{
      width: 19%;
    }
  </style>
  <div style="margin-top: 13vmin"></div>
  <div id="tbh5v0">
    <div class="td">
        <div class="myorder" style="height:auto;">
       <ul>
         <li <?php if(input('type') == 'all'): ?>class="licolor"<?php endif; ?> ><a href="<?php echo url('Order/orderlist',array('type'=>'all')); ?>">全部订单</a></li>
         <li <?php if(input('type') == '0'): ?>class="licolor"<?php endif; ?> ><a href="<?php echo url('Order/orderlist',array('type'=>'0')); ?>">待付款</a></li>
         <li <?php if(input('type') == '1'): ?>class="licolor"<?php endif; ?> ><a href="<?php echo url('Order/orderlist',array('type'=>'1')); ?>">待发货</a></li>
         <li <?php if(input('type') == '2'): ?>class="licolor"<?php endif; ?> ><a href="<?php echo url('Order/orderlist',array('type'=>'2')); ?>">待收货</a></li>
         <li <?php if(input('type') == 3): ?>class="licolor"<?php endif; ?> style="border-right:none" ><a href="<?php echo url('Order/orderlist',array('type'=>'3')); ?>">已完成</a></li>
       </ul>
    </div>

      <div style="background:#ededed" class="order_main">
         <ul>
         <?php  $order_detail=db('order_detail');  if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "<li style='text-align:center;height: 30vmin;' >暂无数据</li>" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
              <h4 id="ddh">
              <p style="color:#575656;font-size:14px;" ><?php echo get_shop_name($vo['seller_id']); ?></p>
              订单号：<?php echo $vo['order_no']; ?>
              <p id="wfk"><?php echo $status_name[$vo['order_status']]; ?></p>
              </h4>
              <?php 
                $detail=array();
                $detail=$order_detail->field('good_id,good_name,good_num,good_price,attr_value,good_cover_img')->where('order_id',$vo['order_id'])->select();
               if(is_array($detail) || $detail instanceof \think\Collection || $detail instanceof \think\Paginator): $i = 0; $__LIST__ = $detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
              <div class="order_t" >
                <div class="order_main_l">
                  <a href="<?php echo url('Good/details',array('good_id'=>$v['good_id'])); ?>">
                    <img src="<?php echo $v['good_cover_img']; ?>" alt="">
                  </a>
                </div>
                <div class="order_main_r">
                 
                  <p>名称：<span class="wordcil" ><?php echo $v['good_name']; ?></span></p>
                  <p>数量：<span><?php echo $v['good_num']; ?></span></p>
                  <p>价格：<span style="color:#ff0000;">￥<?php echo $v['good_price']; ?> </span></p>
                  <?php if(!(empty($v['attr_value']) || (($v['attr_value'] instanceof \think\Collection || $v['attr_value'] instanceof \think\Paginator ) && $v['attr_value']->isEmpty()))): ?>
                  <p>规格：<span class="wordcil" ><?php echo $v['attr_value']; ?></span></p>
                  <?php endif; ?>
                </div>
              </div>
              <?php endforeach; endif; else: echo "" ;endif; ?>
              <div style="clear:both"></div>
              <div style="text-align:right" class="order_main_r_b">
                <span style="float:left;color:red;font-size:4.5vmin;height:7vmin" >￥<?php echo $vo['order_total_price']; ?></span>
                <?php if($vo['order_status'] == '0'): ?>
                <input class="orderan" style="color: white;background-color: #f23030;border: 0;" type="button" value="立即付款" onclick="GoPay(this)" url="<?php echo url('Order/gopay',array('order_id'=>$vo['order_id'])); ?>" style="margin-right: 5%;" >
                <input class="orderan" type="button" onclick="QuitOrder(this)" value="取消订单" url="<?php echo url('delete',array('id'=>$vo['order_id'])); ?>" >
                <?php endif; if($vo['order_status'] == '2'): ?>
                  <input class="orderan" url="<?php echo url('suregood',array('id'=>$vo['order_id'])); ?>" onclick="SureGood(this)"  type="button" value="确认收货">
                <?php endif; ?>
              </div>
              <div style="clear:both"></div>
            </li>
          <?php endforeach; endif; else: echo "<li style='text-align:center;height: 30vmin;' >暂无数据</li>" ;endif; ?>
         </ul>
      </div>
    </div>

</div>

<div id="lighth" class="white_contenth" >
  <p>确认您购买的【手提包】要申请退款!</p>
  <p>价格：￥185.00</p>
  <p class="xs">您对我们的服务有任何不满意请与我们联系，<i>服务电话：15014115554</i>。对于服务过程中的各种疑问，请您点击<i><a href="xssl.html">“新手上路”</a></i>进行了解！感谢您对我们的信任！ </p>
  <a href="###" class="an">坚持退款</a>
  <a href = "javascript:void(0)" onclick = "document.getElementById('lighth').style.display='none';document.getElementById('fadeh').style.display='none'" class="an">问题已解决</a>
</div> 
<div id="fadeh" class="black_overlayh"></div>

<script type="text/javascript">
  function SureGood(obj){
    layer.open({
      content: '确认要执行该操作吗?'
      ,btn: ['确定', '关闭']
      ,yes: function(index){

        layer.close(index);
        var url=$(obj).attr('url');
        $.ajax({
          url:url,
          type:'get',
          dataType:'json',
          success:function(data){
            if(data.status==1)
              $(obj).parents('li').remove();
            else
              alert(data.info);
          }
        })

      }
    });
  }



  function QuitOrder(obj){
    layer.open({
      content: '您确定要取消吗？'
      ,btn: ['确定', '关闭']
      ,yes: function(index){

        layer.close(index);
        var url=$(obj).attr('url');
        $.ajax({
          url:url,
          type:'get',
          dataType:'json',
          success:function(data){
            if(data.status==1)
              $(obj).parents('li').remove();
            else
              alert(data.info);
          }
        })

      }
    });
  }

  function GoPay(obj){
        var url=$(obj).attr('url');
        $.ajax({
          url:url,
          type:'get',
          dataType:'json',
          success:function(data){
            if(data.status==1)
              window.location.href=data.url;
            else
              alert(data.info);
          }
        })
  }
</script>



  </body>
</html>