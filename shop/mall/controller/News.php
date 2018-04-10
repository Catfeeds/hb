<?php
namespace app\mall\controller;
use think\Controller;
use think\Db;
class News extends controller
{
    public function newslist()
    {

      $list=array();
      $list=Db::name('shopnew')->order('id desc')->limit(50)->select();
    	$to_html=array(
    		'title'       =>  '最新动态',
        'list'        =>  $list,
    	);
    	$this->assign($to_html);
      return $this->fetch() ;
    }

    public function detail(){
      $id=input('id/d');
      if($id){
        $info=Db::name('shopnew')->find($id);
        $to_html=array(
          'title'       =>  '最新动态',
          'info'        =>  $info,
        );
        $this->assign($to_html);
        return $this->fetch() ;
      }
      

    }

}
