<?php
namespace app\admin\controller;
use think\Controller;
use think\Config;
use think\Session;
class Login extends controller
{
    public function login()
    {
        // if(input("type") != Config::get("admin.islogin")){
        //     return '404';
        // }
        return $this->fetch() ;
    }

    public function dologin(){
    	if (request()->isAjax()) {
            $username = input('username');
            $password = input('password');

            // 验证用户名密码是否正确
            $user_object = model('admin/Admin');
            $user_info   = $user_object->login($username, $password);
            if (!$user_info) {
               error($user_object->getError());
            }
             // 验证该用户是否有管理权限
            $account_object = db('group');
            $where['id']   = $user_info['auth_id'];
            $account_info['id']   = $account_object->where($where)->find();
            if (!$account_info) {
                error('该用户没有管理员权限');
            }

            // 设置登录状态
            $uid = $user_object->auto_login($user_info);

            // 跳转
            if (0 < $account_info['id']) {
                session::set("islogin",1);
                success('登录成功！', url('Admin/Index/index'));
            } else {
                $this->logout();
            }
        }
    }

    /**
     * 注销
     * 
     */
    public function logout()
    {
        session('user_auth', null);
        session('user_auth_sign', null);
        session('user_group', null);
        session('islogin',null);
        // if(request()->isAjax()){
        //     success('退出成功！', url('Login/login'));
        // }else{
        //     $this->redirect(url('Login/login'));
        // }
        if(request()->isAjax()){
            success('退出成功！', '/hctxsys');
        }else{
            $this->redirect('/hctxsys');
        }
    }
}
