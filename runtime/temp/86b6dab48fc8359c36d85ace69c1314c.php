<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:35:"../tpl/mall/wap/goodtype\index.html";i:1514949744;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\bottom.html";i:1514212007;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
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
<div class="banner">
  <form action="<?php echo url('goodlist/index'); ?>" method="get" id="formsearch">
    <input type="text" name="keywork" placeholder="搜索商品" onfocus="this.placeholder=''" onblur="this.placeholder='搜索商品'"/>
    <div onclick="document.getElementById('formsearch').submit()" class="search">
      <img src="__IMG__/search.png" alt="">
    </div>
  </form>
</div>
<div class="choices">
    <ul>
    <?php if(is_array($cate_list) || $cate_list instanceof \think\Collection || $cate_list instanceof \think\Paginator): if( count($cate_list)==0 ) : echo "" ;else: foreach($cate_list as $k=>$v): ?>
      <li >
        <a <?php if($k == '0'): ?>class="on"<?php endif; ?>  href="javascript:"><?php echo $v['name']; ?></a>
      </li>
    <?php endforeach; endif; else: echo "" ;endif; ?> 
    </ul>
</div>

<div class="menu-two" >
    <?php if(is_array($cate_list) || $cate_list instanceof \think\Collection || $cate_list instanceof \think\Paginator): if( count($cate_list)==0 ) : echo "" ;else: foreach($cate_list as $k1=>$v1): ?>
    <div class="item" <?php if($k1 == '0'): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>
    <?php if(!(empty($v1['_child']) || (($v1['_child'] instanceof \think\Collection || $v1['_child'] instanceof \think\Paginator ) && $v1['_child']->isEmpty()))): if(is_array($v1['_child']) || $v1['_child'] instanceof \think\Collection || $v1['_child'] instanceof \think\Paginator): if( count($v1['_child'])==0 ) : echo "" ;else: foreach($v1['_child'] as $k2=>$v2): ?>
      <h3><?php echo $v2['name']; ?></h3>
      <ul>
       <?php if(!(empty($v2['_child']) || (($v2['_child'] instanceof \think\Collection || $v2['_child'] instanceof \think\Paginator ) && $v2['_child']->isEmpty()))): if(is_array($v2['_child']) || $v2['_child'] instanceof \think\Collection || $v2['_child'] instanceof \think\Paginator): if( count($v2['_child'])==0 ) : echo "" ;else: foreach($v2['_child'] as $k3=>$v3): ?>
        <li>
          <a href="<?php echo url('Goodlist/index',array('id'=>$v3['id'])); ?>" class="tpdiv">
            <span><img src="<?php echo $v3['image']; ?>" alt=""></span>
            <p><?php echo $v3['name']; ?></p>
          </a>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
      </ul>
      <?php endforeach; endif; else: echo "" ;endif; endif; ?>
      <a href="#" class="ckgd"></a>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?> 
    
</div>

  <script type="text/javascript">
    $('.choices li').click(function(){
      $(this).siblings('li').children('a').removeClass('on');
      $(this).children('a').addClass('on');
      var index=$(this).index();
      $('.menu-two .item').eq(index).show().siblings('.item').hide();
    })
  </script>


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