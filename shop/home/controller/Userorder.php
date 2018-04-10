<?php
namespace app\home\controller;
use think\Controller;
class Userorder extends Common
{

    //线下转账
    public function index(){

        return $this->fetch();
    }

     //工单记录
    public function detail(){
        $type=input('type/d');
        $uid=user_login();
        $list=db('update_userinfo')->where('uid',$uid)->where('status',$type)->order('id desc')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    //删除工单
    public function deledatail(){
        if(!request()->isAjax()){
            exit();
        }
        $id=input('id/d');
        if(empty($id)){
            error('参数错误');
        }
        $db=db('update_userinfo');
        $where['id']        =   $id;
        $where['uid']    =   user_login();
        $where['status']    =   0;
        $res=$db->where($where)->delete();
        if($res)
            success('删除成功',url('detail'));
        else
            error('删除失败');
    }

    //修改手机号码
    public function updatemobile(){

    	if(request()->isAjax()){

    		$data=input('post.');
    		if(empty($data['code']))
    			error('请输入验证码');
    		if(empty($data['new_mobile']))
    			error('请输入新手机号码');
    		if(empty($data['content']))
    			error('请输入修改信息');
    		if(empty($data['license']))
    			error('请上传证件照');
            if(user_type()!=1 && empty($data['back'])){
                error('请上传证件反面照');
            }
            if(!check_mobile($data['new_mobile'])){
                error('新手机号码格式错误');
            }

    		$user=model('User');
    		$userid=user_login();
    		$count=$user->where('mobile',$data['new_mobile'])->count(1);
    		if($count>0){
    			error('该手机号码已被使用，请换其他号码');
    		}
    		//验证短信
    		$code=$data['code'];
            $mobile=$user->getField('mobile');
            if(!check_sms($code,$mobile)){
                error('验证码错误或已过期'); 
            }

			$add_data['uid']			=	$userid;
			$add_data['update_type']	=	1;
			$add_data['new_info']		=	$data['new_mobile'];
			$add_data['content']		=	$data['content'];
			$add_data['img']			=	$data['license'];
			$add_data['status']			=	0;
			$add_data['create_time']	=	time();
            $add_data['img_back']       =   $data['back'];

			if(db('update_userinfo')->insert($add_data)){
                //清除短信session
                del_check_sms();
                success('提交成功，等待系统审核');
            }else{
                error('提交失败');
            }
    	}

    	$this->assign('title','修改手机号码');
    	return $this->fetch();
    }

    public function updatemobileself(){

    	if(request()->isAjax()){
    		$code=input('post.code');
    		if(empty($code))
    			error('请输入验证码');

    		//验证短信
            $mobile=model('User')->getField('mobile');
            if(!check_sms($code,$mobile)){
                error('验证码错误或已过期'); 
            }

            //设置信息
            session('mobileself',$mobile);
            //清除短信session
            del_check_sms();
            success('操作成功',url('nextmobile'));

    	}
    	session('mobileself',null);
    	$this->assign('title','修改手机号码');
    	return $this->fetch();
    }

    //下一步
    public function nextmobile(){

    	$mobileself=session('mobileself');
    	$mobile=model('User')->getField('mobile');
    	if(isset($mobileself) && $mobileself==$mobile){

    		if(request()->isAjax()){

	    		$code=input('post.code');
	    		$new_mobile=input('post.mobile');
	    		if(empty($code))
	    			error('请输入验证码');
	    		if(empty($new_mobile))
	    			error('请输入新手机号码');

	    		//验证短信
	            if(!check_sms($code,$new_mobile,1)){
	                error('验证码错误或已过期'); 
	            }

	            $userid=user_login();
	            $user=model('User');
	    		$userid=user_login();
	    		$count=$user->where('mobile',$new_mobile)->count(1);
	    		if($count>0){
	    			error('该手机号码已被使用，请换其他号码');
	    		}
	            //修改手机号码
	            $res=$user->where('userid',$userid)->update(array('mobile'=>$new_mobile));
	            if($res){
	            	session('mobileself',null);
	            	//清除短信session
                	del_check_sms();
	            	success('修改成功,请重新登录',url('home/Login/logout'));
	            }else{
	            	error('修改失败'); 
	            }
	    	}
    		
	    	$this->assign('title','修改手机号码');
	    	return $this->fetch();
    	}
    }

    //发送验证码
    public function sendCode(){

        if(request()->isAjax()){
            $mobile=input('post.mobile');
            if(empty($mobile)){
            	$data['status']=0;
    			$data['message']='请输入手机号码';
    			return $data;
            }
            if(!check_mobile($mobile)){
    			$data['status']=0;
    			$data['message']='新手机号码格式错误';
    			return $data;
    		}
            $user=model('User');
    		$userid=user_login();
    		$count=$user->where('mobile',$mobile)->count(1);
    		if($count>0){
    			$data['status']=0;
    			$data['message']='该手机号码已被使用，请换其他号码';
    			return $data;
    		}
    		if($mobile)
            	return sendMsg($mobile,1);
        }
    }


    //修改真实姓名
    public function updateusername(){

        if(request()->isAjax()){
            $data=input('post.');
            if(user_type()!=0){
                 error('非个人用户');
            }
            if(empty($data['new_username']))
                error('请输入新姓名');
            if(empty($data['content']))
                error('请输入问题描述');
            if(empty($data['license']))
                error('请上传证件照');

            if(empty($data['back']))
                error('请上传证件背面照');

            $userid=user_login();

            $add_data['uid']            =   $userid;
            $add_data['update_type']    =   2;
            $add_data['new_info']       =   $data['new_username'];
            $add_data['content']        =   $data['content'];
            $add_data['img']            =   $data['license'];
            $add_data['status']         =   0;
            $add_data['create_time']    =   time();
            $add_data['img_back']           =   $data['back'];

            if(db('update_userinfo')->insert($add_data)){
                success('提交成功，等待系统审核');
            }else{
                error('提交失败');
            }
        }
        if(user_type()!=0){
            error_alert('非个人用户');
        }
        $username=model('User')->getField('username');
        $this->assign('username',$username);
    	$this->assign('title','修改真实姓名');
    	return $this->fetch();
    }

    //修改企业名称
    public function updatecompanyname(){
        if(request()->isAjax()){
            $data=input('post.');
            if(user_type()!=1){
                 error('非企业用户');
            }
            if(empty($data['new_companyname']))
                error('请输入新公司名称');
            if(empty($data['content']))
                error('请输入问题描述');
            if(empty($data['license']))
                error('请上传证件照');
            
            $userid=user_login();
            $add_data['uid']            =   $userid;
            $add_data['update_type']    =   3;
            $add_data['new_info']       =   $data['new_companyname'];
            $add_data['content']        =   $data['content'];
            $add_data['img']            =   $data['license'];
            $add_data['status']         =   0;
            $add_data['create_time']    =   time();

            if(db('update_userinfo')->insert($add_data)){
                success('提交成功，等待系统审核');
            }else{
                error('提交失败');
            }
        }

        if(user_type()!=1){
            error_alert('非企业用户');
        }
        $username=model('User')->getField('username');
        $this->assign('username',$username);
    	$this->assign('title','修改企业名称');
    	return $this->fetch();
    }

    

    
}
