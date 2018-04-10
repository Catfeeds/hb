<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:42:"../tpl/home/wap/userinfo\checkcompany.html";i:1517540806;s:27:"../tpl/home/wap/layout.html";i:1514211998;s:34:"../tpl/home/wap/public\header.html";i:1516333197;s:34:"../tpl/home/wap/public\footer.html";i:1514211999;}*/ ?>
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


     <!-- 地区 -->
    <link rel="stylesheet" type="text/css" href="__CSS__/jquery-weui.min.css" />
    <div style="padding-top: 13vmin;"></div>
    <div class="shezhi qyrz1">
        <form class="postfrom" action="<?php echo url('savecheckcompany'); ?>">
        <ul>
            <!-- <li>&nbsp;&nbsp;&nbsp;&nbsp;店铺名称<span><input type="text" placeholder="请填写店铺名称" name="shop_name" value="<?php echo (isset($info['shop_name']) && ($info['shop_name'] !== '')?$info['shop_name']:''); ?>" /></span></li> -->
            <li>&nbsp;&nbsp;&nbsp;&nbsp;公司名称<span><input type="text" placeholder="请填写公司名称" name="companyname" value="<?php echo (isset($info['company_name']) && ($info['company_name'] !== '')?$info['company_name']:''); ?>" /></span></li>
            
            <li class="isthree">是否分公司
                <span style="float: inherit;">
                <a href="javascript:"><i <?php if($info['is_child_company'] == '0'): ?>class="on"<?php endif; ?> data="0">否</i></a>
                <a href="javascript:" class="fou"><i <?php if($info['is_child_company'] == '1'): ?>class="on"<?php endif; ?> data="1" >是</i></a>
                </span>
                <input type="hidden" name="ischild" value="<?php echo (isset($info['is_child_company']) && ($info['is_child_company'] !== '')?$info['is_child_company']:'0'); ?>">
            </li>

            <li class="isthree" >&nbsp;&nbsp;&nbsp;&nbsp;三证合一<span style="float: inherit;">
              <a href="javascript:"><i <?php if($info['is_three_card'] == '0'): ?>class="on"<?php endif; ?> data="0">否</i></a>
              <a href="javascript:" class="fou"><i <?php if($info['is_three_card'] == '1'): ?>class="on"<?php endif; ?> data="1" >是</i></a>
              </span>
              <input type="hidden" name="isthree" value="<?php echo (isset($info['is_three_card']) && ($info['is_three_card'] !== '')?$info['is_three_card']:'0'); ?>">
            </li>

            <li>社会信用代码<span><input name="credit" type="text" value="<?php echo (isset($info['credit_no']) && ($info['credit_no'] !== '')?$info['credit_no']:''); ?>" placeholder="请填写信用代码"></span></li>
            <li class="tax-c" >税务登记证<span><input name="tax" type="text" value="<?php echo (isset($info['tax_no']) && ($info['tax_no'] !== '')?$info['tax_no']:''); ?>" placeholder="请填写税务登记表"></span></li>
            <li class="tax-c" >组织机构证<span><input name="organize" type="text" value="<?php echo (isset($info['organize_no']) && ($info['organize_no'] !== '')?$info['organize_no']:''); ?>" placeholder="请填写组织机构代码"></span></li>
            <li>组织机构类型<span><?php echo $info['company_organize']; ?></span></li>
            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;法人<span><input type="text" name="legal" placeholder="请填写法人"  value="<?php echo (isset($info['legal_name']) && ($info['legal_name'] !== '')?$info['legal_name']:''); ?>" /></span></li>
            <li>公司类型
                <span>
                    <select name="companytype" >
                      <option value ="">请选择企业类型</option>
                      <option <?php if($info['company_type'] == '国有企业'): ?>selected="true"<?php endif; ?> value ="国有企业">国有企业</option>
                      <option <?php if($info['company_type'] == '集体企业'): ?>selected="true"<?php endif; ?> value ="集体企业">集体企业</option>
                      <option <?php if($info['company_type'] == '股份合作企业'): ?>selected="true"<?php endif; ?> value ="股份合作企业">股份合作企业</option>
                      <option <?php if($info['company_type'] == '联营企业'): ?>selected="true"<?php endif; ?> value ="联营企业">联营企业</option>
                      <option <?php if($info['company_type'] == '有限责任公司'): ?>selected="true"<?php endif; ?> value ="有限责任公司">有限责任公司</option>
                      <option <?php if($info['company_type'] == '股份有限公司'): ?>selected="true"<?php endif; ?> value ="股份有限公司">股份有限公司</option>
                      <option <?php if($info['company_type'] == '私营企业'): ?>selected="true"<?php endif; ?> value ="私营企业">私营企业</option>
                      <option <?php if($info['company_type'] == '个体户'): ?>selected="true"<?php endif; ?> value ="个体户">个体户</option>
                      <option <?php if($info['company_type'] == '中外合资经营企业'): ?>selected="true"<?php endif; ?> value ="中外合资经营企业">中外合资经营企业</option>
                      <option <?php if($info['company_type'] == '中外合作经营企业'): ?>selected="true"<?php endif; ?> value ="中外合作经营企业">中外合作经营企业</option>
                      <option <?php if($info['company_type'] == '外资企业'): ?>selected="true"<?php endif; ?> value ="外资企业">外资企业</option>
                      <option <?php if($info['company_type'] == '外商投资股份有限公司'): ?>selected="true"<?php endif; ?> value ="外商投资股份有限公司">外商投资股份有限公司</option>
                      <option <?php if($info['company_type'] == '其他企业'): ?>selected="true"<?php endif; ?> value ="其他企业">其他企业</option>
                    </select>
                </span>
            </li>
           <!--  <li>行业分类
                <span>
                    <select>
                      <option value ="请选择">请选择企业类型</option>
                      <option value ="石油和天然气开采产品">石油和天然气开采产品</option>
                      <option value ="石油和天然气开采产品">石油和天然气开采产品</option>
                      <option value ="石油和天然气开采产品">石油和天然气开采产品</option>
                      <option value ="石油和天然气开采产品">石油和天然气开采产品</option>
                    </select>
                </span> 
            </li> -->
            <li>所在区域
                <span>
                  <input name="area" value="<?php echo (isset($info['area']) && ($info['area'] !== '')?$info['area']:''); ?>" type='text' id='city-picker' placeholder='请选择省市区县' />
                </span>    
            </li>
            <li class="isthree1" >经营者<span style="float: inherit;">
              <a href="javascript:"><i data="1" <?php if($info['is_legal'] == '1'): ?>class="on"<?php endif; ?> >被授权人</i></a>
              <a href="javascript:" class="fou" ><i data="0" <?php if($info['is_legal'] == '0'): ?>class="on"<?php endif; ?> >法人</i></a></span>
              <input type="hidden" name="islegal" value="0">
            </li>
            <li class="manage" <?php if($info['is_legal'] == '0'): ?>style="display:none"<?php endif; ?> >
              经营负责人
              <span>
                <input name="manageparent" value="<?php echo (isset($info['manage_parent']) && ($info['manage_parent'] !== '')?$info['manage_parent']:''); ?>" type="text" placeholder="请填写经营负责人">
              </span>
            </li>
        </ul>
        </form>
        <p>您正在申请企业认证</p>
    </div>
    
    <?php if(($info['is_check_company'] != 1) AND ($info['is_check_company'] != 2)): ?>
    <span id="anniu"><a class="post"  target-from="postfrom" href="javascript:">下一步</a></span>
    <?php endif; ?>
    <div style="padding-bottom: 10vmin"></div>

    <script type="text/javascript" src="__JS__/jquery-weui.min.js"></script>
    <script type="text/javascript" src="__JS__/city-picker.min.js"></script>
    <script>

        //提交数据
        $('.post').click(function(){
          var datafrom=$(this).attr('target-from');
          var post_url = $("."+datafrom).attr('action');
          var post_data= $("."+datafrom).serialize();
          if(post_url){
              $.ajax({
                 type: "POST",
                 url: post_url,
                 data:post_data,
                 dataType: "json",
                 success: function(data){
                    if(data.status==1){
                          window.location.href=data.url;
                    }else{
                        msg_alert(data.info);
                    }      
                  }    
            });
          }
        });


        $('.isthree a').click(function(){
          var that=$(this);
          that.find('i').addClass('on');
          that.siblings('a').find('i').removeClass('on');
          var data=that.find('i').attr('data');
          that.parents('.isthree').find('input').val(data);
          if(data==1)
            $('.tax-c').hide();
          else
            $('.tax-c').show();
        })

        $('.isthree1 a').click(function(){
          var that=$(this);
          that.find('i').addClass('on');
          that.siblings('a').find('i').removeClass('on');
          var data=that.find('i').attr('data');
          if(data==1){
            $('.manage').show();
          }else{
            $('.manage').hide();
          }
          that.parents('.isthree1').find('input').val(data);
        })


        $("#city-picker").cityPicker({
            title: "选择省市区/县",
            onChange: function (picker, values, displayValues) {
                console.log(values, displayValues);
            }
        });
    </script>

  </body>
</html>