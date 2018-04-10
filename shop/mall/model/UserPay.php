<?php
namespace app\mall\model;
use think\Model;
use think\Db;

class UserPay extends Model
{
	//支付处理模型
    protected $name='order_pay';

    //修改订单状态
    public function setStatus($order_no,$uid=null){
        $this->order_no=$order_no;
        $where['order_no']=$order_no;
        if($uid){
           $where['user_id'] =$uid; 
        }
        $where['order_status']=0;
        $info=Db::name('order_pay')->where($where)->find();
        $order_id_list=$info['order_id_list'];
        $res=Db::name('order_pay')->where($where)->setField('order_status',1);
        if(!$res){
            return false;
        }
        //表
        if($order_id_list){
            unset($where['order_no']);
            $where['order_id']=array('in',explode(',', $order_id_list));
        }

        $order_id_arr=Db::name('order')->where($where)->column('order_id');
        $res=Db::name('order')->where($where)->update(array('order_status'=>1,'order_pay_time'=>time()));

        //++给产品添加销量++S+
         $good_id_arr=Db::name('order_detail')->where('order_id','in',$order_id_arr)->column('good_id,good_num,attr_value','good_id');
         $good=Db::name('good');
         $good_price=Db::name('good_price');
         foreach ($good_id_arr as $k => $v) {
            $array=array();
            $array['good_sell_num']=array('exp','`good_sell_num` + '.$v['good_num']);
            $array['good_store']=array('exp','`good_store` - '.$v['good_num']);
            $good->where('good_id',$k)->update($array);
            if($v['attr_value'] && $v['attr_value']!=''){
                $p_where=array();
                $p_where['good_id']=$k;
                $p_where['good_attr_value']=$v['attr_value'];
                $good_price->where($p_where)->setDec('store',$v['good_num']);
            }
         }
         //++给产品添加销量++E+
    	return $res;
    }

    //余额支付,扣除余额
    public function DecMoney($uid,$total,$data,$type){
    	if(!isset($uid) || empty($uid) || !isset($total) || empty($total)){
    		return false;
    	}
    	//判断是否本人操作
    	if($uid!=user_login()){
    		return false;
    	}

        //1=余额 2=购物券
        if($type==1){
            $field='money';
            $detail=Db::name('money_detail');
        }else{
            $field='coupon';
            $detail=Db::name('coupon_detail');
        }

    	$money=Db::name('user_wealth')->where('uid',$uid)->value($field);
    	if($money<$total){
    		return $type==1 ? '余额不足':'购物券不足';
    	}

    	$res=Db::name('user_wealth')->where('uid',$uid)->setDec($field,$total);
    	if(!$res){
    		return '操作失败';
    	}

		//扣除记录
		$data['uid']=$uid;
		$data['create_time']=time();
		$data['status']=1;
        $data['money_record']=$money-$total;
        $data['money']=$total;
		$res=$detail->insert($data);

		return true;
    }


    //计算下级消费奖(一级5% 二级以上拿下一级的50%，分完为止)和销售额(一级2.5% 二级以上拿下一级的50%，分完为止)-积分  
    protected function ExcBuyIntegral($uid,$money,$type){
        $user=Db::name('user');
        //获取所有父级ID
        $path=$user->where('userid',$uid)->value('path');
        $path=trim($path,'-'); //去两端的-
        $uid_arr=explode('-',$path);

        //按倒序取所有符合条件的上级,宏客宏投以上级别才能获得收益
        $map['userid']=array('in',$uid_arr);
        $map['status']=1;
        $map['level']=array('gt',0);
        $pid_arr=$user->where($map)->order('userid desc')->column('userid');
        if(count($pid_arr)==0){
            return false;
        }

        $config=Db::name('config')->where('id','in',[15,16,36])->column('name,value');
        //特别奖励50%
        $come_fee=$config['come_fee']/100;
        $fee=0;
        //消费手续费
        if($type==1)
            $fee=$config['buy_fee']/100;
        //销售手续费
        if($type==2)
            $fee=$config['sell_fee']/100;
        if(empty($fee))
            return false;

        //分销金额，分完为止,积分扩大100倍
        $fee_num=$money*$fee*100; 
        foreach ($pid_arr as $key => $val) {
            //积分小于100不再分
            if($fee_num < 100){
                break;
            }
            $integral=0;
            $pid=0;
            $pid=$val;
            if($pid){
                    if($key==0){
                        $integral=$fee_num;
                    }
                    else{
                        $fee_num=$fee_num*$come_fee;
                        $integral=$fee_num*$come_fee;
                    }

                    $w_data['integral']=array('exp','`integral` + '.$integral);
                    $w_data['total_integral']=array('exp','`total_integral` + '.$integral);

                    $res=Db::name('user_wealth')->where('uid',$pid)->update($w_data);
                    if($res){
                        if($type==1)
                            $str=$key.'级消费奖励';
                        else
                            $str=$key.'级销售奖励';
                        $data=array();
                        $data['content']=$str.$integral;
                        $data['from_type']=1; //1-转入 2-转出
                        $data['type']='buy';
                        $data['type_name']=$str;
                        $data['uid']=$pid;
                        $data['create_time']=time();
                        $data['status']=1;
                        $data['money']=$integral;
                        $data['money_record']=Db::name('user_wealth')->where('uid',$pid)->value('integral');
                        Db::name('integral_detail')->insert($data);
                    }
            }

        }
        
    }


    //积分分发的时候计算
    public function Excintegralfenfa($uid,$seller_id,$money){
        //计算消费奖-积分
        $this->ExcBuyIntegral($uid,$money,1);

        //计算销售奖励
        $this->ExcBuyIntegral($seller_id,$money,2);
    }


    //给商家金额
    public function MoneyToSeller($id=null){
      //确认收货后给商家添加销售金额
      $uid=user_login();

      $where['order_status']=2;
      $where['money_to_seller']=0;
      if($id){
        $where['order_id']=$id;
        $where['user_id']=$uid;
      }else{
        //15未确认收货，自动收货
        $time=time()-86400*15; 
        $where['order_ship_time']=array('elt',$time);
      }
      $order=Db::name('order');
      $list=$order->where($where)->field('order_id,seller_id,order_total_price,order_no')->select();

      if(empty($list)){
        return;
      }

      $wealth=Db::name('user_wealth');
      $detail=Db::name('money_detail');
      foreach ($list as $k => $v) {
            $money=0;
            $uid=0;
            $res=false;
            $res=$order->where('order_id',$v['order_id'])->update(array('order_status'=>3,'money_to_seller'=>1));

            $money=$v['order_total_price'];
            $uid=$v['seller_id'];

            if($res && $uid>0 && $money>0){
                $w_data=array();
                $w_data['money']=array('exp','`money` + '.$money);
                $w_data['total_money']=array('exp','`total_money` + '.$money);
                $resl=$wealth->where('uid',$uid)->update($w_data);
                if($resl){
                    $data=array();
                    $data['content']='出售商品,订单号'.$v['order_no'];
                    $data['from_type']=1; //1-转入 2-转出
                    $data['type']='sellgood';
                    $data['type_name']='出售商品';
                    $data['uid']=$uid;
                    $data['create_time']=time();
                    $data['status']=1;
                    $data['money']=$money;
                    $data['money_record']=$wealth->where('uid',$uid)->value('money');
                    $detail->insert($data);
                } 
            }
      }


    }

}