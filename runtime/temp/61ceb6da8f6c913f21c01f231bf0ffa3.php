<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:40:"../tpl/home/wap/usercenter\children.html";i:1519694721;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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


 

    <div class="centent_640 pt45">
    <div class="pl15 bg_white solid_last_a mb20">
            <?php  $user=db('user');  if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$v): ?>
            <div class="solid_b">
                <a data-toggle="collapse" data-expanded="<?php echo $k; ?>" href="javascript:" class="db solid_b pr15 pt10" >
                    <p class="mg0 pb10 c-222"><?php echo $v['account']; ?>
                        <span class="fr text_blue"><?php echo date('Y-m-d H:i:s',$v['reg_date']); ?><img class="fr mt3" width="14" src="__IMG__/right2.png" style="width: 8%"></span>
                    </p>
                </a>
            </div>
            
            <div class="panel-collapse panel-default collapse in" expanded="<?php echo $k; ?>">
                <div class="panel-body">
                    <div class="db solid_b">
                        <a class="db solid_b pr15" href="javascript:">
                            <p class="mg0 pb10 c-222">分享人数：
                                <span class="fr text_blue"><?php  echo $user->where('pid',$v['userid'])->count(1); ?>人</span>
                            </p>
                        </a>
                      
                        <a class="db solid_b pr15 pt10" href="javascript:">
                            <p class="mg0 pb10 c-222">手机：
                                <span class="fr text_blue"><?php echo $v['mobile']; ?></span>
                            </p>
                        </a>
                        <a class="db solid_b pr15 pt10" href="javascript:">
                            <p class="mg0 pb10 c-222">姓名：
                                <span class="fr text_blue"><?php echo $v['username']; ?></span>
                            </p>
                        </a>
                        
                    </div>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<script type="text/javascript">
    $('[data-toggle="collapse"]').click(function(){
        var i=$(this).attr('data-expanded');
        $('[expanded="'+i+'"]').slideToggle();
    });
</script>




  </body>
</html>