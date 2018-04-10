<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:36:"../tpl/home/wap/around\typelist.html";i:1516945799;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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


 <link rel="stylesheet" href="__CSS__/task.css">
<script type="text/javascript" src="__JS__/jquery.reveal.js"></script>
<script src="http://api.map.baidu.com/api?v=2.0&ak=1byTpUa3aXZvRKON0c2Ybd5NpQCb3no0"></script>  
<script type="text/javascript">  
      // 浏览器可显示
    var geolocation = new BMap.Geolocation();    
    var gc = new BMap.Geocoder();     
      
    //定位结果对象会传递给r变量  
    geolocation.getCurrentPosition(function(r) {
                
            //通过Geolocation类的getStatus()可以判断是否成功定位。  
            if(this.getStatus() == BMAP_STATUS_SUCCESS)  
            {  
                var pt = r.point;    
                gc.getLocation(pt, function(rs){    
                    var addComp = rs.addressComponents;    
                });  
                var longitude=  r.longitude;
                var latitude=  r.latitude;
                // 开始坐标
                var map = new BMap.Map();
                var pointA = new BMap.Point(longitude,latitude); 
                var d_url="<?php echo url('Around/detail'); ?>";
                var type="<?php echo input('id'); ?>";
                $.ajax({
                    data:{'longitude':longitude,'latitude':latitude,'type':type},
                    type:"POST",
                    async:false,
                    url:"<?php echo url('distance'); ?>",
                    dataType:"json",
                    success:function(data){
                        var str='';
                        $.each(data,function(k,v){
                            var pointB = new BMap.Point(v.shop_j,v.shop_w);  // 结束点坐
                            var long=((map.getDistance(pointA,pointB))/1000).toFixed(2);

                            str+='<li>';
                                str+='<a href="'+d_url+'?id='+v.uid+'">';
                                    str+='<div class="zb_left"><img src="'+v.shop_logo+'"></div> ';
                                    str+='<div class="zb_right">';
                                        str+='<h3>'+v.shop_name+'<span><img src="__IMG__/dw.jpg">'+long+'km</span></h3>';
                                        str+='<p>'+v.province+v.city+v.district+v.addresss_detail+'</p>';
                                    str+='</div>';
                                str+='</a>';
                            str+='</li>';
                        });
                        if(str=='')
                            $('#list').html('<li>暂无数据</li>');
                        else
                            $('#list').html(str);
                    }
                })

                
                // alert(long);

            }  
        },  
        {enableHighAccuracy: true}  
    ) 
    </script>


<div style="padding-top: 13vmin;"></div>
    <!-- <div class="navigation">
        <a href="#" data-reveal-id="myModal3">综合</a>
        <a href="#">销量</a>
        <a href="#" class="chlid2" style="position:relative;" data-reveal-id="myModal2">
            <span>价格</span>
            <img  src="__IMG__/top1.png" alt="" class="ssx">
            <img  src="__IMG__/down.png" alt="" class="xsx">
        </a>
        
        <a href="#" data-reveal-id="myModal">
            <span>筛选</span>
            <img  src="__IMG__/sx.png" alt="" class="ssx" style="right: 7%">
        
        </a>
    </div>
    <div id="myModal" class="reveal-modal" >
    <form action="">
        <p class="leibie">
        <label for="">类别</label>
            <a href="#" class="optiones">全部</a>
            <a href="#" class="optiones">分销</a>
            <a href="#" class="optiones">广告</a>
        </p>
        <p class="zhouqi">
            <label for="">周期</label>
            <a href="#" class="optiones">全部</a>
            <a href="#" class="optiones">0-5天</a>
            <a href="#" class="optiones">6-10天</a>
            <a href="#" class="optiones">11-20天</a>
            <a href="#" class="optiones">21-30天</a>
            <a href="#" class="optiones">30天以上</a>
        </p>
        <p class="jiamf">
            <label for="">加盟费(元)</label>
            <a href="#" class="optiones">全部</a>
            <a href="#" class="optiones">0-100</a>
            <a href="#" class="optiones">100-1,000</a>
            <a href="#" class="optiones">1,000-10,000</a>
            
        </p>
    </form>

<div class="close-reveal-modal">
        <a href="#">确定</a>
</div>
</div>
<div id="myModal2" class="reveal-modal2" >
<form action="">
    <label for="">价格范围</label>
    <input type="text">
    <em></em>
    <input type="text">


</form>
<div class="close-reveal-modal">
        <a href="#">确定</a>
</div>
</div>
<div id="myModal3" class="reveal-modal3" >
<form action="">
    <input type="radio" name="ra">综合排序<br>
    <input type="radio" name="ra">加盟费从高到低<br>
    <input type="radio" name="ra">加盟费从低到高<br>
    <input type="radio" name="ra">时间最新<br>
</form>
<div class="close-reveal-modal">
    <a href="#">确定</a>
</div>
</div> -->


    <div class="zb_bottom fenlei">
        <ul id="list" >

        </ul>
        <div style="height:5vmin;float: left;display: block;width: 100%;"></div>

    </div>
    <script type="text/javascript">
        $('.optiones').click(function(){
            $(this).toggleClass('checkeds').siblings('.optiones').removeClass('checkeds');
        })
    </script>

  </body>
</html>