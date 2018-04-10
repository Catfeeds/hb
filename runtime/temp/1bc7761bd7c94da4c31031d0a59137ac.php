<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:32:"../tpl/mall/wap/index\index.html";i:1522652362;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\bottom.html";i:1514212007;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
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
     <script type="text/javascript" src="__JS__/jquery.touchSlider.js"></script>
     <!-- 轮播图 -->
    <div class="main-content ng-scope" id="main_content">
        <div class="main_visual">
            <div class="flicking_con">
                <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): if( count($banner)==0 ) : echo "" ;else: foreach($banner as $key=>$v): ?>
                <a href="#"></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="main_image">
                <ul>
                  <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): if( count($banner)==0 ) : echo "" ;else: foreach($banner as $key=>$v): ?>
                    <li>
                      <span class="img_3">
                        <a <?php if(!(empty($v['b_link']) || (($v['b_link'] instanceof \think\Collection || $v['b_link'] instanceof \think\Paginator ) && $v['b_link']->isEmpty()))): ?> href="<?php echo $v['b_link']; ?>" <?php else: ?> href="#" <?php endif; ?> >
                          <img src="<?php echo $v['b_img']; ?>">
                        </a>
                      </span>
                    </li>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

                <a href="javascript:;" id="btn_prev"></a>
                <a href="javascript:;" id="btn_next"></a>
            </div>   
        </div>
        <form action="<?php echo url('goodlist/index'); ?>" method="get" id="search">
          <input name="keywork" type="text" placeholder="请输入关键词" id="sou">
          <span onclick="document.getElementById('search').submit()" ><i class="iconfont"></i></span>
        </form>
    </div>
    <!-- 轮播图 -->


    <!-- 下分类 -->
    <div class="type">
      <ul>
        <?php if(is_array($cate_info) || $cate_info instanceof \think\Collection || $cate_info instanceof \think\Paginator): if( count($cate_info)==0 ) : echo "" ;else: foreach($cate_info as $key=>$v): ?>
        <li>
          <a href="<?php echo url('Goodlist/index',array('id'=>$v['id'])); ?>">
            <span><img src="<?php echo $v['image']; ?>"></span>
            <p style="width: 100%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;" ><?php echo $v['name']; ?></p>
          </a>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <li>
          <a href="<?php echo url('mall/Goodtype/index'); ?>">
            <span><i class="iconfont"></i></span>
            <p>分类</p>
          </a>
        </li>
      </ul>
    </div>
    <!-- 下分类完 -->


    <!-- 最新动态 公告 -->
    <div class="notice">
      <div class="notice_left"><img src="__IMG__/gg.jpg"></div>
      <div class="notice_right">
        <?php if(is_array($newlist) || $newlist instanceof \think\Collection || $newlist instanceof \think\Paginator): if( count($newlist)==0 ) : echo "" ;else: foreach($newlist as $key=>$v): ?>
        <p><a href="<?php echo url('News/detail',array('id'=>$v['id'])); ?>"><span>最新</span><?php echo $v['title']; ?></a></p>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
    </div>


    <!-- 今日优选 -->
    <div class="youxuan">
      <?php 
        $recommend=goodlist(array('is_recommend'=>1),5);
       ?>
      <h3>精品推荐 <span>BOUTIQUE PREFERRED</span></h3>
        <div class="yx_l">
          <?php if(is_array($recommend) || $recommend instanceof \think\Collection || $recommend instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($recommend) ? array_slice($recommend,0,1, true) : $recommend->slice(0,1, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <div class="yx_l_t">
            <p class="biaoti">值得买</p>
            <p><?php echo $vo['good_name']; ?></p>
            <p class="color">¥ <?php echo $vo['good_price']+0; ?></p>
            <p class="tupian"><a href="<?php echo url('Good/details',array('good_id'=>$vo['good_id'])); ?>"><img src="<?php echo $vo['good_cover_img']; ?>"></a></p>
          </div>
          <?php endforeach; endif; else: echo "" ;endif; if(is_array($recommend) || $recommend instanceof \think\Collection || $recommend instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($recommend) ? array_slice($recommend,1,1, true) : $recommend->slice(1,1, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <div class="yx_l_b">
            <div class="yx_left">
              <p class="biaoti gules">必抢</p>
              <p>¥<?php echo $vo['good_price']+0; ?></p>
            </div>
            <div class="yx_right">
              <a href="<?php echo url('Good/details',array('good_id'=>$vo['good_id'])); ?>">
              <img src="<?php echo $vo['good_cover_img']; ?>">
              </a>
            </div>
          </div> 
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="yx_r">
          <?php if(is_array($recommend) || $recommend instanceof \think\Collection || $recommend instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($recommend) ? array_slice($recommend,2,3, true) : $recommend->slice(2,3, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
          <div class="yx_r_a">
            <a href="<?php echo url('Good/details',array('good_id'=>$vo['good_id'])); ?>">
              <div class="yx_left">
                <p class="biaoti Violet">清仓价</p>
                <p><?php echo $vo['good_name']; ?></p>
              </div>
              <div class="yx_right">
                <img src="<?php echo $vo['good_cover_img']; ?>">
              </div>
            </a>
          </div>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>  
      
    </div>
    <!-- 今日优选 -->


    <!-- 美丽人生 -->
     <?php 
        $hot=goodlist(array('is_hot'=>1),6);
      ?>
    <div class="youxuan mlrs">
      <h3>热门商品 <span>HOT &amp; COMMODITY</span></h3>
        <?php if(is_array($hot) || $hot instanceof \think\Collection || $hot instanceof \think\Paginator): $k = 0;$__LIST__ = is_array($hot) ? array_slice($hot,0,2, true) : $hot->slice(0,2, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
        <div class="yx_l <?php if($k == '1'): ?>yx_r<?php endif; ?>">
          <a href="<?php echo url('Good/details',array('good_id'=>$vo['good_id'])); ?>">
            <div class="yx_l_t">
              <p><?php echo $vo['good_name']; ?></p>
              
              <p class="tupian"><img src="<?php echo $vo['good_cover_img']; ?>"></p>
            </div>
          </a>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?> 
        <ul id="mlsr_b">
        <?php if(is_array($hot) || $hot instanceof \think\Collection || $hot instanceof \think\Paginator): $k = 0;$__LIST__ = is_array($hot) ? array_slice($hot,2,4, true) : $hot->slice(2,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
          <li>
            <a href="<?php echo url('Good/details',array('good_id'=>$vo['good_id'])); ?>">
              <p><?php echo $vo['good_name']; ?></p>
              
              <p><img src="<?php echo $vo['good_cover_img']; ?>"></p>
            </a>
          </li>
         <?php endforeach; endif; else: echo "" ;endif; ?> 
        </ul>
    </div>
    <!-- 美丽人生 -->

     <!-- 迷人秋妆 -->
     <?php 
        $new=goodlist(array('is_new'=>1),6);
      ?>
    <div class="youxuan qrmz">
      <h3>新品上市 <span>NEW COMMODITY</span></h3>
      <img src="__IMG__/banner1.jpg">
      <div class="qrmz_bottom">

        <?php if(is_array($hot) || $hot instanceof \think\Collection || $hot instanceof \think\Paginator): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div class="qrmz_kuai">
          <a href="<?php echo url('Good/details',array('good_id'=>$vo['good_id'])); ?>">
            <div class="kuai_img"><img src="<?php echo $vo['good_cover_img']; ?>"></div>
            <div class="kuai_right">
              <p style="overflow: hidden; text-overflow: ellipsis;white-space: nowrap; width: 100%;" ><?php echo $vo['good_name']; ?></p>
              <i>￥<?php echo $vo['good_price']+0; ?></i>
            </div>
          </a>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?> 

      </div>  
    </div>
    <!-- 迷人秋妆 -->

    <!-- 猜你喜欢 -->
    <div class="youxuan footers">
        <h1>
            <span class="line-left"></span>
            <em><img src="__IMG__/fire.png" alt="">猜你喜欢</em>
            <span class="line-right"></span>
        </h1>
        <ul>
          <?php 
            $like=goodlist(array(),4,'good_id desc');
           if(is_array($like) || $like instanceof \think\Collection || $like instanceof \think\Paginator): if( count($like)==0 ) : echo "" ;else: foreach($like as $key=>$vo): ?>
            <li>
                <a href="<?php echo url('Good/details',array('good_id'=>$vo['good_id'])); ?>" style=" display: block;float: left;">
                    <img src="<?php echo $vo['good_cover_img']; ?>" alt="">
                    <div class="footers-rights">
                        <h2><?php echo $vo['good_name']; ?></h2>
                        <!-- <em>一口一个刚刚好</em><span>450-500g</span> -->
                        <p>
                            <strong>￥<?php echo $vo['good_price']+0; ?></strong>
                            <i>市场价:<?php echo $vo['market_price']+0; ?></i>
                        </p>
                    </div>
                    <i class="iconfont"></i>
                </a>
            </li>
           <?php endforeach; endif; else: echo "" ;endif; ?>

        </ul>
    </div>
	<div style="height:20vmin;float: left;display: block;width: 100%;"></div>

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