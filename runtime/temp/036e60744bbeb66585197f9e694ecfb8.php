<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:31:"../tpl/home/wap/around\map.html";i:1516869340;s:34:"../tpl/home/wap/public\bottom.html";i:1517050374;}*/ ?>

<!-- 不使用布局文件 -->
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <title><?php echo $site_info['WEB_SITE_TITLE']; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui">
    <meta name="description" content="<?php echo $site_info['WEB_SITE_DESCRIPTION']; ?>">
    <meta name="Keywords" content="<?php echo $site_info['WEB_SITE_KEYWORD']; ?>">
    <link rel="stylesheet" href="__CSS__/style.css">
    <script type="text/javascript" src="__JS__/jquery-1.7.1.min.js"></script>
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
                    document.getElementById('address').innerText=addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber;
                    document.getElementById('city').innerText=addComp.city    
                });  
                initMap(pt);
            }  
        },  
        {enableHighAccuracy: true}  
    )  

    function initMap(point){ 
        //初始化地图   
        map = new BMap.Map("map");   
        map.addControl(new BMap.NavigationControl());   
        map.addControl(new BMap.ScaleControl());   
        map.addControl(new BMap.OverviewMapControl());   
        map.centerAndZoom(point, 15);   
        map.addOverlay(new BMap.Marker(point));
        map.enableScrollWheelZoom(true);  
    }
    </script>
</head>
<body>
    <!-- 轮播图 -->
    <div class="header zhoubian">
        <div class="header_left" id="city" >切换城市v</div>
        <div class="header_center">
            <ul>
                <li style="border-top-left-radius: 2vmin;border-bottom-left-radius: 2vmin;border-right: none;">
                    <a href="<?php echo url('Around/index'); ?>">列表</a>
                </li>
                <li id="zb" style="border-top-right-radius: 2vmin;border-bottom-right-radius: 2vmin;">
                    <a href="<?php echo url('Around/map'); ?>">地图</a>
                </li>
            </ul>
        </div>
        <div class="header_right">
            <a href="<?php echo url('Around/search'); ?>"><img src="__IMG__/ss.png"></a>
        </div>
    </div>
    
    <div style="padding-top: 12vmin;"></div>


    <!-- 下分类 -->
    <div class="ditu_wz">
        <p>您当前的位置：<i id="address" ></i><!-- <span>联盟商家<i>20</i></span> --></p>
        <div id="map" style="height:110vmin" class="ditu_b">
            <!-- <img src="__IMG__/dt.jpg"> -->
        </div>
    </div>
    <!-- 下分类完 -->


<!-- 底部 -->
<!-- 底部菜单 -->
<?php 
  $select_url=controller_name().'-'.action_name();
  $select_btn1='';
  $select_btn2='';
  $select_btn3='';
  $select_btn4='';
  $select_img1='';
  $select_img2='';
  $select_img3='';
  $select_img4='';
  if($select_url=='Index-index'){
     $select_btn1='class="onb"';
     $select_img1='-1';
  }
  if($select_url=='Around-index'){
     $select_btn2='class="onb"';
     $select_img2='-1';
  }
  if($select_url=='Wealth-index'){
     $select_btn3='class="onb"';
     $select_img3='-1';
  }
  if($select_url=='Service-index'){
     $select_btn4='class="onb"';
     $select_img4='-1';
  }
 ?>

<div class="footer">
    <a href="<?php echo url('home/Index/index'); ?>" <?php echo $select_btn1; ?> >
        <img src="__IMG__/footer1<?php echo $select_img1; ?>.png">
        <p>首页</p>
    </a>
     <a href="<?php echo url('home/Around/index'); ?>" <?php echo $select_btn2; ?>>
        <img src="__IMG__/footer2<?php echo $select_img2; ?>.png">
        <p>周边</p>
    </a>
     <a href="<?php echo url('home/Wealth/index'); ?>" <?php echo $select_btn3; ?>>
        <img src="__IMG__/footer3<?php echo $select_img3; ?>.png">
        <p>财富</p>
    </a>
     <a href="<?php echo url('home/Service/index'); ?>" <?php echo $select_btn4; ?> >
        <img src="__IMG__/footer4<?php echo $select_img4; ?>.png">
        <p>客服</p>
    </a>
</div>


</body>
</html>