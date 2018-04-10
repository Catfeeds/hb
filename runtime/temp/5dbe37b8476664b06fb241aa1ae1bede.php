<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:34:"../tpl/mall/wap/shopcar\index.html";i:1515842507;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
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
<?php if(!(empty($list['good_list']) || (($list['good_list'] instanceof \think\Collection || $list['good_list'] instanceof \think\Paginator ) && $list['good_list']->isEmpty()))): if(is_array($list['good_list']) || $list['good_list'] instanceof \think\Collection || $list['good_list'] instanceof \think\Paginator): if( count($list['good_list'])==0 ) : echo "" ;else: foreach($list['good_list'] as $key=>$vo): if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): if( count($vo)==0 ) : echo "" ;else: foreach($vo as $key=>$v): ?>
  <div class="commodity" id="commodity1"> 
    <input type="hidden" class="dede" value="<?php echo $v['good_price']; ?>">
    <div class="commodity-left">
      <a href="<?php echo url('Good/details',array('good_id'=>$v['good_id'])); ?>"><img src="<?php echo $v['good_cover_img']; ?>" alt=""></a>
    </div>
      <div class="commodity-right">
        <h1><?php echo $v['good_name']; ?></h1>
        <p>
        <?php echo (isset($v['good_attr']) && ($v['good_attr'] !== '')?$v['good_attr']:''); ?>
        </p>
        <h3>
          <strong>￥<?php echo $v['good_price']; ?></strong>
          <em>×</em>
          <input class="jian" name=""  style=" width:20px; height:18px;border:1px solid #ccc;" type="button" value="-" />
          <input data="<?php echo $v['good_id']; ?>" item="<?php echo (isset($v['attr_id']) && ($v['attr_id'] !== '')?$v['attr_id']:""); ?>" class="dedemun" id="text_box1" name="" type="text" value="<?php echo $v['good_num']; ?>" style=" width:30px; text-align:center; border:1px solid #ccc;" />
          <input class="jia" name="" style=" width:20px; height:18px;border:1px solid #ccc;" type="button" value="+" />
        </h3>
        <img src="__IMG__/deldete.png" alt="" class="shanchu">
    </div>
  </div>
  <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; else: ?>
  <div style="height:10vmin;" ></div>
  <div style="width: 60%;margin: auto;text-align: center;" >
    <img style="width: 60%;" src="__IMG__/k.png" alt="">
  </div>
<?php endif; ?>
<div class="footerss">
  <p>
  共<span class="oss"><?php echo (isset($list['total_num']) && ($list['total_num'] !== '')?$list['total_num']:'0'); ?></span>件
  合计:<span style="color:#ff5500;font-size:4vmin; font-weight:bold;">￥</span><label id="total2" class="tot" style="color:#ff5500;font-size:5vmin; font-weight:bold;"><?php echo (isset($list['total_price']) && ($list['total_price'] !== '')?$list['total_price']:'0'); ?></label>
  <a href="<?php echo url('Shopcar/goorder'); ?>">去结算</a>
  </p>
</div>
<script type="text/javascript">
  $(function () {   
    $(".jia").click(function () {
      var t =$(this).prev().val();
        var newmun=parseInt(t)+1;
        $(this).prev().val(newmun);
        setTotal();
        //修改数量
        setNum($(this).prev());
    })
    $(".jian").click(function () {
      var t = $(this).next().val();
      if(t>1){
        var newmun=t-1;
      }else{
        var newmun=1;
      }
      $(this).next().val(newmun);
       setTotal();
       //修改数量
        setNum($(this).next());
    })
  })

  //修改数量
  function setNum(obj){
    var num=$(obj).val();
    var good_id=$(obj).attr('data');
    var item_id=$(obj).attr('item');
    $.ajax({
      type:"POST",
      url:"<?php echo url('Shopcar/ajaxaddcart'); ?>",
      data:{'good_id':good_id,'good_num':num,'attr_id':item_id},
      dataType:'json',
      success:function(data){
        if(data.status == 2)  //直接购买
        {
          location.href = data.url;
          return false;
        }
      }
    })
  }


  //计算总价格 
   function setTotal() {
        var totss=0;
        var totmunss=0;
        $('.commodity').each(function(){
            var one= $(this).find('input[class="dede"]').val();
            var onemun= $(this).find('.commodity-right .dedemun').val();
            var tatosl=one*onemun;
            totss=totss+tatosl;
            totmunss=parseInt(totmunss)+parseInt(onemun);
        }); 
        totss=totss.toFixed(2)
        $("#total2").html(totss);
        $(".oss").html(totmunss);
    }

  //删除
  $('.shanchu').click(function(){
    var that=$(this);
    var p= that.parents('.commodity');

    var good_id=p.find('.dedemun').attr('data');

    var item_id=p.find('.dedemun').attr('item');

  //底部对话框
    layer.open({
      content: '确实删除？'
      ,btn: ['确认', '取消']
      ,skin: 'footer'
      ,yes: function(index){
        that.parents('.commodity').remove();
        layer.close(index);
        $.post("<?php echo url('Shopcar/ajaxdeletecart'); ?>",{'good_id':good_id,'attr_id':item_id},function(res){
          // alert(res);
          setTotal();
        });
      }
    });
    
  })
  </script>


  </body>
</html>