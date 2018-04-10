<?php
namespace app\seller\Controller;
use think\Controller;
use think\Db;
use think\Config;
use think\Session;
class Login extends Controller{
	//登录
    public function index()
    {
        return $this->fetch() ;
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
            $this->error($user_object->error);
        }
        // 设置登录状态
        $uid = $user_object->auto_login($user_info);
        // 跳转
        if (0 < $uid && $user_info['userid'] === $uid) {
            session('in_time',time());
            $session_id=session_id();
            $user_object->where('userid',$uid)->update(array('session_id'=>$session_id));
            $this->success('登录成功',url('Index/index'));
        }else{
            $this->error('签名错误');
        }
    }

    //退出登录
    public function logout()
    {   
        session('user_login', null);
        session('user_login_sign', null);
        session('in_time',null);
        $this->redirect('Login/index');
    }
}
?>