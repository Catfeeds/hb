<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:37:"../tpl/mall/wap/user\editaddress.html";i:1517724861;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
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
 <link rel="stylesheet" href="__CSS__/dizhi.css">
<script type="text/javascript" src="__COM__/js/address.js" ></script>

<div style="margin-top: 13vmin"></div>
<section class="DZBJ-wrapper ng-scope">
    <form name="address" action="<?php echo url('User/saveaddress'); ?>" >
    <input type="hidden" name="id" value="<?php echo (isset($info['id']) && ($info['id'] !== '')?$info['id']:''); ?>">
    <!--循环项 start-->
    <section class="input_item">
        <i class="iconfont">&#xe6f8;</i>
        <section class="_content">
            <h5 class="input_name">收件人</h5>
            <section class="input_block">
                <input name="username" placeholder="收件人姓名" value="<?php echo (isset($info['user_name']) && ($info['user_name'] !== '')?$info['user_name']:''); ?>" class="ng-pristine ng-untouched ng-valid"></section>
        </section>
    </section>
    <!--循环项 end-->
    <!--循环项 start-->
    <section class="input_item">
        <i class="iconfont">&#xe622;</i>
        <section class="_content">
            <h5 class="input_name">联系电话</h5>
            <section class="input_block">
                <input name="usermobile" placeholder="收货人电话" class="ng-pristine ng-untouched ng-valid" type="tel" value="<?php echo (isset($info['user_mobile']) && ($info['user_mobile'] !== '')?$info['user_mobile']:''); ?>" ></section>
        </section>
    </section>
    <!--循环项 end-->
    <!--循环项 start-->
    <section class="input_item city" style="height: 40vmin;">
        <i class="iconfont">&#xe632;</i>
        <section class="_content city">
            <h5 class="input_name">所在地区</h5>
            <section class="input_block">
                <select id="province" name="sheng" >
                </select>
                <select id="city" name="shi" >
                </select>
                <select id="district" name="xian" >
                </select>
                
            </section>
        </section>
    </section>
    <script type="text/javascript">
      addressInit('province', 'city', 'district',"<?php echo (isset($info['province']) && ($info['province'] !== '')?$info['province']:''); ?>","<?php echo (isset($info['city']) && ($info['city'] !== '')?$info['city']:''); ?>","<?php echo (isset($info['district']) && ($info['district'] !== '')?$info['district']:''); ?>");
    </script>
    <!--循环项 end-->
    <!--循环项 start-->
    <section class="input_item">
        <i class="iconfont">&#xe6cf;</i>
        <section class="_content">
            <h5 class="input_name">详细地址</h5>
            <section class="input_block">
                <input name="detail" ng-model="areaPostcode" placeholder="收货人详细地址" class="ng-pristine ng-untouched ng-valid" type="text" value="<?php echo (isset($info['detail_address']) && ($info['detail_address'] !== '')?$info['detail_address']:''); ?>" ></section>
        </section>
    </section>
    <!--循环项 end-->
    <!--循环项 start-->
    <!-- <section class="input_item" style="height:auto">
        <i class="iconfont">&#xe651;</i>
        <section class="_content">
            <h5 class="input_name">邮政编码</h5>
            <section class="input_block">
                <textarea ng-model="areaDetail" placeholder="所在地区邮编" class="ng-pristine ng-untouched ng-valid"></textarea>
            </section>
        </section>
    </section> -->
    <!--循环项 end-->
    <!--循环项 start-->
    <section class="input_item">
        <section class="_content">
            <h5 class="input_name">是否默认</h5>
            <input <?php if(isset($info) AND ($info['is_default'] == 1)): ?>checked="true"<?php endif; ?> type="checkbox" name="default" id="checkbox" class="aa" value="1" >
        </section>
    </section>
    <!--循环项 end-->
    </form>
</section>
<!--中部内容区 end-->
<!--底部banner栏 start-->
<div style="height:0.75rem" class="ng-scope"></div>
<div class="newAddressPageBottom ng-scope">
    <a class="btn ng-scope"  href="javascript:AddAddress();" title="#">确认保存</a>
</div>
<!--底部banner栏 end-->
</div>
<script type="text/javascript">
  //修改用户信息
  function AddAddress(){

        var post_url = $("form[name='address']").attr('action');
        var post_data= $("form[name='address']").serialize();
        $.ajax({
             type: "POST",
             url: post_url,
             data:post_data,
             dataType: "json",
             success: function(data){
                if(data.status==1){
                  layer.open({
                    content: data.info
                    ,skin: 'msg'
                    ,time: 1.5 //2秒后自动关闭
                    ,end:function(index){
                      location.href=data.url;
                    }
                  });
                }
                else{
                  layer.open({
                    content: data.info
                    ,skin: 'msg'
                    ,time: 1.5 //2秒后自动关闭
                  });
                }      
              }     
        });
  }

</script>

  </body>
</html>