<?php
namespace app\seller\Controller;
use think\Db;
use think\Controller;
use think\View;
use think\Request;
use think\Session;
use think\Config;
class Base extends Controller{
	protected function _initialize()
    {
    	// 登录检测
        if (!seller_login()) {
            //还没登录跳转到登录页面
            $this->redirect('seller/Login/index');
        }
	}

	public function getTree($data, $pId)
	{
		
		$tree = '';
		foreach($data as $k => $v)
		{
			$pos  =  strpos ((string)$v['pid'] ,  (string)$pId );
		  if($pos !== false)
		  {        //父亲找到儿子strpos ((string)$v['pid'] ,  (string)$pId );
		   $v['menu'] = $this->getTree($data, $v['id']);
		   if($v['ismodel'] == 1 && $v['url'] != ""){
	        	$v['url'] = Url($v['url']);
	        }
		   unset($v['id']);		   
		   unset($v['isshow']);
		   unset($v['ismodel']);
		   if($v['pid'] != 0){
		   	unset($v['menu']);
		   }
		   unset($v['pid']);
		   $tree[] = $v;
		   //unset($data[$k]);
		  }
		}
		return $tree;
	}
}
?>