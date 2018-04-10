<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:36:"../tpl/home/wap/turntable\index.html";i:1521110009;}*/ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui">
    <title>宏八商城</title>
    <link rel="stylesheet" href="__CSS__/style.css">
    
    <style type="text/css">
    *{
        padding: 0;
        margin: 0;
    }
    body{background:url(__COM__/zp/zpbg.png) no-repeat;background-size: 100%;}
    .demo{width:78vmin; height:78vmin; position:relative; margin:0px auto;margin-top:0%;padding-top: 39vmin;}
    #disk{background:url(__COM__/zp/disk.png) no-repeat;background-size: 100%;width: 100%;height: 100%;}

    #start{
        width: 20vmin;
        height: 45vmin;
        position: absolute;
        top: 58.5vmin;
        left: 29vmin;
    }
    #start img{cursor: pointer;transform: rotate(359deg);width: 100%;}
    .myscroll {
        margin-right: 15%;
        margin-left: 15%;
        height: 28vmin;
        line-height: 4vmin;
        font-size: 4vmin;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e8e6e6;
        box-shadow: 0px 2px 1px #baac85;
        border-radius: 5px;
        padding: 3%;}
    .myscroll li { height: 30px;color:#ff963a;}
    .myscroll li span{float: right;}
    </style>
    <script src="__COM__/zp/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="__HOME__/layer_mobile/layer.js"></script>
    <script type="text/javascript" src="__COM__/js/home_index.js"></script>

    <script type="text/javascript" src="__COM__/zp/jQueryRotate.2.2.js"></script>
    <script type="text/javascript" src="__COM__/zp/jquery.easing.min.js"></script>
    <script src="__COM__/zp/scroll.js"></script>
    <script type="text/javascript">
    $(function(){ 
         $("#startbtn").click(function(){ 
            lottery(); 
        }); 
    }); 
    function lottery(){ 

        $.ajax({ 
            type: 'POST', 
            url: "<?php echo url('Turntable/turn'); ?>", 
            dataType: 'json', 
            cache: false, 
            error: function(){ 
                alert('出错了！'); 
                return false; 
            }, 
            success:function(json){ 
                if(json.status == 0){
                    msg_alert(json.info);
                }

                if(json.status==1){
                    $("#startbtn").unbind('click').css("cursor","default"); 
                    var a = json.info.angle; //角度 
                    var prize_name = json.info.prize_name; //奖项 
                    $("#startbtn").rotate({ 
                        duration:3000, //转动时间 
                        angle: 0, 
                        animateTo:1800+a, //转动角度 
                        easing: $.easing.easeOutSine, 
                        callback: function(){ 
                            alert(prize_name); 
                            $("#startbtn").bind('click',function(){ 
                                if(confirm('还要再来一次吗')){
                                    lottery(); 
                                    }else{
                                    return false;
                                    } 
                            }).css("cursor","pointer"); 
                        } 
                    }); 
                }




            } 
        }); 
    } 
    $(function(){
        $('.myscroll').myScroll({
            speed: 40, //数值越大，速度越慢
            rowHeight: 26 //li的高度
        });
    });
    </script>

</head>
<body class="zp_bg">
    <div class="fxm_header">
       <div class="fxm_left"><a href="javascript:history.back();"><img src="__IMG__/left.png"></a></div>
       <div class="fxm_center" style="width: 70%;"><?php echo $title; ?></div>
       <div class="fxm_right" style="width: 18%;line-height: 13vmin;padding-right: 1%;"><a href="<?php echo url('Turntable/detail'); ?>" style="color: #fff;font-size: 4vmin;"><img src="__IMG__/lw.png" style="margin-top: 0"></a></div>
    </div>
    <div style="padding-top: 13vmin;"></div>
      <!-- 转盘 s -->
    <div class="dzp_top">
      <div id="main">
         <h2 class="top_title"></h2>
         <div class="msg"></div>
         <div class="demo">
              <div id="disk"></div>
              <div id="start"><img src="__COM__/zp/start0.png" id="startbtn"></div>
         </div>
         <div class="ad_demo"></div>
      </div>
    </div>
    <!-- 转盘 e -->
    <div class="dzp_bottom">
      <img src="__IMG__/gz.jpg">
      <div class="guize">
        <p>1.每抽奖1次需要100个积分；</p>
        <p>2.抽中积分奖励，则积分自动添加到您的总积分中；</p>
        <!-- <p>3.抽中宏宝奖励，则宏宝自动添加到您的总宏宝中；</p> -->
      </div>
    </div>
<div style="height:10vmin;float: left;display: block;width: 100%;"></div>

</body>
</html>

