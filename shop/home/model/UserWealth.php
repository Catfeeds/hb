<?php
namespace app\home\model;

use think\Model;

class UserWealth extends Model
{
	 // 当前模型名称
    protected $name='user_wealth';

    public function getField($field){
    	$uid=user_login();
    	return $this->where('uid',$uid)->value($field);
    }
}