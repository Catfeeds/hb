<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:36:"../tpl/home/wap/wealth\recharge.html";i:1517475254;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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


     
    <script type="text/javascript" src="__COM__/js/ajaxfileupload.js"></script>
    <div style="padding-top: 13vmin;"></div>

    <div class="recharge-top">
      <a class="on" href="javascript:" >在线充值</a>
      <a href="javascript:" >线下转账</a>
    </div>
    
    <div class="tab-list" >
        <div class="recharge">
            <form class="postfrom" action="<?php echo url('recharge'); ?>" >
              <input name="money" type="number" placeholder="金额(元)" onfocus="this.placeholder=''" onblur="this.placeholder='金额(元)'" style="width:96%">
              <input type="hidden" name="pay_type" value="1">
              <p>
              <span>*</span>提示：目前支持支付宝、微信和网银充值
              </p>
              <div class="buttones">
                <a class="ajax-post" target-from="postfrom" href="javascript:">下一步</a>
              </div>
            </form>
        </div>

        <div class="recharge" style="display:none;">
              <div class="shezhi xgmm">
               <form class="from" action="<?php echo url('recharge'); ?>" >
                <ul>

                    <li>账户名称：<span><?php echo $company_info['company_account_name']; ?></span></li>
                    <li>开户行：<span><?php echo $company_info['company_account_bank']; ?></span></li>
                    <li>账&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：<span><?php echo $company_info['company_account_no']; ?></span></li>
                    <li style="line-height: 5vmin;color: red;" >温馨提示：低于100元的，请使用在线充值，不处理低于100元的银行转账充值</li>
                    <li>转账银行： 
                      <span>
                          <select name="bank_name" >
                            <option value="">请选择</option>
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
                            <option value="<?php echo $v['bank_name']; ?>"><?php echo $v['bank_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                          </select>
                      </span>
                    </li>
                    <li >户&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名：<span><input name="huming" type="text" placeholder="户名"></span></li>
                    <li>卡&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：<span><input name="kahao" type="text" placeholder="请输入卡号"></span></li>
                    <li>转账金额：<span><input name="money" type="text" placeholder="请输入转账金额"></span></li>
                    <li style="height:70vmin;">
                       <div class="shezhi xgmm">
                          <div style="padding:0;margin0;" class="upload">
                            <h6 style="padding:0" class="ts">上传银行转账凭证</h6>
                            <div id="preview">
                                <img id="imghead" width=100% height=auto border=0 src="__IMG__/a1.png">
                            </div>
                            <input id="img_hand" data="img" name="img_hand" type="file" onchange="uploadFile('img_hand','<?php echo url('Common/uplodeimg'); ?>')" class="tijiao" style="height: 46vmin;width: 50%;margin-left: 26%;" >
                            
                          </div> 
                        </div>  
                    </li>
                    <!-- <li>加急到账<span>1%加急手续费，2小时到账</span><i>加急</i></li> -->
                </ul>
                <input type="hidden" name="pay_type" value="2">
                <input type="hidden" name="img" value="">
                </form>
            </div>

            <div class="grzqy">
             <p style="color:#8c8c8c" >银行转账需转账到银行卡后，由财务充值到您的现金账户，3个工作日内处理，节假日顺延。</p>
           </div>
           <div style="margin-top:4vmin" class="buttones">
                <a class="ajax-post" target-from="from" href="javascript:">提 交</a>
            </div>
        </div>
    </div>
    

<script type="text/javascript">
$('.recharge-top a').click(function(){
    var index=$(this).index();
    $(this).addClass('on').siblings().removeClass('on');
    $('.tab-list .recharge').eq(index).show().siblings().hide();
})
$('.recharge-second').click(function(){
  $(this).find('.spans').show();
  $(this).siblings('.recharge-second').find('.spans').hide();
})
</script>

  </body>
</html>