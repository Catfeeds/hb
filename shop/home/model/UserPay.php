<?php
namespace app\home\model;

use think\Model;
use think\Db;

class UserPay extends Model
{
	 //支付处理模型
    protected $name='pay_record';

    //修改订单状态
    public function setStatus($order_no,$table){
    	$where['order_no']=$order_no;
    	$where['status']=0;
        $status=db($table)->where($where)->value('status');
        if($status!=0){
            return false;
        }
    	//表
    	$res=db($table)->where($where)->update(array('status'=>1,'pay_time'=>time()));
    	if($res){
    		//升级用户
    		if($table=='update_order' && !$this->modifyuserlevel($order_no)){
    			return false;
    		}

            //充值
            if($table=='money_recharge'){
                $this->UserRecharge($order_no);
                return false;
            }

    		return true;
    	}
    	else
    		return false;
    }

    //余额支付,扣除余额
    public function DecMoney($uid,$total,$data){
    	if(!isset($uid) || empty($uid) || !isset($total) || empty($total)){
    		return false;
    	}
    	//判断是否本人操作
    	if($uid!=user_login()){
    		return false;
    	}

    	$money=model('UserWealth')->getField('money');
    	if($money<$total){
    		return '余额不足';
    	}

    	$res=model('UserWealth')->where('uid',$uid)->setDec('money',$total);
    	if(!$res){
    		return '余额扣除失败';
    	}

		//扣除记录
		$data['uid']=$uid;
		$data['create_time']=time();
		$data['order_no']=''; //订单号
		$data['status']=1;
        $data['money_record']=$money-$total;
        $data['money']=$total;
		$res=db('money_detail')->insert($data);

		return true;
    }

    //用户升级
    protected function modifyuserlevel($order_no){
        $where['order_no']=$order_no;
        $update=db('update_order')->where($where)->field('status,uid,user_level,money')->find();
        if($update['status']!=1){
            return false;
        }

        $uid=$update['uid'];
        $user_level=$update['user_level'];
        $info=db('user')->where('userid',$uid)->field('level,pid,gid,ggid')->find(); //用户当前等级
        $level=$info['level'];
        if($level<$user_level){
            $res=db('user')->where('userid',$uid)->setField('level',$user_level);
            if(!$res){
            	return false;
            }

            //给自己奖励等额的积分
            $this->UserIntegral($uid,$update['money']);

            //二级分销，奖励华宝
            $data=array($info['pid'],$info['gid']);
            $this->ThreeCome($data,$update['money']);
        }
        

        return true;
    }


    //用户充值
    protected function UserRecharge($order_no){

        $where['order_no']=$order_no;
        $where['status']=1;
        $info=db('money_recharge')->where($where)->field('uid,money')->find();
        if($info){
            $uid=$info['uid'];
            $money=$info['money'];
            $res=Db::name('user_wealth')->where('uid',$uid)->setInc('money',$money);
            if($res){
                $detail['content']='在线充值'.$money;
                $detail['from_type']=1; //1-转入 2-转出
                $detail['type']='online';
                $detail['type_name']='在线充值';
                $detail['uid']=$uid;
                $detail['create_time']=time();
                $detail['status']=1;
                $detail['money']=$money;
                $detail['money_record']=Db::name('user_wealth')->where('uid',$uid)->value('money');
                Db::name('money_detail')->insert($detail);
            }
        }

    }




    //给自己奖励等额的积分
    protected function UserIntegral($uid,$money){
        $integral=$money*100;
        $data['integral']=array('exp','`integral` + '.$integral);
        $data['total_integral']=array('exp','`total_integral` + '.$integral);
        $res=Db::name('user_wealth')->where('uid',$uid)->update($data);
        if($res){
            $detail=array();
            $detail['content']='升级奖励'.$integral;
            $detail['from_type']=1; //1-转入 2-转出
            $detail['type']='children';
            $detail['type_name']='升级奖励';
            $detail['uid']=$uid;
            $detail['create_time']=time();
            $detail['status']=1;
            $detail['money']=$integral;
            $detail['money_record']=Db::name('user_wealth')->where('uid',$uid)->value('integral');
            Db::name('integral_detail')->insert($detail); 
        }
    }

    //二级分销奖励积分
    protected function ThreeCome($data,$money){

        $user=Db::name('user');
        $anzi_detail=Db::name('anzi_detail');
        $user_wealth=Db::name('user_wealth');
        // $fee_data=Db::name('config')->where('id','in',['33','34'])->order('id asc')->column('value');
        
        //消费商->创客 一二级分润
        if($money==888){

            $fee_data[0]=18000;
            $fee_data[1]=8880;

        }elseif ($money==8888) {
            //消费商->创投
            $fee_data[0]=180000;
            $fee_data[1]=88880;

        }elseif ($money==8000) {
            //创客->创投
            $fee_data[0]=160000;
            $fee_data[1]=80000;

        }else{
            return false;
        }
        
       
        foreach ($data as $k => $val) {
           $fee=0;
           $total=0;
           if($val>0){
               $where['userid']=$val;
               $where['level']=array('gt',0); //level=1或2才给奖励
               $where['status']=1;
               $count=$user->where($where)->count(1);
                if($count>0){
                   
                    $total=$fee_data[$k];
                    $w_data['anzi']=array('exp','`anzi` + '.$total);
                    $w_data['total_anzi']=array('exp','`total_anzi` + '.$total);
                    $res=$user_wealth->where('uid',$val)->update($w_data);
                    if($res){
                        $detail=array();
                        $detail['content']=($k+1).'级分享奖励'.$total;
                        $detail['from_type']=1; //1-转入 2-转出
                        $detail['type']='children';
                        $detail['type_name']=($k+1).'级分享奖励';
                        $detail['uid']=$val;
                        $detail['create_time']=time();
                        $detail['status']=1;
                        $detail['money']=$total;
                        $detail['money_record']=$user_wealth->where('uid',$val)->value('anzi');
                        $anzi_detail->insert($detail);
                    }
                    //计算特别奖励
                    //$this->ExcComeIntegral($val,$total);
                }
           }
        }
        
    } 

    //计算特别奖励
    protected function ExcComeIntegral($uid,$money){
        $user=Db::name('user');
        $pid=$user->where('userid',$uid)->value('pid');
        if($pid==0){
            return true;
        }
        $where['userid']=$pid;
        $where['level']=array('gt',0); //level=1或2才给奖励
        $where['status']=1;
        $count=$user->where($where)->count(1);
        if($count>0){

            $fee=get_config_byid(36);
            $fee=$fee/100;
            $integral=$money*$fee;  // money已是积分，无需乘100

            $w_data['integral']=array('exp','`integral` + '.$integral);
            $w_data['total_integral']=array('exp','`total_integral` + '.$integral);

            $res=Db::name('user_wealth')->where('uid',$pid)->update($w_data);
            if($res){
                $data['content']='特别奖励'.$integral;
                $data['from_type']=1; //1-转入 2-转出
                $data['type']='buy';
                $data['type_name']='特别奖励';
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