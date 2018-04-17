<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:36:"../tpl/home/wap/wealth\getmoney.html";i:1523936499;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
  .applycash-bottom p select {
    width: 58%;
    height: 10vmin;
    background: #ededed;
    border: 0.2vmin solid #fffefe;
    border-radius: 1vmin;
    padding-left: 2%;
}

</style>

<div style="padding-top: 13vmin;"></div>

    <div class="applycash">
      <h1>
        <i class="iconfont"><img src="__IMG__/cash.png"></i>
        提现
       </h1>
       <p>
        现金余额:
        <span><?php echo $info['money']; ?></span>元
       </p>
       <p>
        宏宝余额:
        <span><?php echo $info['anzi']; ?></span>元
       </p>
    </div>
    <form class="postfrom" action="<?php echo url('getmoney'); ?>">
    <div class="applycash-bottom">
      <p>
        <label for="">提现账户:</label>
        <select name="type" id="type">
          <option value="">请选择</option>
          <option value="1">现金提现</option>
          <option value="2">宏宝提现</option>
        </select>
      </p>
      <p>
        <label for="">提现数量:</label>
        <input type="number" id="num" name="money" placeholder="请输入提现数量">
      </p>

      <p>
        <label for="">实际到账:</label>
        <span id="total">￥0</span>
      </p>

      <p>
        <label for="">默认银行卡:</label>
        <?php if(!(empty($bank_no) || (($bank_no instanceof \think\Collection || $bank_no instanceof \think\Paginator ) && $bank_no->isEmpty()))): ?>
        <span><?php echo $bank_no; ?>尾号</span>
        <a href="<?php echo url('Wealth/bankcard'); ?>">修改</a>
        <?php else: ?>
        <span style="width:auto" >暂无收款账户</span>
        <a href="<?php echo url('Wealth/bankcard'); ?>">添加</a>
        <?php endif; ?>
      </p>
      <p>
        <label for="">绑定手机号:</label>
        <span><?php echo (\think\Session::get('user_login.mobile') ?: ''); ?></span>
         <a style="margin-left: 5%; width: 27vmin; background: #949390;" settime="<?php echo (\think\Session::get('set_time') ?: ''); ?>" nowtime="<?php echo time(); ?>" class="sendmsg" onclick="sendMessage('<?php echo url('Common/sendCode'); ?>')" href="javascript:">获取验证码</a>

      </p>
      <p>
      <label for="">验证码:</label>
      <input type="number" name="code" placeholder="请输入短信">
    </p>
    <p>
      <label for="">交易密码:</label>
      <input type="password" name="pwd" placeholder="请输入交易密码">
    </p>
    

    
    <p style="height: auto;line-height: 10vmin;font-size: 3.5vmin;text-indent: 0;padding: 0 4vmin;width: 95%;" >提现税费10%+手续费3%+反购物券7%,。<?php if(!(empty($config['money_max']) || (($config['money_max'] instanceof \think\Collection || $config['money_max'] instanceof \think\Paginator ) && $config['money_max']->isEmpty()))): ?>单笔最大提现额度:￥<?php echo $config['money_max']; endif; if(!(empty($config['money_beishu']) || (($config['money_beishu'] instanceof \think\Collection || $config['money_beishu'] instanceof \think\Paginator ) && $config['money_beishu']->isEmpty()))): ?> ,提现金额须为<?php echo $config['money_beishu']; ?>的倍数 <?php endif; ?></p>
    </div>
    </form>
    <div class="buttones ajax-post"  target-from="postfrom"> 提 交 </div>

    <script type="text/javascript" src="__COM__/js/sendmessage.js" ></script>
    <script type="text/javascript">
        //根据现有余额计算最大可提取额度
        $("#type").change(function(){

            var opt=$("#type").val();
            var amount = 0;
            var maxamount = 0;

            if(opt == "1"){ //现金余额
                amount = parseInt(<?php echo $info['money']; ?>); 
                maxamount = parseInt(amount/100)*100;
            }else if(opt == "2"){ //宏宝余额
                amount = parseInt(<?php echo $info['anzi']; ?>)
                maxamount = parseInt(amount/10000)*10000;
            }
            
            $('#num').val(maxamount);
            
        });

        //计算扣除总数
        $('#num').blur(function(){
            var val=$(this).val();
            ExcTotal(val);
        })


        function ExcTotal(val){
            val=parseInt(val);
            var type=$('#type').val();

            if(val){
              var fee=0;
              if(type=='2'){
                fee=20;
                var total=(val-val*fee/100);
                $('#total').text('￥'+(total)/100);
              }
              else{
                fee=20;
                var total=(val-val*fee/100);
                $('#total').text('￥'+total);
              }
            }else{
              $('#total').text('￥0');
            }

        }

        $('#type').change(function(){
            // if($(this).val()=='2'){
            //   $('.syb').show();
            // }else{
            //   $('.syb').hide();
            // }
            var val=$('#num').val();
            ExcTotal(val);
        })
    </script>

  </body>
</html>