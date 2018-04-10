<?php
namespace app\seller\model;

use think\Model;

class User extends Model
{
	public $error='';
	/**
     * 用户登录
     * 
     */
    public function login($account, $password, $map = null)
    {
        //去除前后空格
        $account = trim($account);
        if(!isset($account) || empty($account)){
            $this->error='账号不能为空';
            return false;
        }
        if(!isset($password) || empty($password)){
            $this->error='密码不能为空';
            return false;
        }

        //匹配登录方式
		if (check_mobile($account)) {
            $map['mobile'] = array('eq', $account); // 手机号登陆
        } else {
            $map['account'] = array('eq', $account); // 用户名登陆
        }
        $map['status']=array('gt',-1);
        $user_info     = $this->where($map)->find(); //查找用户
        if (!$user_info) {
            $this->error = '账号或密码错误!';
            return false;
        }
        elseif ($user_info['status']==0) {
            $this->error = '您的账号已锁定，请联系管理员!';
            return false;
        }
        else {
            if($this->pwdMd5($password,$user_info['login_salt']) !== $user_info['login_pwd']) {
                $this->error = '账号或密码错误！';
                return false;
            }else {
               
                if($user_info['seller']==0){
                    $this->error='非商家用户';
                    return false;
                }
                //认证个人信息
                if($user_info['user_type']==1)
                    $where['is_check_company']=2;
                else
                    $where['is_check_user']=2;
                $where['uid']=$user_info['userid'];
                $count=db('user_checkinfo')->where($where)->count(1);
                if($count==0){
                   $this->error='未认证个人信息，请先认证信息';
                   return false; 
                }
                return $user_info;
            }
        }
        return false;
    }



	/**
     * [getdeep 层级]
     * @return [type] [description]
     */
    public function getdeep($userid){
        $where['userid']=$userid;
        $deep=$this->where($where)->value('deep');
        return $deep+1;
    }

    /**
     * [getpath 路径]
     * @return [type] [description]
     */
    public function getpath($userid){
        $where['userid']=$userid;
        $path=$this->where($where)->value('path');
        if(empty($path))
            $path='-'.$userid.'-';
        else
            $path.=$userid.'-';
        return $path;
    }

     /**
     * [pwdMd5 用户密码加密]
     * 
     */
    public function pwdMd5($value,$salt){
        $pwd=user_md5($value);
        $user_pwd=md5($pwd.$salt);
        return  $user_pwd;
    }

    //验证二级密码是否正确
    public function check_pwd_two($value){
        $where['userid']=session('userid');
        $u_info=$this->where($where)->field('safety_pwd,safety_salt')->find();
        $salt=$u_info['safety_salt'];
        $pwd=$u_info['safety_pwd'];
        if($pwd == $this->pwdMd5($value,$salt)){
            return true;
        }else{
            return false;
        }
    }


    /**
     * 设置登录状态
     * 
     */
    public function auto_login($user)
    {
        // 记录登录SESSION和COOKIES
        $auth = array(
            'userid'      => $user['userid'],
            'account' => $user['account'],
            'mobile' => $user['mobile'],
            'username' => $user['username'],
        );
        $data=$this->data_auth_sign($auth);
        session('user_login', $auth);
        session('user_login_sign', $data);
        return $this->user_login();
    }

    /**
     * 数据签名认证
     * @param  array  $data 被认证的数据
     * @return string       签名
     * 
     */
    public function data_auth_sign($data)
    {
        // 数据类型检测
        if (!is_array($data)) {
            $data = (array) $data;
        }
        ksort($data); //排序
        $code = http_build_query($data); // url编码并生成query字符串
        $sign = sha1($code); // 生成签名
        return $sign;
    }

    /**
     * 检测用户是否登录
     * @return integer 0-未登录，大于0-当前登录用户ID
     * 
     */
    public function user_login()
    {
        $user = session('user_login');
        if (empty($user)) {
            return 0;
        } else {
            if (session('user_login_sign') == $this->data_auth_sign($user)) {
                return $user['userid'];
            } else {
                return 0;
            }
        }
    }


    public function getField($field){
        $userid=$this->user_login();
        return $this->where('userid',$userid)->value($field);
    }

    //添加成功后操作
    public function afterReguser($data){
       return db('user_checkinfo')->insert($data);
    }

    //验证登录密码
    public function  checkLoginPwd($value){
        $user_info=$this->field('login_salt,login_pwd')->where('userid',$this->user_login())->find();
        if($this->pwdMd5($value,$user_info['login_salt']) === $user_info['login_pwd']){
            return true;
        }else{
            return false;
        }
    }

    //验证安全密码
    public function  checkSafePwd($value){
        $user_info=$this->field('safety_salt,safety_pwd')->where('userid',$this->user_login())->find();
        if($this->pwdMd5($value,$user_info['safety_salt']) === $user_info['safety_pwd']){
            return true;
        }else{
            return false;
        }
    }

}