<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:32:"../tpl/home/wap/index\index.html";i:1521114944;s:34:"../tpl/home/wap/public\bottom.html";i:1517050374;}*/ ?>

<!-- 不使用布局文件 -->
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui">
    <meta name="description" content="<?php echo $site_info['WEB_SITE_DESCRIPTION']; ?>">
    <meta name="Keywords" content="<?php echo $site_info['WEB_SITE_KEYWORD']; ?>">
	<title><?php echo $site_info['WEB_SITE_TITLE']; ?></title>
	<link rel="stylesheet" href="__CSS__/style.css">
	<script type="text/javascript" src="__JS__/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="__JS__/jquery.touchSlider.js"></script>
    <script type="text/javascript" src="__JS__/js.js"></script>

    <!-- 点击弹出右侧 -->
    <link rel="stylesheet" type="text/css" href="__CSS__/component.css" />
    <script src="__JS__/modernizr.custom.js"></script>
    <script src="__JS__/jquery.dlmenu.js"></script>
</head>
<body>
	<!-- 轮播图 -->
    <div class="header">
        <div class="header_left">
            <!-- 弹出右侧 -->
            <div id="dl-menu" class="dl-menuwrapper">
                <button><!-- <img src="__IMG__/my.png"> --></button>

                <ul class="dl-menu">
                    <div class="menu_top">
                        <p class="xiaoxi">
                            <a href="<?php echo url('Message/index'); ?>">
                                <img src="__IMG__/xiaoxi.jpg">
                                <?php if($message_count > 0): ?>
                                <span id="xx_dian">&nbsp;</span>
                                <?php endif; ?>
                            </a>
                        </p>
                        <p>
                            <a href="<?php echo url('Usercenter/userdata'); ?>"><img src="__IMG__/shezhi.jpg"></a>
                        </p>
                    </div>
                    <div class="menu_center">
                        <p id="touxiang" style="margin-left: 37%;">
                        <?php if(!(empty($head_img) || (($head_img instanceof \think\Collection || $head_img instanceof \think\Paginator ) && $head_img->isEmpty()))): ?>
                            <img src="<?php echo $head_img; ?>">
                        <?php else: ?>
                            <img src="__IMG__/sg3.jpg">
                        <?php endif; ?>
                        </p>
                       <!--  <p id="ewm" ><a href="<?php echo url('Login/usercode',array('uid'=>\think\Session::get('user_login.userid'))); ?>"><img src="__IMG__/ewm2.jpg"></a></p> --><!-- onclick ="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'" -->
                    </div>

                    <div class="namy" style="text-align: left;padding-left: 39%;"><?php echo \think\Session::get('user_login.account'); ?></div>

                    <div class="renzheng">
                        <div class="renzheng0 renzheng1<?php if($level >= 6): ?>-1<?php endif; ?>"></div>
                        <div class="renzheng0 renzheng2<?php if($level >= 5): ?>-1<?php endif; ?>"></div>
                        <div class="renzheng0 renzheng3<?php if($level >= 4): ?>-1<?php endif; ?>"></div>
                        <div class="renzheng0 renzheng4<?php if($level >= 3): ?>-1<?php endif; ?>"></div>
                        <div class="renzheng0 renzheng5<?php if($level >= 2): ?>-1<?php endif; ?>"></div>
                        <div class="renzheng0 renzheng6<?php if($level >= 1): ?>-1<?php endif; ?>"></div>
                        <div class="renzheng0 renzheng7<?php if($level >= 0): ?>-1<?php endif; ?>"></div>
                    </div>
                   
                    <div style="clear: both;"></div>
                    <div class="menu_bottom">
                        <li>
                            <a href="<?php echo url('Usercenter/manageuser'); ?>">
                                <img src="__IMG__/a1.jpg">用户管理
                            </a>  
                        </li>
                        <li class="xhx">
                            <a href="<?php echo url('Userinfo/index'); ?>">
                                <img src="__IMG__/a2.jpg">用户认证
                            </a>  
                        </li>

                        <!-- <li>
                            <a href="<?php echo url('Usercenter/collection'); ?>">
                                <img src="__IMG__/a3.jpg">我的收藏
                            </a>  
                        </li> -->
                        <li>
                            <a href="<?php echo url('Login/usercode',array('uid'=>\think\Session::get('user_login.userid'))); ?>">
                                <img src="__IMG__/a4.jpg">我的分享
                            </a>  
                        </li>
                        <li>
                            <a href="<?php echo url('Wealth/recharge'); ?>">
                                <img src="__IMG__/a5.jpg">充值
                            </a>  
                        </li>
                        <li class="xhx">
                            <a href="<?php echo url('Seller/alliancebusiness'); ?>">
                                <img src="__IMG__/a6.jpg">联盟商家
                            </a>  
                        </li>
                        <li>
                            <a href="<?php echo url('Usercenter/feedback'); ?>">
                                <img src="__IMG__/a7.jpg">用户反馈
                            </a>  
                        </li>
                        <li>
                            <a href="<?php echo url('Usercenter/aboutus'); ?>">
                                <img src="__IMG__/a8.jpg">关于我们
                            </a>  
                        </li>
                        <li>
                            <a href="<?php echo url('Usercenter/helpcenter',array('new_ids'=>8)); ?>">
                                <img src="__IMG__/a9.jpg">帮助中心
                            </a>  
                        </li>

                        <span id="tuichu"><a href="<?php echo url('home/Login/logout'); ?>">退出登录<img src="__IMG__/a10.jpg"></a></span>
                    </div>
                    
                </ul>
               
            </div>
            <style>
                .backsize{position: fixed;width: 100%;height: 100%;background-color: rgba(0, 0, 0, 0.50);z-index: 1;display: none;}
            </style>
            <script>
                $(function() {
                    // $('#dl-menu').dlmenu();
                    $('#dl-menu button').click(function(){
                        $('#back').toggle();
                        $('#dl-menu button').toggleClass('dl-active');
                        $('#dl-menu ul').toggleClass('dl-menuopen');
                    })
                    $('#back').click(function(){
                        $(this).hide();
                        $('#dl-menu button').removeClass('dl-active');
                        $('#dl-menu ul').removeClass('dl-menuopen');
                    })
                });

            </script>



        </div>
        <div class="header_center">首页</div>
        <div style="text-align: right;" class="header_right">
            <a href="<?php echo url('Login/usercode',array('uid'=>\think\Session::get('user_login.userid'))); ?>"><img src="__IMG__/ewm.png"></a>
            <!-- <a href="javascript:"><img src="__IMG__/sys.png"></a> -->
        </div>
    </div>
     <div id="back" class="backsize"></div>
   	<div class="main-content ng-scope" id="main_content">
        <div class="main_visual">
            <?php  $banner=get_banner('total');  ?>
            <div class="flicking_con">
                <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): if( count($banner)==0 ) : echo "" ;else: foreach($banner as $key=>$v): ?>
                <a href="#"></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="main_image">
                <ul>
                    <?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): if( count($banner)==0 ) : echo "" ;else: foreach($banner as $key=>$v): ?>
                    <li><span class="img_3"><img src="<?php echo $v['b_img']; ?>"></span></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

                <a href="javascript:;" id="btn_prev"></a>
                <a href="javascript:;" id="btn_next"></a>
            </div>   
        </div>
    </div>
    <!-- 轮播图 -->


    <!-- 下分类 -->
    <div class="type">
    	<ul>
    		<li>
    			<a href="<?php echo url('mall/Index/index'); ?>">
	    			<span><img src="__IMG__/fl1.png"></span>
	    			<p>商城</p>
    			</a>
    		</li>
    		<li>
    			<a href="<?php echo url('news/sxy'); ?>">
	    			<span><img src="__IMG__/fl2.png"></span>
	    			<p>商学院</p>
    			</a>
    		</li>
    		<li>
    			<a href="<?php echo url('Turntable/index'); ?>">
	    			<span><img src="__IMG__/fl3.png"></span>
	    			<p>活动抽奖</p>
    			</a>
    		</li>
    		<li>
    			<a href="<?php echo url('Usersign/index'); ?>">
	    			<span><img src="__IMG__/fl4.png"></span>
	    			<p>签到</p>
    			</a>
    		</li>
    		<li>
    			<a href="<?php echo url('Usercenter/manageuser'); ?>">
	    			<span><img src="__IMG__/fl5.png"></span>
	    			<p>分享管理</p>
    			</a>
    		</li>
    		<li>
                <a href="<?php echo url('Userupdate/tocompany'); ?>">
                    <span><img src="__IMG__/f23.png"></span>
                    <p>个人转企业</p>
                </a>
            </li>
    		<li>
    			<a href="<?php echo url('Userinfo/index'); ?>">
	    			<span><img src="__IMG__/fl7.png"></span>
	    			<p>认证中心</p>
    			</a>
    		</li>
    		<li>
    			<a href="<?php echo url('Userorder/index'); ?>">
	    			<span><img src="__IMG__/fl8.png"></span>
	    			<p>工单</p>
    			</a>
    		</li>
    		<li>
                <a href="<?php echo url('Userupdate/index'); ?>">
                    <span><img src="__IMG__/fl1.png"></span>
                    <p>会员升级</p>
                </a>
            </li>
    		<li>
    			<a href="<?php echo url('index/more'); ?>">
	    			<span><img src="__IMG__/f20.png"></span>
	    			<p>更多</p>
    			</a>
    		</li>
    	</ul>
    </div>
    <!-- 下分类完 -->

    <!-- 数据统计 标题 -->
   <!--  <div class="notice">
        <div class="notice_left"><img src="__IMG__/sjtj.png" style="width: 93%"></div>
        <div class="notice_right">
            <p style="color: #ff9000;">数据统计</p>
        </div>
    </div>
    <div class="sjtj_b">
        <ul>
            <li>
                <h6>上一天新增积分总额</h6>
                <p class="lanse">0</p>
            </li>
            <li>
                <h6>总积分总额</h6>
                <p class="lvse">0</p>
            </li>
        </ul>
    </div> -->


    <!-- 猜你喜欢 标题 -->
    <div class="notice">
    	<div class="notice_left"><img src="__IMG__/gg.png"></div>
    	<div class="notice_right">
    		<p>猜你喜欢<a href="<?php echo url('mall/Index/index'); ?>" style="display: initial;"><i>更多</i></a></p>
    	</div>
    </div>



    <!-- 猜你喜欢 -->
    <div class="youxuan mlrs" style="border-top: 1px solid #f0f2f3">
            <?php if($goodcount > 0): ?>
    		<div class="yx_l">
    			<a href="<?php echo url('mall/good/details',array('good_id'=>$goodlist[0]['good_id'])); ?>">
	    			<div class="yx_l_t">
	    				<p><?php echo $goodlist[0]['good_name']; ?></p>
		    			<p class="mlrsa">￥<?php echo $goodlist[0]['good_price']+0; ?></p>
		    			<p class="tupian"><img src="<?php echo $goodlist[0]['good_cover_img']; ?>"></p>
	    			</div>
    			</a>
    		</div>
            <?php endif; if($goodcount > 1): ?>
    		<div class="yx_l yx_r">
    			<a href="<?php echo url('mall/good/details',array('good_id'=>$goodlist[1]['good_id'])); ?>">
	    			<div class="yx_l_t">
	    				<p><?php echo $goodlist[1]['good_name']; ?></p>
		    			<p class="mlrsa">￥<?php echo $goodlist[1]['good_price']+0; ?></p>
		    			<p class="tupian"><img src="<?php echo $goodlist[1]['good_cover_img']; ?>"></p>
	    			</div>
    			</a>
    		</div>
            <?php endif; ?>
    		<ul id="mlsr_b">
                <?php if($goodcount > 2): if(is_array($goodlist) || $goodlist instanceof \think\Collection || $goodlist instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($goodlist) ? array_slice($goodlist,2,8, true) : $goodlist->slice(2,8, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
    			<li>
    				<a href="<?php echo url('mall/good/details',array('good_id'=>$data['good_id'])); ?>">
	    				<p><?php echo $data['good_name']; ?></p>
	    				<p class="mlsr_b">￥<?php echo $data['good_price']+0; ?></p>
	    				<p><img src="<?php echo $data['good_cover_img']; ?>"></p>
    				</a>
    			</li>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
    		</ul>
    </div>
    <!-- 猜你喜欢 -->


<style type="text/css">
.zxzx_top ul li {
    margin-right: 1%;
}
</style>

    <!-- 资讯中心 标题 -->
    <div class="notice">
        <div class="notice_left"><img src="__IMG__/gg2.png"></div>
        <div class="notice_right zxzx">
            <p>资讯中心<a href="<?php echo url('News/newscenter',array('new_ids'=>$menu_son[0]['id'])); ?>" style="display: initial;"><i>更多</i></a></p>
        </div>
    </div>

    <div class="zxzx_top">
        <ul>
            <?php if(is_array($menu_son) || $menu_son instanceof \think\Collection || $menu_son instanceof \think\Paginator): if( count($menu_son)==0 ) : echo "" ;else: foreach($menu_son as $k=>$v): ?>
            <li>
                <a href="<?php echo url('News/newscenter',array('new_ids'=>$v['id'])); ?>">
                    <img src="__IMG__/zx<?php echo $k+1; ?>.jpg">
                    <p><?php echo $v['title']; ?></p>
                </a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <li>
                <a href="<?php echo url('usercenter/helpcenter',array('new_ids'=>$help_son[0]['id'])); ?>">
                    <img src="__IMG__/zx6.jpg">
                    <p>帮助中心</p>
                </a>
            </li>
        </ul>
    </div>
    

    <div class="zxzx_bottom">
        <ul>
            <?php if(is_array($newtop) || $newtop instanceof \think\Collection || $newtop instanceof \think\Paginator): if( count($newtop)==0 ) : echo "" ;else: foreach($newtop as $key=>$v): ?>
            <li <?php if($v['newtop']==2){echo 'class=""';}else{echo 'class="new"';}?>>
                <a href="<?php echo url('news/newsdetail',array('news_id'=>$v['id'])); ?>">
                   <?php echo $v['title']; ?>
                </a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>   

        </ul>
    </div>
    <div class="banquan">公司版权所有</div>

<div style="height:20vmin;float: left;display: block;width: 100%;"></div>

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





<!-- 二维码弹出框 -->
    <div id="light" class="white_content">
        <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" id="guanbi">X</a>
        <img src="<?php echo $code_path; ?>">
    </div> 
    <div id="fade" class="black_overlay"></div> 
<!-- 二维码弹出框完 -->

</body>
</html>