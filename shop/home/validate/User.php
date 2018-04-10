<?php
namespace app\home\validate;
use think\Validate;
use think\Db;

class User extends Validate
{
    // 验证规则
    protected $rule = [
        'mobile'            	=> 'require|regex:^1[34578]\d{9}$|unique:user',
        'code'                  => 'require|check_code',
        'account'			    => 'require|regex:^[0-9a-zA-Z]{6,20}$|unique:user',
        'login_pwd'			    => 'require|regex:^[0-9a-zA-Z]{6,20}$',
        'relogin_pwd'           => 'require|confirm:login_pwd',
        'pid'                   => 'require|check_parent',
        'is_agree'              => 'require',
    ];
    //错误信息
    protected $message  = [
        'mobile.require'          => '手机号码不能为空',
        'mobile.regex'            => '手机号码格式错误',
        'mobile.unique'           => '该手机号码已被注册',
        'code.require'            => '验证码不能为空',
        'code.check_code'         => '验证码错误或已过期',
        'account.require'         => '账号不能为空',
        'account.regex'           => '账号只能为6-20位数字或字母',
        'account.unique'          => '该账号已存在',
        'login_pwd.require'       => '登录密码不能为空',
        'login_pwd.regex'         => '登录密码只能为6-20位数字或字母',
        'relogin_pwd.require'     => '确认登录密码不能为空',
        'relogin_pwd.confirm'     => '两次输入登录密码不一致',
        'pid.require'             => '推荐人必须填写',
        'pid.check_parent'        => '推荐人不存在',
        'is_agree.require'        => '请同意用户注册协议',
    ];
    //应用场景，添加或修改
    protected $scene = [
        'add'  					=>  ['mobile','code','account','login_pwd','relogin_pwd','pid','is_agree'],
        'edit' 					=>  ['mobile','account'],
    ];



    //验证码
    public function check_code($value,$rule,$data){

        if(!check_sms($value,$data['mobile'],100)){
            return false; 
        }
        return true; 
    }

    public function check_parent($value,$rule,$data){
        if (check_mobile($value)) {
            $where['mobile'] = array('eq', $value); // 手机号
        } else {
            $where['account'] = array('eq', $value); // 用户名
        }
        $count=db('user')->where($where)->count(1);
        if($count==1)
            return true;
        return false;
    }
}