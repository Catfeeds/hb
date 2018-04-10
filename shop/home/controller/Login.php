<?php
namespace app\home\controller;
use think\Controller;
use think\Db;
class Login extends controller
{

    public function _initialize(){
        //获取网站头部信息
        $this->assign('site_info',site_info());

        if(action_name()!='logout' && action_name()!='closesite'){
            //检查网站是否关闭
            $close=is_close_site();
            if($close['value']==0){
                $this->redirect('Login/closesite');
            }
        }

    }

    public function closesite(){
        $close=is_close_site();
        if($close['value']==1){
            $this->redirect('Login/login');
        }
        $this->assign('tip',$close['tip']);
        return $this->fetch();
    }

	//登录
    public function login()
    {
        return $this->fetch();
    }

    //用户登录
    public function dologin(){
        if(!request()->isAjax()){
            exit('error');
        }
        $account  = input('account');
        $password = input('password');
        // 验证用户名密码是否正确
        $user_object = model('User');

        $user_info   = $user_object->login($account, $password);
        if (!$user_info) {
            error($user_object->error);
        }
        // 设置登录状态
        $uid = $user_object->auto_login($user_info);
        // 跳转
        if (0 < $uid && $user_info['userid'] === $uid) {
            session('in_time',time());
            $session_id=session_id();
            $user_object->where('userid',$uid)->update(array('session_id'=>$session_id));
            success('登录成功',url('Index/index'));
        }else{
            error('签名错误');
        }
    }


    //选择注册
    public function selectreg(){
        $this->isOpenReg();
        $pid=input('pid/d',1);
        $this->assign('pid',$pid);
        $this->assign('title','注册');
        return $this->fetch();
    }

    private function isOpenReg(){
        $value=get_config_byid(31);
        if($value==0){
            if(request()->isAjax()){
                error('注册功能已关闭');
            }else{
                error_alert('注册功能已关闭');
            }
        }
    }


    //注册会员
    public function register(){
        $this->isOpenReg();
        $pid=input('pid/d',1);
        $mobile=Db::name('user')->where('userid',$pid)->value('mobile');
        $this->assign('mobile',$mobile);

        $this->assign('title','个人注册');
    	return $this->fetch();
    }

    //企业注册
    public function companyregister(){
        $this->isOpenReg();
        $pid=input('pid/d',1);
        $mobile=Db::name('user')->where('userid',$pid)->value('mobile');
        $this->assign('mobile',$mobile);

        $this->assign('title','企业注册');
        return $this->fetch();
    }

    //忘记密码
    public function password(){
    	return $this->fetch();
    }

    public function setpsw(){
        if(!request()->isAjax())
            exit('error');
        $this->isOpenReg();

        $mobile=input('post.mobile');
        $code=input('post.code');
        $password=input('post.password');
        $reppassword=input('post.pwdconfirm');
        if(empty($mobile)){
            error('手机不能为空');
        }
        if(empty($code)){
            error('验证码不能为空');
        }
        if(empty($password)){
            error('密码不能为空');
        }
        if($password  !== $reppassword){
            error('两次输入的密码不一致');
        }
        $user=model('User');
        $mwhere['mobile']=$mobile;
        $userid=$user->where($mwhere)->value('userid');
        if(empty($userid) || !check_mobile($mobile)){
            error('手机号码不在系统中或错误');
        }

        //短信验证
        if(!check_sms($code,$mobile,200)){
           error('验证码错误或已过期');
        }

        $where['userid']=$userid;
        //密码加密
        $salt= substr(md5(time()),0,3);
        $data['login_pwd']=$user->pwdMd5($password,$salt);
        $data['login_salt']=$salt;
        $res=$user->field('login_pwd,login_salt')->where($where)->update($data);
        if($res){
            success('修改成功',url('Login/logout'));
        }
        else{
            error('修改失败');
        }

    }

    //保存用户信息
    public function savereg(){
        if(!request()->isAjax()){
           exit('error');
        }
        $post_data=input('post.');
        $r_data=array();
        
        if(empty($post_data['parent'])){
            $post_data['parent']=db('user')->where('userid=1')->value('mobile');
        }


        $data['mobile']=$post_data['usermobile'];
        $data['code']=$post_data['code'];
        $data['account']=$post_data['useraccount'];
        $data['login_pwd']=$post_data['userlogin'];
        $data['relogin_pwd']=$post_data['reuserlogin'];
        $data['pid']=$post_data['parent'];
        $data['is_agree']=isset($post_data['is_agree'])?$post_data['is_agree']:'';
        if(isset($post_data['usertype']) && $post_data['usertype']==1){
            if(!isset($post_data['companyname']) || empty($post_data['companyname'])){
                error('请输入公司名称');
            }
            if(!isset($post_data['companylicense']) || empty($post_data['companylicense'])){
                error('请输入营业执照号码');
            }
            if(!isset($post_data['companyorganize']) || empty($post_data['companyorganize'])){
                error('请选择组织机构类型');
            }
            $r_data['company_name']=$post_data['companyname'];
            $r_data['company_license']=$post_data['companylicense'];
            $r_data['company_organize']=$post_data['companyorganize'];
            $data['user_type']=1;
        } 

        //验证数据
        $validate = validate('User');
        if(!$validate->scene('add')->check($data)){
            error($validate->getError());
        }

        $user=model('user');
        //密码加密
        $salt= substr(md5(time()),0,3);
        $data['login_pwd']=$user->pwdMd5($data['login_pwd'],$salt);
        $data['login_salt']=$salt;
        //推荐人
        $where['account|mobile']=$data['pid'];
        $p_info=$user->where($where)->field('userid,pid,gid,username,account,mobile')->find();
        $pid=$p_info['userid'];//上级
        $data['pid']=$pid;
        $gid=$p_info['pid'];//上上级ID
        $ggid=$p_info['gid'];//上上上级ID
        if($gid){
            $data['gid']=$gid;
        }
        if($ggid){
            $data['ggid']=$ggid;
        }
        //层级
        $data['deep']=$user->getdeep($pid);
        //路径
        $data['path']=$user->getpath($pid);
        unset($data['relogin_pwd']);
        unset($data['code']);
        unset($data['is_agree']);
        $data['reg_ip']=get_client_ip();
        $data['status']=1;
        $data['reg_date']=time();
        $res=$user->insert($data);
        //注册后处理数据
        $userid=$user->getLastInsID();
        isset($data['user_type'])?$user_type=$data['user_type']:$user_type=0;

        $r_data['uid']=$userid;
        $r_data['user_type']=$user_type;
        $user->afterReguser($r_data);

        db('user_wealth')->insert(array('uid'=>$userid));
        if($res)
            success('注册成功',url('login'));
        else
            error('注册失败');
    }

    public function logout(){
        session('user_login', null);
        session('user_login_sign', null);
        session('in_time',null);
        $this->redirect('Login/login');
    }


    //二维码
    public function usercode(){
        $uid=input('uid/d');
        if(empty($uid)){
            error_alert('参数错误');
        }
        $url ="http://".$_SERVER['HTTP_HOST'].url('home/Login/selectreg',array('pid'=>$uid));
        $path=set_code_img($uid,$url);
        $this->assign('code_path',$path);
        $account=db('user')->where('userid',$uid)->value('account');

        $this->assign('path',$path);
        $this->assign('url',$url);
        $this->assign('account',$account);
        $this->assign('title','我的分享');
        return $this->fetch() ;
    }


    //注册协议
    public function agreement(){
        $uss=db('article')->find(3);
        $this->assign('uss',$uss);
        $this->assign('title','用户注册协议');
        return $this->fetch();
    }


    //发送验证码
    public function sendCode(){

        if(request()->isAjax()){
            $mobile=input('post.mobile');
            $type=input('type');
            if(empty($mobile)){
                $data['status']=0;
                $data['message']='请输入手机号码';
                return $data;
            }
            if(!check_mobile($mobile)){
                $data['status']=0;
                $data['message']='手机号码格式错误';
                return $data;
            }
            $user=model('User');
            $userid=user_login();
            $count=$user->where('mobile',$mobile)->count(1);

            //找回密码
            if($type=='pmob' && $count==0){
                $data['status']=0;
                $data['message']='此手机号不在系统中';
                return $data;
            }
            //注册
            if($type=='mob' && $count>0){

                $data['status']=0;
                $data['message']='该手机号码已被使用，请换其他号码';
                return $data;
            }

            if($type=='pmob')
                return sendMsg($mobile,200);
            else
                return sendMsg($mobile,100);
        }
    }
}
