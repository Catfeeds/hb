<?php
namespace app\seller\Controller;
use think\Controller;
use think\Db;
class Cash extends Base{

	public function index(){
		$list=Db::name('bank_name')->field('id,bank_name')->where('status',1)->order('sort desc')->select();

		//商家销售额
		$uid=seller_login();
		$info=Db::name('user_wealth')->where('uid',$uid)->find();
		$user=Db::name('user')->where('userid',$uid)->field('bank_name,bank_no,bank_username')->find();
		if($user){
			$info=array_merge($info,$user);
		}

		$this->assign('info',$info);
		$this->assign('list',$list);
		return $this->fetch();
	}

	public function save(){

		$money=input('post.money');
		$bank_name=input('post.bank_name');
		$bank_no=input('post.bank_no');
		$bank_username=input('post.bank_username');
		if(empty($money)){
			$this->error('请输入金额');
		}
		if(!preg_match('/^[1-9]\d*$/', $money)){
	        $this->error('请输入整数');
	    }
	    if($money<500 || ($money%100)!=0){
	    	$this->error('提现金额必须大于500，且为整百');
	    }
	    if(empty($bank_name)){
			$this->error('请选择银行名称');
		}
		if(empty($bank_no)){
			$this->error('请输入银行卡号');
		}
		if(empty($bank_username)){
			$this->error('请输入开户名');
		}
		$uid=seller_login();
		$wealth=Db::name('user_wealth');
		$cash=$wealth->where('uid',$uid)->value('cash');
		if($cash < $money){
			$this->error('金额不足');
		}
		$res=$wealth->where('uid',$uid)->setDec('cash',$money);
		if(!$res){
			$this->error('操作失败');
		}

		$user=session('user_login');

		$add['bank_name']   =   $bank_name;
        $add['bank_username']=   $bank_username;
        $add['bank_no']     =   $bank_no;
        Db::name('user')->where('userid',$uid)->update($add);

        $add['uid']         =   $uid;
        $add['money']       =   $money;
        $add['fee']         =   0;
        $add['status']      =   0;
        $add['create_time'] =   time();
        $add['username']    =   $user['username'];
        $add['mobile']      =   $user['mobile'];
        $add['account']     =   $user['account'];
        $res=Db::name('cash_get')->insert($add);
        if($res){
        	$this->success('提交成功，等待平台审核');
        }else{
        	$this->error('操作失败');
        }
	}


	public function record(){
		$uid=seller_login();
		$map['uid']=$uid;
		$keyword    = input('keyword', '');
		if($keyword){
			$map['bank_name|bank_username|bank_no']=array('like','%'.$keyword.'%');
		}
		$status=input('status');
		if($status!=''){
			$map['status']=$status;
		}

		//按日期搜索
        $date=date_query('create_time');
        if($date){
            $where=$date;
            if(isset($map))
                $map=array_merge($map,$where);
            else
                $map=$where;
        }
		
		$list=Db::name('cash_get')->where($map)->order('id desc')->paginate(10,false,['query'=>request()->param()]);
		$this->assign('list',$list);
		return $this->fetch();
	}
}
?>