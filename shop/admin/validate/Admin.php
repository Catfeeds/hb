<?php
namespace app\admin\validate;
use think\Validate;
use think\Db;

class Admin extends Validate
{
    // 验证规则
    protected $rule = [
        'auth_id'            	=> 'check_auth',
        'username'            	=> 'require|regex:^(?!_)(?!\d)(?!.*?_$)[\w]+$',
        'password'				=> 'require|length:6,30',
        'repassword'			=> 'require|confirm:password'
    ];
    //错误信息
    protected $message  = [
        'auth_id.check_auth'       => '角色不能为空',
        'username.require'      => '用户名不能为空',
        'username.regex'        => '用户名只可含有数字、字母、下划线且不以下划线开头结尾，不以数字开头！',
        'password.require'		=> '密码不能为空',
        'password.length'		=> '密码长度为6-30位',
        'password.regex'		=> '密码至少由数字、字符、特殊字符三种中的两种组成',
        'repassword.require'	=> '确认密码不能为空',
        'repassword.confirm'	=> '两次输入的密码不一致',
    ];
    //应用场景，添加或修改
    protected $scene = [
        'add'  					=>  ['auth_id','username','password','repassword'],
        'edit' 					=>  ['auth_id','username'],
    ];

    protected function check_auth($value,$rule,$data)
    {
        if($data['id']!=1 && empty($value)){
            return false;
        }
        return true;
    }
}