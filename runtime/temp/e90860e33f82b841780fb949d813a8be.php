<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:39:"../tpl/home/wap/userinfo\checkuser.html";i:1517641893;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $site_info['WEB_SITE_TITLE']; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui">
  <meta name="description" content="<?php echo $site_info['WEB_SITE_DESCRIPTION']; ?>">
  <meta name="Keywords" content="<?php echo $site_info['WEB_SITE_KEYWORD']; ?>">
  <link rel="stylesheet" href="__CSS__/style.css">
  <script type="text/javascript" src="__JS__/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="__HOME__/layer_mobile/layer.js"></script>
  <script type="text/javascript" src="__COM__/js/home_index.js"></script>
</head>
<body>
  <?php if(empty($head_datail_url) || (($head_datail_url instanceof \think\Collection || $head_datail_url instanceof \think\Paginator ) && $head_datail_url->isEmpty())): ?>
    <div class="fxm_header">
       <div class="fxm_left"><a href="<?php echo (isset($back_url) && ($back_url !== '')?$back_url:'javascript:history.back();'); ?>"><img src="__IMG__/left.png"></a></div>
       <div class="fxm_center"><?php echo (isset($title) && ($title !== '')?$title:$site_info['WEB_SITE_TITLE']); ?></div>
    </div>
    <?php else: ?>
    <div class="fxm_header">
       <div class="fxm_left"><a href="<?php echo (isset($back_url) && ($back_url !== '')?$back_url:'javascript:history.back();'); ?>"><img src="__IMG__/left.png"></a></div>
       <div class="fxm_center" style="width: 75%;"><?php echo (isset($title) && ($title !== '')?$title:$site_info['WEB_SITE_TITLE']); ?></div>
       <div class="fxm_right" style="width: 13%;line-height: 13vmin;padding-right: 1%;">
          <a href="<?php echo $head_datail_url; ?>" style="color: #fff">记录</a>
       </div>
    </div>
  <?php endif; ?>


     <link rel="stylesheet" type="text/css" href="__CSS__/jquery-weui.min.css" />
    <script src="__JS__/datePicker.js"></script>
   <div style="padding-top: 13vmin;"></div>
    <div class="shezhi qyrz1">
        <form class="postfrom" action="<?php echo url('checkuser'); ?>">
        <ul>
            <!-- <li>店铺名称<span><input type="text" placeholder="请填写店铺名称" name="shop_name" value="<?php echo (isset($info['shop_name']) && ($info['shop_name'] !== '')?$info['shop_name']:''); ?>" /></span></li> -->
            <li>姓&nbsp;&nbsp;&nbsp;&nbsp;名<span><input type="text" name="username" value="<?php echo $info['username']; ?>" placeholder="请填写姓名"></span></li>
            <li>国&nbsp;&nbsp;&nbsp;&nbsp;家
                <span>
                  中国
                    <!-- <select>
                      <option value ="中国">中国</option>
                      <option value ="法国">法国</option>
                    </select> -->
                </span>
            </li>
           <li>证件类型
                <span style="margin-left:9%" >
                    <select name="idcard_type" >
                      <option <?php if($info['idcard_type'] == '0'): ?>selected="true"<?php endif; ?>  value ="0">大陆身份证</option>
                      <option <?php if($info['idcard_type'] == '1'): ?>selected="true"<?php endif; ?> value ="1">非大陆身份证</option>
                    </select>
                </span>
            </li>
            <!-- <li>行业分类
                <span>
                    <select>
                      <option value ="请选择">请选择</option>
                      <option value ="行业分类">行业分类</option>
                      <option value ="行业分类">行业分类</option>
                      <option value ="行业分类">行业分类</option>
                    </select>
                </span>
            </li> -->
            <li>身份证<span><input type="text" name="idcard" value="<?php echo (isset($info['idcard']) && ($info['idcard'] !== '')?$info['idcard']:''); ?>" placeholder="请填写身份证" onfocus="this.placeholder=''" onblur="this.placeholder='请填写身份证'" maxlength="18"></span></li>
            <li>证件有效期
                <span style="margin-left:5%" >
                   <input id="demo1" name="idcar_startdate" value="<?php echo (isset($info['idcar_startdate']) && ($info['idcar_startdate'] !== '')?$info['idcar_startdate']:''); ?>" placeholder="请选择起始日" style="width:30%">
                </span>
                至
                <span  style="margin-left:5%;width:40%" >
                    <input id="demo2" name="idcar_endtdate" value="<?php echo (isset($info['idcar_endtdate']) && ($info['idcar_endtdate'] !== '')?$info['idcar_endtdate']:''); ?>" placeholder="请选择到期日" style="width:30%">
                </span>
            </li>

             <li>所在区域
                <span style="margin-left:9%" >
                    <input type='text' name="area" value="<?php echo (isset($info['area']) && ($info['area'] !== '')?$info['area']:''); ?>" id='city-picker' placeholder='请选择所在区域' />
                </span>    
            </li>
        </ul>
        </form>
        <p>您正在申请个人认证</p>
    </div>

    <span id="anniu"><a href="javascript:" class="post"  target-from="postfrom" >下一步</a></span>
    <div style="padding-bottom: 10vmin"></div>

    <script type="text/javascript" src="__JS__/jquery-weui.min.js"></script>
    <script type="text/javascript" src="__JS__/city-picker.min.js"></script>
    <script>
     
      $('.post').click(function(){
          var datafrom=$(this).attr('target-from');
          var post_url = $("."+datafrom).attr('action');
          var post_data= $("."+datafrom).serialize();
          if(post_url){
              $.ajax({
                 type: "POST",
                 url: post_url,
                 data:post_data,
                 dataType: "json",
                 success: function(data){
                    if(data.status==1){
                          window.location.href=data.url;
                    }else{
                        msg_alert(data.info);
                    }      
                  }    
            });
          }
      });



        $("#city-picker").cityPicker({
            title: "选择省市区/县",
            onChange: function (picker, values, displayValues) {
                // console.log(values, displayValues);
            }
        });
    </script>

    <script>
        var calendar = new datePicker();
        calendar.init({
             /*按钮选择器，用于触发弹出插件*/
            'trigger': '#demo1',
            /*模式：date日期；datetime日期时间；time时间；ym年月；*/
            'type': 'date',
            /*最小日期*/
            'minDate':'1900-1-1',
            /*最大日期*/
            'maxDate':'2100-12-31',
            'onSubmit':function(){
              /*确认时触发事件*/
                var theSelectData=calendar.value;
            },
              /*取消时触发事件*/
            'onClose':function(){
            }
        });
        var calendar = new datePicker();
        calendar.init({
            /*按钮选择器，用于触发弹出插件*/
            'trigger': '#demo2', 
            /*模式：date日期；datetime日期时间；time时间；ym年月；*/
            'type': 'date',
            /*最小日期*/
            'minDate':'1900-1-1',
            /*最大日期*/
            'maxDate':'2100-12-31',
              /*确认时触发事件*/
            'onSubmit':function(){
                var theSelectData=calendar.value;
            },
              /*取消时触发事件*/
            'onClose':function(){
            }
        });
        </script>

  </body>
</html>