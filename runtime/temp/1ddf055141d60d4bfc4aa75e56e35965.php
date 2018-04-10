<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:34:"../tpl/home/wap/wealth\detail.html";i:1517212530;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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

    <div class="myorder">
         <ul>
           <li <?php if(input('f_type') == '0'): ?> class="licolor" <?php endif; ?>><a href="<?php echo url('Wealth/detail',array('type'=>input('type'),'f_type'=>'0')); ?>">全部</a></li>
           <li <?php if(input('f_type') == '1'): ?> class="licolor" <?php endif; ?>><a href="<?php echo url('Wealth/detail',array('type'=>input('type'),'f_type'=>'1')); ?>">转入</a></li>
           <li <?php if(input('f_type') == '2'): ?> class="licolor" <?php endif; ?>><a href="<?php echo url('Wealth/detail',array('type'=>input('type'),'f_type'=>'2')); ?>">转出</a></li>
         </ul>
    </div>  


    <div class="czjl cfjl">
      <ul>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
        <li>
          <a href="<?php echo url('Wealth/onedetail',array('id'=>$v['id'],'type'=>input('type'))); ?>">
            <h3><i><?php echo $v['from_type']==1?'转入':'转出'; ?>-<?php echo $v['type_name']; ?></i><span><?php echo $v['money']; ?></span></h3>
            <p><?php echo date("Y-m-d H:i",$v['create_time']); ?> <?php echo $status_name[$v['status']]; ?></p>
          </a>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
      <img src="__IMG__/kong.jpg">
      <p class="wu">没有充值记录</p>
      <?php endif; ?>
    </div>

    <div style="padding-bottom: 10vmin"></div>

  </body>
</html>