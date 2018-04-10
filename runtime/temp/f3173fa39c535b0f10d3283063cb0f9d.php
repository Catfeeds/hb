<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:37:"../tpl/home/wap/userupdate\index.html";i:1521110009;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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

    <div class="shezhi qyrz sjhy">
        <ul>
            <li>用户等级<span class="xfs"><?php echo user_level(); ?></span></li>
            <li><a href="<?php echo url('userright'); ?>">用户权益<span><img src="__IMG__/right2.png"></span></a></li>
            <?php if($level == '0'): ?>
            <li style="line-height: 6vmin;" >
                <i>a.具有购买商家享受商家奖励积分累积权</i>
                <br>
                <i>b.具有会员推荐权，可邀请他人注册，并成为他人分享人</i>
            </li>
            <?php endif; if($level == '1'): ?>
            <li style="line-height: 6vmin;" >
                <i>a.销售奖励（宏宝）20%</i>
                <br>
                <i>b.开发销售渠道奖励（积分）1%*5倍*消费金额（仅限直接分享用户）</i>
                <br>
                <i>c.开发销售渠道奖（积分）0.5%*5倍*销售金额（仅限直接分享用户）</i>
                <br>
                <i>d.市场管理服务奖（积分）（销售奖励、开发销售渠道奖、开发销售渠道奖）50%</i>
            </li>
            <?php endif; if($level == '2'): ?>
            <li style="line-height: 6vmin;" >
                <i>a.销售奖励（宏宝）20%</i>
                <br>
                <i>b.开发销售渠道奖励（积分）1%*5倍*消费金额（仅限直接分享用户）</i>
                <br>
                <i>c.开发销售渠道奖（积分）0.5%*5倍*销售金额（仅限直接分享用户）</i>
                <br>
                <i>d.市场管理服务奖（积分）（销售奖励、开发销售渠道奖、开发销售渠道奖）50%</i>
                <br>
                <i>e.分享代理商（宏宝）20%*认购代理费（仅限直接分享用户）</i>
            </li>
            <?php endif; ?>
        </ul>

        <p><i>如果您当前权益较少，可以去升级，享受更多特权。</i></p>
    </div>

    <span id="anniu"><a href="<?php echo url('userupdate'); ?>">去升级</a></span>
    <div style="padding-bottom: 10vmin"></div>

  </body>
</html>