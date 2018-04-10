<?php
namespace app\home\controller;
use think\Controller;
use think\Db;
class Service extends Common
{
    public function index()
    {
        
        $info=Db::name('config')->where('id','in',[9,10,11,12,13])->column('name,value');
        $this->assign('info',$info);
        $this->assign('title','在线客服');
        return $this->fetch() ;
    }


}
