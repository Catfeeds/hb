<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:34:"../tpl/home/wap/message\index.html";i:1517538293;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
	    body {
	        background-color: #f0f0f0;
	    }
	</style>
    <div class="xiaoxi_main">
        <ul>
            <?php  $arr=array(1=>'通知消息',2=>'交易信息',3=>'活动信息',4=>'资产信息');  if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
            <li>
                <a href="<?php echo url('Message/detail',array('id'=>$v['id'])); ?>">
                    <div class="xiaoxi_left">
                        <img src="__IMG__/xx<?php echo $v['type']; ?>.jpg">
                        <?php if(($v['status'] == 0) AND ($v['uid'] > 0)): ?>
                        <span id="xx_diana">&nbsp;</span>
                        <?php elseif(($v['uid'] ==  0) AND (in_array($v['id'],$mid_arr) == false)): ?>
                        <span id="xx_diana">&nbsp;</span>
                        <?php endif; ?>

                    </div>
                    <div class="xiaoxi_right">
                        <h3><?php echo $arr[$v['type']]; ?><span><?php echo date("Y-m-d",$v['create_time']); ?></span></h3>
                        <p><?php echo $v['title']; ?></p>
                    </div>
                </a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>

  </body>
</html>