<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:34:"../tpl/mall/wap/user\userinfo.html";i:1514963020;s:27:"../tpl/mall/wap/layout.html";i:1514212007;s:34:"../tpl/mall/wap/public\header.html";i:1521107557;s:34:"../tpl/mall/wap/public\footer.html";i:1514212007;}*/ ?>
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
    <script type="text/javascript" src="__COM__/js/ajaxfileupload.js"></script>
    <div class="myselves">
        <div class="self-informations2">
            <p style="background: none" >
              <em>头像</em>
              <span style="overflow:hidden;">
                <a href="javascript:updatehead()" data-reveal-id="myModal">
                  <?php if(!(empty($u_info['head_img']) || (($u_info['head_img'] instanceof \think\Collection || $u_info['head_img'] instanceof \think\Paginator ) && $u_info['head_img']->isEmpty()))): ?>
                  <img id="img" style="width: 90%;height: auto;" src="<?php echo $u_info['head_img']; ?>">
                  <?php else: ?>
                  <img id="img" style="width: 90%;height: auto;" src="__IMG__/a1.png">
                  <?php endif; ?>
                </a>
              </span>
            </p>
             <input style="display:none" id="up_img" data="head_img" name="up_img" type="file" onchange="uploadhead('up_img','<?php echo url('home/Common/uplodeimg'); ?>');" >
            <p style="background: none">
                <em>姓名</em>
                <strong><?php echo $u_info['username']; ?></strong>
            </p>
            <p style="background: none">
                <em>账号</em>
                <strong><?php echo $u_info['account']; ?></strong>
            </p>
            <p style="background: none">
                <em>手机</em>
                <strong><?php echo $u_info['mobile']; ?></strong>
            </p>
            <p style="background: none">
                <em style="width:30%" >注册时间</em>
                <strong><?php echo date('Y-m-d',$u_info['reg_date']); ?></strong>
            </p>

        </div>
      </div>

      <div class="clear"></div>

    <div style="height:10vmin;float: left;display: block;width: 100%;"></div>

  <script type="text/javascript">
  function updatehead(){
    $('#up_img').click();
  }

  //上传图片
  function uploadhead(eid,url) { 
      //正在加载
      var index=layer.open({
        type: 2
        ,content: '上传中'
      });
     
      $.ajaxFileUpload({
      
          url:url,
          secureuri:false ,
          fileElementId:eid,
          dataType: 'text',
          success: function (data,status)  
          {
            layer.close(index);//关闭加载
            var data = $.parseJSON(data);
             if(data.status){
               $('#img').attr('src',data.path);
               var pdata={head_img:data.path}
                   postdata(pdata);
             }else{
               msg_alert(data.error);
             }
            
          },
          error: function (data, status, e)
          {
            alert(e);
          }
        });
      return false;

    }
    function postdata(pdata,txt){
      $.ajax({
             type: "POST",
             url: "<?php echo url('home/usercenter/usermessage'); ?>",
             data:pdata,
             dataType: "json",
             success: function(data){
                if(data.status==1){
                  if(txt){
                    $('.email span').text(txt);
              layer.closeAll()
                  }
                }else{
                    msg_alert(data.info);
                }      
              }     
        });
    }
  </script>

  </body>
</html>