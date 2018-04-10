<?php
/**
 * 本程序仅供娱乐开发学习，如有非法用途与本公司无关，一切法律责任自负！
 */
namespace app\home\controller;
use think\Controller;
use think\Db;
class Common extends controller {
	public function _initialize(){
         //获取网站头部信息
        $this->assign('site_info',site_info());
        
        //判断网站是否关闭
        $close=is_close_site();
        if($close['value']==0){
          success_alert($close['tip'],url('home/Login/logout'));
        }

        //验证用户登录
        $this->is_user();

    }


  protected function is_user(){
      $userid=user_login();
      $user=db('user');
      if(!$userid){
          if(request()->isAjax()){
            success('登录超时',url('home/Login/login'));
          }
          $this->redirect('home/Login/login');
          exit();
       }

       //判断12小时后必须重新登录
       $in_time=session('in_time');
       $time_now=time();
       $between=$time_now-$in_time;
       if($between > 43200){
          if(request()->isAjax()){
            success('登录超时',url('home/Login/logout'));
          }
          $this->redirect('home/Login/logout');
       }

       $where['userid']=$userid;
       $u_info=$user->where($where)->field('status,session_id')->find(); 

       //判断用户是否锁定 
       $login_from_admin=session('login_from_admin');//是否后台登录
       if($u_info['status']==0 && $login_from_admin!='admin'){
          if(request()->isAjax()){
            success('你账号已锁定，请联系管理员',url('home/Login/logout'));
          }
          success_alert('你账号已锁定，请联系管理员',url('home/Login/logout'));
          exit();
       }

       //判断用户是否在他处已登录
       $session_id=session_id();
       if($session_id != $u_info['session_id'] && empty($login_from_admin)){
          if(request()->isAjax()){
            success('您的账号在他处登录，您被迫下线',url('home/Login/logout'));
          }
          success_alert('您的账号在他处登录，您被迫下线',url('home/Login/logout'));
          exit();
       }

      //记录操作时间
      session('in_time',time());

  }


    //发送验证码
    public function sendCode(){
        if(request()->isAjax()){
            $mobile=model('user')->getField('mobile');
            if($mobile){
               return sendMsg($mobile);
            }
        }
    }

    /**
     * 上传图片
     */
    public function uplodeimg(){
        $file = request()->file();
        $file=array_keys($file);
        $data=upload_img($file[0]);
        echo json_encode($data);
    }

}

