
<?php


//判断是企业用户还是个人用户
function user_type(){
	return model('User')->getField('user_type');
}

//是否认证身份
function is_check_user(){
	$uid=user_login();
	$info=db('user_checkinfo')->where('uid',$uid)->field('is_check_mobile,is_check_user,is_check_company,user_type')->find();
	if($info['user_type']==1 && $info['is_check_company']==2){
		return true;
	}
	if($info['user_type']==0 && $info['is_check_user']==2){
		return true;
	}
		return false;
}



