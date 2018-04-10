<?php
namespace app\admin\model;

use think\Model;

class Admin extends Model
{
	/**
     * 数据库表名
     *
     */
    protected $name = 'admin';


    /**
     * 用户登录
     *
     */
    public function login($username, $password, $map = null)
    {
        //去除前后空格
        $username = trim($username);
        if(!isset($username) || empty($username)){
            $this->error = '用户名不能为空！';
            return false;
        }
        if(!isset($password) || empty($password)){
            $this->error = '密码不能为空';
            return false;
        }

        //匹配登录方式
        if (preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", $username)) {
            $map['email'] = array('eq', $username); // 邮箱登陆
        } elseif (preg_match("/^1\d{10}$/", $username)) {
            $map['mobile'] = array('eq', $username); // 手机号登陆
        } else {
            $map['username'] = array('eq', $username); // 用户名登陆
        }

        $map['status'] = array('eq', 1);
        $user_info     = $this->where($map)->find(); //查找用户
        if (!$user_info) {
            $this->error = '用户不存在或被禁用！';
            return false;
        } else {

            if (user_md5($password) !== $user_info['password']) {
                $this->error = '密码错误！';
            } else {
                return $user_info;
            }
        }
        return false;
    }

    /**
     * 设置登录状态
     *
     */
    public function auto_login($user)
    {
        // 记录登录SESSION和COOKIES
        $auth = array(
            'uid'      => $user['id'],
            'username' => $user['username'],
            'nickname' => $user['nickname'],
        );
        session('user_auth', $auth);
        session('user_auth_sign', $this->data_auth_sign($auth));
        return $this->is_login();
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
    public function is_login()
    {
        $user = session('user_auth');
        if (empty($user)) {
            return 0;
        } else {
            if (session('user_auth_sign') == $this->data_auth_sign($user)) {
                return $user['uid'];
            } else {
                return 0;
            }
        }
    }
}