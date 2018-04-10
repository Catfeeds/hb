<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:35:"../tpl/home/wap/usersign\index.html";i:1517484810;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
    body{
        background: #f1f1f1;
    }
    </style>
  <!-- 签到 layer end -->
  <script src="__JS__/jquery-1.10.2.min.js"></script>
  <link rel="stylesheet" href="__CSS__/qiandao_style.css">
    <script>  
        $(function() {  
            var widthUl = $('#js-qiandao-main').width(); 
            // li的宽度和高度  
            var widthLi = (widthUl - 7)/7;   
            if(widthLi < 45){  
                $('#js-qiandao-list').css('marginTop','40px');    
            }else if(widthLi > 45 && widthLi < 50){  
                $('#js-qiandao-list').css('marginTop','50px');    
            }  
            var signFun = function() {  
                var day_str = $('#daystr').val();
                var dateArray =day_str.split(",");// 已经签到的天  
                if(day_str==''){
                  dateArray=[];
                }
                // var oo =dateArray[0];
                 // alert(day_str);
                var $dateBox = $("#js-qiandao-list"),  
                    $currentDate = $(".current-date"),  
                    $qiandaoBnt = $("#js-just-qiandao"),  
                    _html = '',  
                    _handle = true,  
                    myDate = new Date();  
                // $currentDate.text(myDate.getFullYear() + '年' + parseInt(myDate.getMonth() + 1) + '月' + myDate.getDate() + '日');  
          
                var monthFirst = new Date(myDate.getFullYear(), parseInt(myDate.getMonth()), 1).getDay();  
          
                var d = new Date(myDate.getFullYear(), parseInt(myDate.getMonth() + 1), 0);  
                var totalDay = d.getDate(); //获取当前月的天数  
          
                for (var i = 0; i < 32; i++) {  
                    _html += ' <li><div class="qiandao-icon"></div></li>'  
                }  

                $dateBox.html(_html) //生成日历网格  
                var $dateLi = $dateBox.find("li");  
                for (var i = 0; i < totalDay; i++) {  
                    $dateLi.eq(i + monthFirst).addClass("date" + parseInt(i + 1)).attr('data-num',parseInt(i + 1));  
                    for (var j = 0; j < dateArray.length; j++) {  
                        if (i == dateArray[j]) {
                            $dateBox.find("li[data-num='"+i+"']").addClass("qiandao");  
                            // $dateLi.eq(i).addClass("qiandao");  
                        }  
                    }  
                } //生成当月的日历且含已签到  
                  
                for(var i = 1; i < 32; i++){  
                    var liNum = $dateLi.eq(i).attr('data-num');  
                    if(liNum != 'undefined' && liNum != '' && liNum != null){ 
                        $('.date'+liNum).append(liNum);   
                    }     
                } //    嵌入天  
                  
                // 没有天的li背景变色  
            for(var i = 0; i < $dateLi.length; i++){  
                if(i < monthFirst || i>(totalDay+monthFirst-1)){  
                    $dateLi.eq(i).css('background','#eee');  
                }     
            }  
          
                $(".date" + myDate.getDate()).addClass('able-qiandao');  
          
                $dateBox.on("click", "li", function() {  
                        if ($(this).hasClass('able-qiandao') && _handle) {  
                            $(this).addClass('qiandao');  
                            qiandaoFun();  
                        }  
                    }) //签到  
          
                $qiandaoBnt.on("click", function() {  
                    if (_handle) {  
                        qiandaoFun();  
                    }  
                }); //签到  
          
                function qiandaoFun() {  
                    var url="<?php echo url('Usersign/signadd'); ?>";
                    var data={'com_id':1};
                    $.post(url,data,function(mes){
                        if(mes['status']==1){
                            $qiandaoBnt.addClass('actived'); 
                            $('#one').text(mes['qiandaomun']); 
                             openLayer("qiandao-active", qianDao); 
                        }else{
                           msg_alert(mes['msg'],'');
                        }
                    }); 
                    
                }  
          
                function qianDao() {  
                    $(".date" + myDate.getDate()).addClass('qiandao');  
                }  
            }();  
          
            function openLayer(a, Fun) {  
                $('.' + a).fadeIn(Fun)  
            } //打开弹窗  
          
            var closeLayer = function() {  
                    $("body").on("click", ".close-qiandao-layer", function() {  
                        $(this).parents(".qiandao-layer").fadeOut()  
                    })  
                }() //关闭弹窗  
          
            $("#js-qiandao-history").on("click", function() {  
                openLayer("qiandao-history-layer", myFun);  
          
                function myFun() {  
                    console.log(1)  
                } //打开弹窗返回函数  
            })  
            $('.qiandao-icon').css('width',widthLi+'px').css('height',widthLi+'px');  
        })  
    </script>



    <div style="padding-top: 13vmin;"></div>
    <div class="qiandao-warp">
        <div class="qiandap-box">
            <div class="qiandao_img">
               <img src="__IMG__/jb.png">
               <p>已连续签到<i><?php echo (isset($qd_info['lian_day']) && ($qd_info['lian_day'] !== '')?$qd_info['lian_day']:"0"); ?></i>天</p>
               <p>本月共获得<i><?php echo (isset($qd_info['total_jifen']) && ($qd_info['total_jifen'] !== '')?$qd_info['total_jifen']:"0"); ?></i>积分</p>
            </div>
            <div class="qiandao-right">
                    <div class="qiandao-top">
                        <div class="just-qiandao" id="js-just-qiandao">
                        </div>
                    </div>
                </div><div class="qiandao-con clear">
                <div class="qiandao-left">
                    <div class="qiandao-left-top clear">
                        <div class="current-date"><?php echo $time; ?></div>
                        <div class="qiandao-history qiandao-tran qiandao-radius" id="js-qiandao-history">我的签到</div>
                    </div>
                    <div class="qiandao-main" id="js-qiandao-main">
                        <ul class="qiandao-list" id="js-qiandao-list"> </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <input type="hidden" id='daystr' value="<?php echo $qd_info['day']; ?>">
    <input type="hidden" id='daymun' value="<?php echo $qd_info['totalday']; ?>">
     <!-- 查看签到规则 -->
        <div style="padding: 3% 3%;" class="qdgz">
            <a href="javascript:">每签到一次获得10个积分,连续签到7天，得70+30=100个积分</a>
        </div>
    <!-- 我的签到 layer start -->
    <div class="qiandao-layer qiandao-history-layer">
        <div class="qiandao-layer-con qiandao-radius">
            <a href="javascript:;" class="close-qiandao-layer qiandao-sprits"></a>
            <ul class="qiandao-history-inf clear">
                <li>
                    <p>连续签到</p>
                    <h4><?php echo (isset($qd_info['lian_day']) && ($qd_info['lian_day'] !== '')?$qd_info['lian_day']:"0"); ?></h4>
                </li>
                <li>
                    <p>本月签到</p>
                    <h4><?php echo (isset($qd_info['totalday']) && ($qd_info['totalday'] !== '')?$qd_info['totalday']:"0"); ?></h4>
                </li>
                <li>
                    <p>总共签到数</p>
                    <h4><?php echo (isset($qd_info['sign_total']) && ($qd_info['sign_total'] !== '')?$qd_info['sign_total']:"0"); ?></h4>
                </li>
                <li>
                    <p>签到累计奖励</p>
                    <h4><?php echo (isset($qd_info['jf_daysign']) && ($qd_info['jf_daysign'] !== '')?$qd_info['jf_daysign']:"0"); ?></h4>
                </li>
            </ul>
            <div class="qiandao-history-table">
                <table>
                    <thead>
                        <tr>
                            <th>签到日期</th>
                            <th>奖励</th>
                           <!--  <th>说明</th> -->
                        </tr>
                    </thead>
                    </table>
                    <table>
                        <tbody>

                        <?php if(is_array($d_info) || $d_info instanceof \think\Collection || $d_info instanceof \think\Paginator): if( count($d_info)==0 ) : echo "" ;else: foreach($d_info as $key=>$v): ?>
                        <tr>
                            <td><?php echo date("Y-m-d H:i",$v['d_addtime']); ?></td>
                            <td><?php echo $v['d_money']; ?>积分</td>
                         <!--    <td>连续签到19天奖励</td> -->
                        </tr>
                       <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                
            </div>
        </div>
        <div class="qiandao-layer-bg"></div>
    </div>
    <!-- 我的签到 layer end -->
    <!-- 签到 layer start -->
    <div class="qiandao-layer qiandao-active">
        <div class="qiandao-layer-con qiandao-radius" style="height: initial;top: 33%">
            <a href="javascript:;" class="close-qiandao-layer qiandao-sprits"></a>
            <div class="yiqiandao clear">
                <div class="yiqiandao-icon qiandao-sprits"></div>
                <p>您已连续签到<span id='one'><?php echo (isset($qd_info['lian_day']) && ($qd_info['lian_day'] !== '')?$qd_info['lian_day']:"0"); ?></span>天</p>
            </div>
            
        </div>
        <div class="qiandao-layer-bg"></div>
    </div>
    <!-- 签到 layer end -->

    <div class="re_meg">
<!--弹框S-->
    </div>

<style>
.qiandao-list li{
    text-align: center;
    font-size: 5vmin;
    font-weight: bold;
    color: #ad560e;
    width:10.4vmin;
    height:10.4vmin;
    line-height:10.4vmin;
    margin-top: 0.8vmin;
}
.zzc{position: fixed;width: 100%;height:100%;top:0;background-color: rgba(0, 0, 0, 0.71);z-index: 100}

@-webkit-keyframes fadeInOut {
    0% {
        opacity:0;
     }
    100% {
        opacity:1;
    }
}


.tswzaa { 
    position: fixed; 
    -webkit-animation-name: fadeInOut;
    -webkit-animation-timing-function: ease-in-out;
    -webkit-animation-duration: 1s;

    top: 43%;
    left: 18%;
    width: 60%;
    border-radius: 1vmin;
    text-align: center;
    background: #fff;
    color: #f97102;
    font-size: 3.5vmin;
    font-weight: bold;
    z-index: 1000;
    padding: 5% 2%;line-height: 6vmin}
.tswzaa p{ padding-top: 5%;border-top: 1px solid #ddd;margin-top: 5%;color: #969696}
</style>
<!--弹框E-->
<script type="text/javascript">
   $('.dede').click(function(){
        message('操作成功','');
   })

    function message(meg,url){
        $('.re_meg').html(' ');
        if(url=='' || url ==null)
            url='';
        var strs = str_html(meg,url);
        $('.re_meg').html(strs);
    }

    function clce(url){
        $('.re_meg').html(' ');
        if(typeof(url) == undefined || url=='' || url==null){
            return false;
        }
        window.location.href=url;
        
   }
    function str_html(msg,url){
        var _html='';
          _html+='<div class="tswzaa" >'+msg+'<p id="cloce"  class="cloce" onclick=\'clce("'+url+'")\'>确定</p></div><div class="zzc"></div>';
          return _html;
    }
</script>

  </body>
</html>