<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:41:"../tpl/home/wap/userupdate\userright.html";i:1521178735;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
    <div class="yhqy">
      <h3>消费商</h3>
      <p>具有购买商家享受商家奖励积分累积权</p>
      <p>具有会员推荐权，可邀请他人注册，并成为他人分享人</p>
    </div>

    <div class="yhqy">
      <h3>宏客</h3>
      <p>可获收益：</p>
      <p>a.销售奖励（宏宝）20%</p>
      <p>b.开发销售渠道奖励（积分）1%*5倍*消费金额（仅限直接分享用户）</p>
      <p>c.开发销售渠道奖（积分）0.5%*5倍*销售金额（仅限直接分享用户）</p>
      <p>d.市场管理服务奖（积分）（销售奖励、开发销售渠道奖、开发销售渠道奖）50%</p>

    </div>

    <div class="yhqy">
      <h3>宏投</h3>
      <p>可获收益：</p>
      <p>a.销售奖励（宏宝）20%</p>
      <p>b.开发销售渠道奖励（积分）1%*5倍*消费金额（仅限直接分享用户）</p>
      <p>c.开发销售渠道奖（积分）0.5%*5倍*销售金额（仅限直接分享用户）</p>
      <p>d.市场管理服务奖（积分）（销售奖励、开发销售渠道奖、开发销售渠道奖）50%</p>
      <p>e.分享代理商（宏宝）20%*认购代理费（仅限直接分享用户）</p>
    </div>
    

    
    <div style="padding-bottom: 10vmin"></div>

  </body>
</html>