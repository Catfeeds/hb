<?php
/**
 * 本程序仅供娱乐开发学习，如有非法用途与本公司无关，一切法律责任自负！
 */
namespace app\home\controller;
use think\Controller;
use think\Db;
class Datework extends controller {



  //每天返积分
  public function integraltoanzi(){
    file_put_contents('./jifen.txt', date('Y-m-d H:i:s')."执行完成\n",FILE_APPEND);

    // $result = Db::execute('call IntegralToAnzi()');
    
     $sql="UPDATE ysk_user_wealth SET anzi=anzi+((integral/10000)*5),total_anzi=total_anzi+((integral/10000)*5),uptime=DATE_FORMAT(now(), '%Y%m%d'),uptimeing=now(),integral=integral-((integral/10000)*5) WHERE integral>=100 AND uptime != DATE_FORMAT(now(), '%Y%m%d')";
     $result = Db::execute($sql);
  }

  //15天未确认收货自动收货
  public function gettosell(){
    file_put_contents('./jinbi.txt', date('Y-m-d H:i:s')."执行完成\n",FILE_APPEND);
    $result = model('mall/UserPay')->MoneyToSeller();
  }


}

