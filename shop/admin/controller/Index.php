<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Index extends Base
{
    public function index()
    {

        $info['total']=Db::name('user')->count(1);
        $where["FROM_UNIXTIME(reg_date,'%Y%m%d')"]=date('Ymd');
        $info['date_total']=Db::name('user')->where($where)->count(1);
        $this->assign('info',$info);
        return $this->fetch() ;
    }

   	/**
    * 删除缓存
    * 
    */
    public function removeRuntime()
    {
        $file   = new \file\File();
        $result = $file->del_dir(RUNTIME_PATH);
        if ($result) {
            success("缓存清理成功");
        } else {
            error("缓存清理失败");
        }
    }
}
