<?php
namespace app\mall\controller;
use think\Controller;
use think\Db;
use app\home\controller\Common;
class Order extends Common
{
    //订单列表
    public function orderlist()
    {
      $list=array();
      $userid=user_login();
      $where['user_id']=$userid;
      $type=input('type');
      if($type!='all'){
        $where['order_status']=intval($type);
      }
      $list=Db::name('order')->field('order_no,order_status,order_total_price,order_id,seller_id')->where($where)->order('order_id desc')->select();
      $status_name=array(0=>'待付款',1=>'待发货',2=>'待收货',3=>'已完成');
    	$to_html=array(
    		'title'       =>  '我的订单',
        'list'        =>  $list,
        'status_name' =>  $status_name,
    	);
    	$this->assign($to_html);
      return $this->fetch() ;
    }


    //取消订单
    public function delete(){
      $order_id=input('id/d',0);
      if($order_id){
        $where['order_id']=$order_id;
        $where['user_id']=user_login();
        $where['order_status']=0;
        $res=Db::name('order')->where($where)->delete();
        if($res){
          Db::name('order_detail')->where('order_id',$order_id)->delete();
          success('取消成功');
        }else{
          error('取消失败');
        }
      }
    }

    //立即支付
    public function gopay(){
      $order_id=input('order_id/d');
      $userid=user_login();
      $where['order_id']=$order_id;
      $where['order_status']=0;
      $where['user_id']=$userid;
      $info=Db::name('order')->where($where)->find();
      if(empty($info)){
        error('订单不存在');
      }
      //判断主菜单是否存在
      unset($where['order_id']);
      $where['order_id_list']=$order_id;
      $id=Db::name('order_pay')->where($where)->value('id');
      if(empty($id)){
        $order_no=action('Shopcar/get_pay_no');
        $data=array(
            'order_no'            =>    $order_no,
            'order_id_list'       =>    $order_id,
            'order_total_price'   =>    $info['order_total_price'],
            'order_status'        =>    0,
            'user_id'             =>    $userid,
        );

        $res=db('order_pay')->insert($data);
        $id=db('order_pay')->getLastInsID();
        if(!$res)
          error('支付失败');
      }

      success('',url('Shopcar/payway',array('id'=>$id)));
    }



    //确认收货
    public function suregood(){
      $id=input('id/d');
      if($id && request()->isAjax()){
        model('UserPay')->MoneyToSeller($id);
        success('操作成功');
       
      }
    }






    //确认收货时给商家添加销售金额
    
    



}
