<?php
namespace app\seller\Controller;
use think\Controller;
use think\Db;
class Index extends Base{

	public function index(){
		$map=array();
		$map['isshow'] = 1;
		$map['isadmin'] = 1;
		$res = Db::name("seller_menu")->where($map)->order("orders desc")->select();
		
		$menuList = $this->getTree($res,0);
		$this->assign("menu",json_encode($menuList));
		return $this->fetch();
	}

	public function webcome(){

		$uid=seller_login();
		$info=Db::name('user_wealth')->where('uid',$uid)->find();
		$this->assign('info',$info);
		return $this->fetch();
	}

	
}
?>