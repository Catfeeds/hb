<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:35:"../tpl/mall/wap/goodlist\index.html";i:1520239800;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
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
 <link rel="stylesheet" href="__CSS__/task.css">
<style type="text/css">
  .reveal-modal .close-reveal-modal-n, .reveal-modal2 .close-reveal-modal-n, .reveal-modal3 .close-reveal-modal-n {
    position: relative;
    background: #ccc;
    width: 100%;
    height: 12vmin;
    bottom: 0%;
    text-align: center;
    line-height: 12vmin;
    font-size: 4vmin;
}
.navigation a{
  font-size: 4.5vmin;
}
</style>
<script type="text/javascript" src="__JS__/jquery.reveal.js"></script>
<form action="<?php echo url('goodlist/index'); ?>" method="get" id="formsearch">
<div class="banner">
     <input type="text" name="keywork" placeholder="搜索商品" onfocus="this.placeholder=''" onblur="this.placeholder='搜索商品'" value="<?php echo input('keywork'); ?>" />
     <input type="hidden" name="id" value="<?php echo input('id'); ?>">
     <div onclick="document.getElementById('formsearch').submit()" class="search">
      <img src="__IMG__/search.png" alt="">
     </div>
    
</div>

<div class="navigation">
    <a href="<?php echo url('index',array('keywork'=>input('keywork'),'id'=>input('id'))); ?>">综合</a>
    <a href="<?php echo url('index',array('keywork'=>input('keywork'),'id'=>input('id'),'order_str'=>'xl')); ?>">销量</a>
    <?php 
      $str=input('order_str');
      if($str=='price_desc'){
         $str='price_asc'; 
      }else{
         $str='price_desc'; 
      }
     ?>
    <a href="<?php echo url('index',array('keywork'=>input('keywork'),'id'=>input('id'),'order_str'=>$str)); ?>" class="chlid2" style="position:relative;">
      <span>价格</span>
      <img  src="__IMG__/top.png" alt="" class="ssx">
      <img  src="__IMG__/down.png" alt="" class="xsx">
    </a>
    
    <a href="#" data-reveal-id="myModal2">筛选
    <i class="iconfont">&#xe63b;</i>
    </a>
</div>
  
  <div id="myModal2" class="reveal-modal2" style="padding-top: 10vmin;" >
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input name="start_price" type="text" placeholder="最低价" >
    <em>-</em>
    <input name="end_price" type="text" placeholder="最高价" >

    <div class="close-reveal-modal-n">
      <a href="javascript:document.getElementById('formsearch').submit()">确定</a>
    </div>
  </div>

</form>

<!-- <div id="myModal" class="reveal-modal" >
  <form action="">
    <p class="leibie">
    <label for="">类别</label>
      <a href="#" class="optiones">全部</a>
      <a href="#" class="optiones">分销</a>
      <a href="#" class="optiones">广告</a>
    </p>
    <p class="zhouqi">
      <label for="">周期</label>
      <a href="#" class="optiones">全部</a>
      <a href="#" class="optiones">0-5天</a>
      <a href="#" class="optiones">6-10天</a>
      <a href="#" class="optiones">11-20天</a>
      <a href="#" class="optiones">21-30天</a>
      <a href="#" class="optiones">30天以上</a>
    </p>
    <p class="jiamf">
      <label for="">加盟费(元)</label>
      <a href="#" class="optiones">全部</a>
      <a href="#" class="optiones">0-100</a>
      <a href="#" class="optiones">100-1,000</a>
      <a href="#" class="optiones">1,000-10,000</a>
      
    </p>
  </form>

  <div class="close-reveal-modal-n">
    <a href="#">确定</a>
  </div>
</div> -->



<!-- <div id="myModal3" class="reveal-modal3" >
  <input type="radio" name="ra">综合<br>
  <input type="radio" name="ra">新品<br>
  <input type="radio" name="ra">评价<br>
<div class="close-reveal-modal-n">
  <a href="#">确定</a>
</div>
</div> -->


<div class="cpfl_b">
  <ul>
  <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "<li style='text-align:center;width:100%' >暂时没有数据</li>" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
    <li>
      <a href="<?php echo url('Good/details',array('good_id'=>$v['good_id'])); ?>">
        <span><img src="<?php echo $v['good_cover_img']; ?>"></span>
        <p><?php echo $v['good_name']; ?></p>
        <p><em>￥<?php echo $v['good_price']+0; ?></em> 
        <?php if($v['ship_fee'] == '1'): ?>
        <i>免运费</i>
        <?php endif; ?>
        </p>
        <p class="jiangli">已出售<?php echo $v['good_sell_num']; ?>件</p>
        <?php if(!(empty($v['good_integral']) || (($v['good_integral'] instanceof \think\Collection || $v['good_integral'] instanceof \think\Paginator ) && $v['good_integral']->isEmpty()))): ?>
        <p class="jiangli">奖励：<?php echo $v['good_integral']; ?>积分</p>
        <?php endif; ?>
      </a>
    </li>
  <?php endforeach; endif; else: echo "<li style='text-align:center;width:100%' >暂时没有数据</li>" ;endif; ?>
  </ul>
</div>






<!-- <div class="more">
  <a href="#">查看更多……</a>
</div> -->
<script type="text/javascript">
  $('.optiones').click(function(){
    $(this).toggleClass('checkeds').siblings('.optiones').removeClass('checkeds');
  })

 </script>

  </body>
</html>