<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:43:"../tpl/home/wap/usercenter\usermessage.html";i:1514961555;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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


 
	<style type="text/css">
		.grxx ul li div img{
			width: 10vmin;
		    height: 10vmin;
		    border-radius: 100%;
		    border: 1px solid #ddd;

		}
		.boxlayer {
		    border: 1px solid #ccc;
		    width: 100%;
		    line-height: 8vmin;
		    text-align: center;
		}
		.boxbtn {
		    background: #d05b24;
		    color: white;
		    width: 100%;
		    line-height: 8vmin;
		    margin-top: 4vmin;
		}
	</style>
	<script type="text/javascript" src="__COM__/js/ajaxfileupload.js"></script>
	<div style="padding-top: 13vmin;"></div>
    <div class="shezhi grxx">
        <ul>
            <li class="noback" >
            头像
            <div class="img" style="float: right;">
            <?php if(empty($info['head_img']) || (($info['head_img'] instanceof \think\Collection || $info['head_img'] instanceof \think\Paginator ) && $info['head_img']->isEmpty())): ?>
            <img src="__IMG__/a1.png">
            <?php else: ?>
            <img src="<?php echo $info['head_img']; ?>">
            <?php endif; ?>
            </div>
            <input style="opacity: 0;" id="up_img" data="head_img" name="up_img" type="file" onchange="uploadhead('up_img','<?php echo url('Common/uplodeimg'); ?>');" >
            </li>
            <li class="noback" >姓名 <span><?php echo $info['username']; ?></span></li>
            <li class="email" >邮箱 
            	<span style="margin-right:5vmin" ><?php echo $info['email']; ?></span>
            </li>
            <li class="noback" >手机号 <span><?php echo $info['mobile']; ?></span></li>
            <li class="noback" >注册时间 <span><?php echo date("Y-m-d H:i:s",$info['reg_date']); ?></span></li>
				
            <!-- <li>性别 <span>女</span></li>
            <li>身份证 <span>455877985785963254</span></li> -->
        </ul>
    </div>



	<script type="text/javascript">
		$('.img').click(function(){
			$("#up_img").click();
		})

		$('.email').click(function(){
			 //页面层
			layer.open({
			    type: 1
			    ,content: '<div style="width: 60%;margin: auto;text-align:center" ><input class="boxlayer" type="text" placeholder="请输入邮箱" ><input class="boxbtn" type="button" onclick="surepost(this)" value="确定" > </div>'
			    ,anim: 'up'
			    ,style: 'position:fixed; bottom:0; left:0; width: 100%; height: 20vmin; padding:5vmin; border:none;'
			});
		})
		

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
		           $('#'+eid).prev('div').find('img').attr('src',data.path);
		           $("input[name='"+$('#'+eid).attr('data')+"']").val(data.path);
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



		function surepost(obj){
			var txt=$(obj).prev().val();
			if(txt){
				var data={email:txt}
				postdata(data,txt);
			}
		}

		function postdata(pdata,txt){
			$.ajax({
		         type: "POST",
		         url: "<?php echo url('usermessage'); ?>",
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