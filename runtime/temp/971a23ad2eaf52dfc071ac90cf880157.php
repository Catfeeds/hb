<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:31:"../tpl/home/wap/index\more.html";i:1517727789;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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


 <div style="padding-top: 13vmin;"></div>
     <!-- 更多分类1 -->
    <div class="type more">
        <h3>用户管理</h3>
        <ul>
            <li>
                <a href="<?php echo url('Userupdate/index'); ?>">
                    <span><img src="__IMG__/fl1.png"></span>
                    <p>会员升级</p>
                </a>
            </li>
            
            <li>
                <a href="<?php echo url('Userinfo/index'); ?>">
                    <span><img src="__IMG__/fl6.png"></span>
                    <p>认证中心</p>
                </a>
            </li>
            <li>
                <a href="<?php echo url('Usercenter/manageuser'); ?>">
                    <span><img src="__IMG__/fl5.png"></span>
                    <p>分享管理</p>
                </a>
            </li>
            <li>
                <a href="<?php echo url('Usercenter/manageuser'); ?>">
                    <span><img src="__IMG__/fl7.png"></span>
                    <p>用户管理</p>
                </a>
            </li>
            <li>
                <a href="<?php echo url('Userorder/index'); ?>">
                    <span><img src="__IMG__/fl8.png"></span>
                    <p>工单</p>
                </a>
            </li>
        </ul>
    </div>

    <!-- 更多分类2 -->
    <div class="type more">
        <h3>财富管理</h3>
        <ul>
            <li>
                <a href="<?php echo url('Wealth/recharge'); ?>">
                    <span><img src="__IMG__/f21.png"></span>
                    <p>缴费充值</p>
                </a>
            </li>
            
            <li>
                <a href="<?php echo url('Wealth/getmoney'); ?>">
                    <span><img src="__IMG__/f22.png"></span>
                    <p>提现</p>
                </a>
            </li>
            <li>
                <a href="<?php echo url('Userupdate/tocompany'); ?>">
                    <span><img src="__IMG__/f23.png"></span>
                    <p>个人转企业</p>
                </a>
            </li>
            <li>
                <a href="<?php echo url('Wealth/buykucunintegral'); ?>">
                    <span><img src="__IMG__/f24.png"></span>
                    <p>购买库存</p>
                </a>
            </li>
            <!-- <li>
                <a href="<?php echo url('Wealth/updatesellnum'); ?>">
                    <span><img src="__IMG__/f25.png"></span>
                    <p>调额申请</p>
                </a>
            </li> -->
        </ul>
    </div>

     <!-- 更多分类3 -->
    <div class="type more">
        <h3>其他应用</h3>
        <ul>
            <li>
                <a href="<?php echo url('mall/Index/index'); ?>">
                    <span><img src="__IMG__/fl1.png"></span>
                    <p>商城</p>
                </a>
            </li>
            
            <li>
                <a href="<?php echo url('News/sxy'); ?>">
                    <span><img src="__IMG__/fl2.png"></span>
                    <p>商学院</p>
                </a>
            </li>
            <li>
                <a href="<?php echo url('News/newscenter',array('new_ids'=>3)); ?>">
                    <span><img src="__IMG__/fl5.png"></span>
                    <p>资讯中心</p>
                </a>
            </li>
            <li>
                <a href="<?php echo url('Turntable/index'); ?>">
                    <span><img src="__IMG__/fl3.png"></span>
                    <p>抽奖活动</p>
                </a>
            </li>
        </ul>
    </div>

  </body>
</html>