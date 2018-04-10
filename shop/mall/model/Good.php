<?php
namespace app\mall\model;

use think\Model;

class Good extends Model
{

	//判断商品是否存在
	public function isExistGood($good_id){
		$where['status']=1;
		$where['good_id']=$good_id;
		$res=$this->where($where)->count(1);
		if($res==1)
			return true;
		else
			return false;
	}
}