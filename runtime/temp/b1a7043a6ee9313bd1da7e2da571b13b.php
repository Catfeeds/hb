<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:36:"../tpl/home/wap/wealth\bankcard.html";i:1519719023;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
    
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
    <div class="del">
      删除
    </div>
    <div data="<?php echo $v['id']; ?>" class="bankcards">
      <p><img src="__IMG__/bank.png" alt=""></p>
      <h1 style="font-size: 3.5vmin;" ><?php echo $v['bank_name']; if(!(empty($v['bank_branch']) || (($v['bank_branch'] instanceof \think\Collection || $v['bank_branch'] instanceof \think\Paginator ) && $v['bank_branch']->isEmpty()))): ?>（<?php echo $v['bank_branch']; ?>）<?php endif; ?></h1>
      <i>储蓄卡</i>
      <em><?php echo $v['bank_no']; ?></em>
      <span class="spans" <?php if($v['is_default'] != '1'): ?> style="display: none;"<?php endif; ?> >
        <strong>默认</strong>
      </span>
    </div>
   <?php endforeach; endif; else: echo "" ;endif; ?>

    <div class="bankcards-buttons">
      <a href="<?php echo url('Wealth/addbankcard'); ?>">添加银行卡</a>
    </div>
    <input type="hidden" id="gotype" value="<?php echo (\think\Session::get('gotype') ?: ''); ?>">

<script type="text/javascript">
    $('.del').click(function(){
      if(!confirm('确实要删除?')){
        return false;
      }
       var id=$(this).next('.bankcards').attr('data');
        $.post("<?php echo url('Wealth/deletebank'); ?>",{id:id},function(data){
            if(data.status==1)
              location.reload();
            else
              alert(data.info);
        },'json');
    });
    $('.bankcards').click(function(){
      $(this).find('.spans').show();
      $(this).siblings().find('.spans').hide();
      var id=$(this).attr('data');
      if(id){
        $.post("<?php echo url('Wealth/setdefault'); ?>",{id:id},function(data){
            // alert(data);
        },'json');
      }
    })

</script>

  </body>
</html>