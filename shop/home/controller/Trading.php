<?php
namespace app\home\controller;
use think\Controller;
class Trading extends Common
{


    //线下转账
    public function offlinetrading(){

        return $this->fetch();
    }

    public function offlinedetaill(){

        $this->assign('title','转账记录');
        return $this->fetch();
    }

    public function detaill(){

        $this->assign('title','转账记录');
        return $this->fetch();
    }

    

    
}
