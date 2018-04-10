<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:34:"../tpl/home/wap/around\search.html";i:1516947292;s:34:"../tpl/home/wap/public\bottom.html";i:1517050374;}*/ ?>

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
    <script src="http://api.map.baidu.com/api?v=2.0&ak=1byTpUa3aXZvRKON0c2Ybd5NpQCb3no0"></script>  
    <script type="text/javascript">  
        function search(){
            var keyword=$('#keyword').val();
            if(keyword=='' || keyword==null){
                return false;
            }

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

                        $.ajax({
                            data:{'longitude':longitude,'latitude':latitude,'keyword':keyword},
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
        } 
        </script>
</head>
<body>
    <!-- 轮播图 -->
    <div class="header zhoubian" style="line-height: 13vmin">
        <div class="ss_center">
            <form>
                <input id="keyword" type="text" placeholder="搜索联盟商家">
                <span onclick="search()" ><img src="__IMG__/ss2.png"></span>
            </form>
        </div>
        <div class="ss_right" >
            <a href="javascript:history.go(-1)">返回</a>
        </div>
    </div>
    


    <div style="clear: both;"></div>
    <!-- 搜索记录 -->
    
    <!-- 搜索内容 -->
    <div class="zb_bottom fenlei" style="margin-top: 13vmin;">
        <ul id="list" >
            <li>
               暂无数据
            </li>
             
        </ul>
        <div style="height:5vmin;float: left;display: block;width: 100%;"></div>
    </div>


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