<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:33:"../tpl/mall/wap/good\details.html";i:1519458152;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
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
   <link href="__CSS__/ui-choose.css" rel="stylesheet" />
  <style type="text/css">
      .shuliang {
        font-size: 4.5vmin;
        margin: 10vmin 0;
        display: list-item;
    }
  </style>
  <!-- 轮播图 -->
  <div class="main-content ng-scope" id="main_content">
        <div class="main_visual details">
            <div class="flicking_con">
                <?php if(is_array($list_img) || $list_img instanceof \think\Collection || $list_img instanceof \think\Paginator): if( count($list_img)==0 ) : echo "" ;else: foreach($list_img as $key=>$v): ?>
                <a href="#"></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="main_image">
                <ul>
                    <?php if(is_array($list_img) || $list_img instanceof \think\Collection || $list_img instanceof \think\Paginator): if( count($list_img)==0 ) : echo "" ;else: foreach($list_img as $key=>$v): ?>
                    <li><span class="img_3"><img src="<?php echo $v['img_url']; ?>"></span></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

                <a href="javascript:;" id="btn_prev"></a>
                <a href="javascript:;" id="btn_next"></a>
            </div>   
        </div>
    </div>

    <!-- 名称 价格 -->
    <div class="details_top">
      <div class="details_bt">
        <h3><?php echo $info['good_name']; ?></h3>
        <span>
          <i class="iconfont">&#xe685;</i>
          <p>分享</p>
        </span>
      </div>
      <p class="many">￥<?php echo $info['good_price']+0; if($info['ship_fee'] == '1'): ?>
        <span>免运费</span>
        <?php endif; ?>
      </p>
      <p class="dizhi">
        <i>重量：<?php echo $info['good_weight']/1000; ?>kg</i>
        <i style="text-align: center;" >已出售<?php echo $info['good_sell_num']; ?>件</i>
        <i style="text-align: right;" >库存 <?php echo $info['good_store']; ?>件</i>
      </p>
      <?php if(!(empty($info['good_integral']) || (($info['good_integral'] instanceof \think\Collection || $info['good_integral'] instanceof \think\Paginator ) && $info['good_integral']->isEmpty()))): ?>
      <div class="details_jf"><span>送</span>购买该商品，可获得<?php echo $info['good_integral']; ?>积分</div>
      <?php endif; ?>

      <!-- <div class=" details_jf details_juan"><a href= "javascript:void(0)" onclick ="document.getElementById('lightb').style.display='block';document.getElementById('fadeb').style.display='block'" class="gwc" style="display: block;"><span>卷</span>优惠券 <img src="__IMG__/left.png"></a></div> -->
      
    </div>


    <!-- 店铺 -->
    <?php if($info['good_type'] == '1'): ?>
    <div class="dianpu">
      <div class="dianpu_left">
        <div class="dp_logo">
        <?php if(!(empty($shop_info['shop_logo']) || (($shop_info['shop_logo'] instanceof \think\Collection || $shop_info['shop_logo'] instanceof \think\Paginator ) && $shop_info['shop_logo']->isEmpty()))): ?>
        <img src="<?php echo $shop_info['shop_logo']; ?>">
        <?php else: ?>
        <img src="__IMG__/dp.png">
        <?php endif; ?>
        </div>
        <div class="dp_mc">
          <h3><?php echo (isset($shop_info['shop_name']) && ($shop_info['shop_name'] !== '')?$shop_info['shop_name']:''); ?></h3>
          <p>综合评价：5</p>
        </div>
      </div>
      <div class="dianpu_right">
        <ul>
          <li>描述相符<span>5</span></li>
          <li>服务态度<span>5</span></li>
          <li>服务态度<span>5</span></li>
        </ul>
      </div>

      <span class="anniuc"><a href="tel:<?php echo get_shop_mobile($info['seller_id']); ?>">联系卖家</a></span>
      <span class="anniuc"><a href="<?php echo url('Shoplist/index',array('bid'=>$info['seller_id'])); ?>">进入店铺</a></span>
    </div>
    <?php endif; ?>

    <!-- 评论 -->
    <div class="details_pl">
        <h3><a href="<?php echo url('Good/goodcomment',array('good_id'=>$info['good_id'])); ?>">商品评价（<?php echo $info['good_comment']; ?>）<img src="__IMG__/left.png"></a></h3>
        <div class="pinglun">
          <ul>
          <?php if(is_array($comment) || $comment instanceof \think\Collection || $comment instanceof \think\Paginator): if( count($comment)==0 ) : echo "" ;else: foreach($comment as $key=>$vo): ?>
            <li>
              <div class="pinglun_top">
                <span class="tx"><img src="__IMG__/tx.png"></span>
                <span class="mz"><?php echo isset($vo['username']) ? mb_substr($vo['username'],0,1,'utf-8'):'匿名'; ?>***</span>
                <span class="wx">
                <?php $__FOR_START_22658__=0;$__FOR_END_22658__=max($vo['star_ability'],$vo['star_attitude'],$vo['star_price']);for($i=$__FOR_START_22658__;$i < $__FOR_END_22658__;$i+=1){ ?>
                <img src="__IMG__/wx.png">&nbsp;
                <?php } ?>
                </span>
              </div>
              <p><?php echo $vo['content']; ?></p>
              <p class="wz_b"><?php if(!(empty($vo['good_item']) || (($vo['good_item'] instanceof \think\Collection || $vo['good_item'] instanceof \think\Paginator ) && $vo['good_item']->isEmpty()))): ?>参数：<?php echo $vo['good_item']; else: ?>&nbsp;&nbsp; <?php endif; ?>  <span><?php echo date('Y-m-d H:i',$vo['create_time']); ?></span></p>
            </li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
          <?php if($comment_count > 0): ?>
          <span class="anniud"><a href="<?php echo url('Good/goodcomment',array('good_id'=>$info['good_id'])); ?>">查看全部</a></span>
          <?php endif; ?>
        </div>
    </div>


    <!-- 猜你喜欢 -->
    <div class="details_pl cnxh">
        <h3><a href="javascript:void(0)">猜你喜欢<img src="__IMG__/left.png"></a></h3>
        <ul>
        <?php if(is_array($relate_list) || $relate_list instanceof \think\Collection || $relate_list instanceof \think\Paginator): if( count($relate_list)==0 ) : echo "" ;else: foreach($relate_list as $key=>$v): ?>
          <li>
            <a href="<?php echo url('Good/details',array('good_id'=>$v['good_id'])); ?>">
              <img src="<?php echo $v['good_cover_img']; ?>">
              <p>￥<?php echo $v['good_price']+0; ?></p>
            </a>
          </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>

    <!-- 产品详情 -->
    <div class="details_pl cpxq" style="margin-bottom: 15vmin;">
      <h3>产品详情</h3>
      <?php echo $info['good_content']; ?>
    </div>

    <!-- 底部信息 -->
    <div class="details_footer">
        <a href="###" class="onb">
          <i class="iconfont">&#xe601;</i>
          <p>联系卖家</p>
        </a>
         <a href="javascript:void(0)">
            <i class="iconfont">&#xe61f;</i>
            <p id="collect" >收藏</p>
        </a>
         <a href="javascript:void(0)" onclick ="document.getElementById('lighta').style.display='block';document.getElementById('fadea').style.display='block'" class="gwc">
            <p>加入购物车</p>
        </a>
         <a href="javascript:void(0)" onclick ="document.getElementById('lighta').style.display='block';document.getElementById('fadea').style.display='block'" class="goumai">
            
            <p>立即购买</p>
        </a>
    </div>

    <!-- 规格 -->
    <div id="lighta" class="white_contenta">
        <a href = "javascript:void(0)" onclick = "document.getElementById('lighta').style.display='none';document.getElementById('fadea').style.display='none'" id="details_bg">
          <img src="__IMG__/guanbi.png">
        </a>

        <div class="guige">
            <div class="guige_img"><img src="<?php echo $info['good_cover_img']; ?>"></div>
            <div class="guige_r">
              <p id="price" style="color: #f00;font-size: 5vmin; ">￥<span id="price" ><?php echo $info['good_price']; ?></span></p>
              <p >库存:<span id="store" ><?php echo $info['good_sort']; ?></span>件</p>
            </div>
        </div> 

    
        <div class="demo-box">
            <?php if(is_array($attr_list) || $attr_list instanceof \think\Collection || $attr_list instanceof \think\Paginator): if( count($attr_list)==0 ) : echo "" ;else: foreach($attr_list as $k=>$li): ?>
              <p class="item" data="0" ><?php echo $k; ?></p>
              <table class="demo-table">
                <tr>
                  <td><ul class="ui-choose">
                    <?php if(is_array($li) || $li instanceof \think\Collection || $li instanceof \think\Paginator): if( count($li)==0 ) : echo "" ;else: foreach($li as $key=>$vo): ?>
                      <li><?php echo $vo; ?></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                  </td>
                </tr>
              </table>
              <?php endforeach; endif; else: echo "" ;endif; ?>
              
              <span class="shuliang">
                  <label for="">购买数量</label>
                  <form class="sl">
                    <input class="jian" name="" style=" width:20px; height:18px;border:1px solid #ccc;" type="button" value="-">
                    <input class="dedemun" id="text_box2" name="" readonly="readonly" type="text" value="1" style=" width:30px; text-align:center; border:1px solid #ccc;">
                    <input class="jia" name="" style=" width:20px; height:18px;border:1px solid #ccc;" type="button" value="+">
                  </form>
              </span>
        </div>
        <div class="guige_b">
          <span class="annium"><a href="javascript:AjaxAddCart(<?php echo $info['good_id']; ?>,0)">加入购物车</a></span>
          <span class="annium red"><a href="javascript:AjaxAddCart(<?php echo $info['good_id']; ?>,1)">立即购买</a></span>
        </div>
    </div>
    <div id="fadea" class="black_overlaya"></div> 

    <!-- 优惠券 -->
    <div id="lightb" class="white_contentb">
        <h3>优惠券</h3>
        <ul>
          <li>
            <h2>50元</h2>
            <p>订单满830元使用（不含邮费）</p>
            <p class="j_sj">使用期限 2017-11-03-2017-11-20</p>
            <span>领取</span>
          </li>
          <li>
            <h2>50元</h2>
            <p>订单满830元使用（不含邮费）</p>
            <p class="j_sj">使用期限 2017-11-03-2017-11-20</p>
            <span>领取</span>
          </li>
          <li>
            <h2>50元</h2>
            <p>订单满830元使用（不含邮费）</p>
            <p class="j_sj">使用期限 2017-11-03-2017-11-20</p>
            <span>领取</span>
          </li>
          <li>
            <h2>50元</h2>
            <p>订单满830元使用（不含邮费）</p>
            <p class="j_sj">使用期限 2017-11-03-2017-11-20</p>
            <span>领取</span>
          </li>
          <li>
            <h2>50元</h2>
            <p>订单满830元使用（不含邮费）</p>
            <p class="j_sj">使用期限 2017-11-03-2017-11-20</p>
            <span>领取</span>
          </li>
        </ul>

        <a href = "javascript:void(0)" onclick = "document.getElementById('lightb').style.display='none';document.getElementById('fadeb').style.display='none'" id="yjq_gb">
          关闭
        </a>
    </div>
    <div id="fadeb" class="black_overlayb"></div> 
    <!-- 商品ID -->
    <input type="hidden" name="good_id" value="<?php echo $info['good_id']; ?>" >
    <!-- 选择的规格ID -->
    <input type="hidden" id="attr_id" value="" >


  <script type="text/javascript">
    $(function () {
      
      $(".jia").click(function () {
        var t =$(this).prev().val();
          var newmun=parseInt(t)+1;
          $(this).prev().val(newmun);
      })
      $(".jian").click(function () {
        var t = $(this).next().val();
        if(t>1){
          var newmun=t-1;
        }else{
          var newmun=1;
        }
        $(this).next().val(newmun);
        
      })

      $('.ui-choose li').click(function(){
        $(this).addClass('selected').siblings('li').removeClass('selected');
        $(this).parents('.demo-table').prev('.item').attr('data','1');
          //商品价格库存显示
          initGoodsPrice();

      });
    })


    //改变商品价格库存
    function initGoodsPrice() {
        var good_id = $('input[name="good_id"]').val();
        //选取的参数
        var s_arr=new Array();
        $(".demo-box li[class='selected']").each(function(k,v){
            s_arr[k]=$(this).text();
        });
        var data={'good_id':good_id,'item':s_arr}
        $.ajax({
            type : "POST",
            url:"<?php echo url('Good/getpricestore'); ?>",
            data : data,
            dataType:'json',
            success: function(data){
              if(data.status==1){
                $('#attr_id').val(data.result.id);
                $('#price').text(data.result.price);
                $('#store').text(data.result.store);
              }
            }
        });
    }



    /**
     * addcart 将商品加入购物车
     * @good_id  商品id
     * @to_catr 加入购物车后再跳转到 购物车页面 默认不跳转 1 为跳转
     */
    function AjaxAddCart(good_id,to_catr)
    {
        var num=$('#text_box2').val();
        //判断是否选择了规格
        var txt='规格';
        var i=0;
        $('.demo-box .item').each(function(k,v){
            var bool=$(this).attr('data');
            if(bool!=1){
              txt=$(this).text();
              i++;
              return false;
            }
        });

        if(i>0){
          //信息框
          layer.open({
            content:  '请选择'+txt,
            btn: '我知道了',
            time: 2
          });
          return false;
        }

        //选取的参数
        var s_arr=$('#attr_id').val();
        
        var data={'good_id':good_id,'attr_id':s_arr,'good_num':num}

        $.ajax({
            type : "POST",
            url:"<?php echo url('Shopcar/ajaxaddcart'); ?>",
            data : data,
            dataType:'json',
            success: function(data){

              if(data.status == 2)  //直接购买
              {
                layer.open({
                  content: data.info
                  ,btn: ['去登录', '再逛逛']
                  ,yes: function(index){
                    location.href = data.url;
                    layer.close(index);
                  }
                });
                return false;
              }
              

              //加入购物车后再跳转到 购物车页面
              if(data.status == 0)
              {
                layer.open({
                  content:  data.info
                  ,btn: '我知道了'
                });
                return false;
              }
              if(to_catr == 1)  //直接购买
              {
                location.href = data.url;
                return false;
              }
              //加入成功
              layer.open({
                content: '添加成功'
                ,btn: ['去购物车', '再逛逛']
                ,yes: function(index){
                  location.href = data.url;
                  layer.close(index);
                }
              });
            }
              
        });
    }



    //收藏商品
    $('#collect').click(function(){

        var good_id = $('input[name="good_id"]').val();
          $.ajax({
          type : "POST",
          dataType: "json",
          url:"<?php echo url('Good/collectgood'); ?>",
          data:{'good_id':good_id},
          success: function(data){
            layer.open({
               style: 'top:0'
              ,content: data.info
              ,skin: 'msg'
              ,time: 1 
            })
          }
        });
    })
  </script>



  </body>
</html>