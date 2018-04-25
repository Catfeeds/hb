<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:42:"../tpl/home/wap/login\companyregister.html";i:1517539769;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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
      select {
          width: 86%;
          border: 1px solid #f1f1f1;
          line-height: 10vmin;
          padding-left: 3%;
          margin-left: 5%;
          display: block;
          margin-top: 5%;
      }
  </style>
  <div style="margin-top: 20vmin"></div>

  <div class="register">
   <form name="registeruser" method="post" action="<?php echo url('Login/savereg'); ?>">
      <input class="mob" placeholder="请输入您的手机号" type="text" name="usermobile" maxlength="11">
      <input name="code" placeholder="验证码" type="text">
      <i id="yzm-code" settime="<?php echo (\think\Session::get('set_time') ?: ''); ?>" nowtime="<?php echo time(); ?>" class="sendmsg" onclick="sendMessage('<?php echo url('Login/sendCode'); ?>','mob')" >获取验证码</i>
      <input name="useraccount" type="text" placeholder="请输入您的账户名">
      <input name="userlogin" placeholder="请输入登录密码" type="password">
      <input name="reuserlogin" placeholder="请再次确认登录密码" type="password">
      <input name="parent" value="<?php echo (isset($mobile) && ($mobile !== '')?$mobile:''); ?>" placeholder="分享人手机或用户名" type="text">
      <input name="companyname" placeholder="请输入公司名称" type="text">
      <input name="companylicense" placeholder="请输入营业执照号码" type="text">
      <input name="usertype"  type="hidden"  value="1" >
      <select class="bor_no bf100" name="companyorganize">
        <option value="">请选择组织机构类型</option>
        <option value="企业">企业</option>
        <option value="事业单位">事业单位</option>
        <option value="机关">机关</option>
        <option value="社会团体">社会团体</option>
        <option value="民办非企业单位">民办非企业单位</option>
        <option value="基金会">基金会</option>
        <option value="居委会">居委会</option>
        <option value="村委会">村委会</option>
        <option value="其他组织机构">其他组织机构</option>
      </select>
      
      <span id="register" onclick="adduser()" >立即注册</span>
      <input type="checkbox" name="is_agree" style="width: 6%;display: table-cell;" value="1" >阅读并接受 <a href="<?php echo url('Login/agreement'); ?>">《用户注册协议》</a>
    </form>
  </div>
  <script type="text/javascript" src="__COM__/js/sendmessage.js" ></script>
  <script type="text/javascript">
    //用户注册
    function adduser(){
      
          //验证注册
          var thisform=document.forms['registeruser'];
          var   reg = /^[0-9a-zA-Z]{6,20}$/;
          var   pid=thisform.parent.value;//推荐人
          var   account=thisform.useraccount.value;//账号
          var   mobile=thisform.usermobile.value;
          var   login_pwd=thisform.userlogin.value;
          var   relogin_pwd=thisform.reuserlogin.value;
          var   companyname=thisform.companyname.value;
          var   companylicense=thisform.companylicense.value;
          var   companyorganize=thisform.companyorganize.value;
          var   code=thisform.code.value;
          
          if(mobile=='' || mobile==null){
            msg_alert('手机号码不能为空');
            thisform.usermobile.focus();
            return false;
          }
          if(!/1[34578]\d{9}$/.test(mobile)){
            msg_alert('手机号码格式不正确');
            thisform.usermobile.focus();
            return false;
          }

          if(code=='' || code==null){
            msg_alert('验证码不能为空');
            thisform.code.focus();
            return false;
          }

          if(account=='' || account==null){
            msg_alert('用户名不能为空');
            thisform.useraccount.focus();
            return false;
          }
          if(!/^[0-9a-zA-Z]{6,20}$/.test(account)){
              msg_alert("用户名只能为6-20位数字或字母");
              thisform.useraccount.focus();
              return false;
          } 

          if(pid=='' || pid==null){
            msg_alert('推荐人不能为空');
            thisform.parent.focus();
            return false;
          }
          if(login_pwd=='' || login_pwd==null){
            msg_alert('登录密码不能为空');
            thisform.userlogin.focus();
            return false;
          }
          if(!reg.test(login_pwd)){
              msg_alert("登录密码只能为6-20位数字或字母");
              thisform.userlogin.focus();
              return false;
          } 
          if(login_pwd!=relogin_pwd){
              msg_alert("两次输入登录密码不一致");
              return false;
          }
          if(companyname=='' || companyname==null){
            msg_alert('公司名称不能为空');
            thisform.companyname.focus();
            return false;
          }
          if(companylicense=='' || companylicense==null){
            msg_alert('营业执照号码不能为空');
            thisform.companylicense.focus();
            return false;
          }
          if(companyorganize=='' || companyorganize==null){
            msg_alert('请选择组织机构类型');
            thisform.companyorganize.focus();
            return false;
          }
          var agree=$('input[name="is_agree"]').attr('checked');
          if(!agree){
            msg_alert("请同意注册协议");
            return false;
          }

          var post_url = $("form[name='registeruser']").attr('action');
          var post_data= $("form[name='registeruser']").serialize();
          $.ajax({
               type: "POST",
               url: post_url,
               data:post_data,
               dataType: "json",
               success: function(data){
                  if(data.status==1){
                    msg_alert(data.info,1,data.url);
                  }
                  else{
                    msg_alert(data.info);
                  }      
                }     
          });
    }

  </script>


  </body>
</html>