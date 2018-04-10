<?php
namespace app\home\controller;
use think\Controller;
use think\Db;
class Usersign extends Common
{

	public function test(){
		p(intval(date('d')));
	}

    //签到
    public function index(){

        $year = date('Y');
        $moth = date('m');
        $time = $year.'年'.$moth.'月'.date('d').'日';
        $this->assign('time',$time);


		$qd_db = Db::name('daysign');
		$userid =user_login();
		$f_where['uid']= $userid;
		$f_where['year']= $year;
		$f_where['moth']= $moth;
		$qd_info = $qd_db->where($f_where)->find();
		$info=Db::name('user')->where('userid',$userid)->field('sign_total,jf_daysign')->find();
		if($qd_info){
			$qd_info=array_merge($qd_info,$info);
		}

		$this->assign('qd_info',$qd_info);

		//签到记录
		$detail_db = Db::name('daydetail');
		$beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
		$endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
		$where_find['d_uid'] = $userid;
		$where_find['d_addtime'] = array('between',$beginThismonth.','.$endThismonth);
        $d_info = $detail_db->where($where_find)->select();
		$this->assign('d_info',$d_info);
		$this->assign('title','签到');
        return $this->fetch();
	}

	//签到处理
	public function signadd(){
	if(request()->isAjax()){
		$u_db = Db::name('user');
	    $userid =user_login();
	    $year = date('Y');
	    $moth = date('m');
	    $day  = intval(date('d'));
	    $qd_db = Db::name('daysign');
	    $f_where['uid']= $userid;
		$f_where['year']= $year;
		$f_where['moth']= $moth;
		$qd_info = $qd_db->where($f_where)->find();
		$num=10;
		if($qd_info){
		    //获取今天的开始时间
		    $day_startime = strtotime(date('Y-m-d'));
			if($qd_info['savetime']>$day_startime){
			   $re_info['status'] = 0;
			   $re_info['msg'] = '今日已签到过了';
			}else{
				$data['day'] =$qd_info['day'].','.$day;
				$data['savetime'] = time();
				$data['totalday'] =$qd_info['totalday']+1;
				$data['lian_day'] =$qd_info['lian_day']+1;
				// 给用户积分
				if($data['lian_day']%7==0){
					$num=40;
				}
				$data['total_jifen'] =$qd_info['total_jifen']+$num;
				  $u_db->where(array('userid'=>$userid))->setInc('sign_total',1);
				  $u_db->where(array('userid'=>$userid))->setInc('jf_daysign',1);
				$bool = $qd_db->where($f_where)->update($data);
				if($bool){
					
			  		$this->IntegralToUser($userid,$num);

					$content='连续签到'.$data['lian_day'].'天';
			  	    $this->add_qd_detial($userid,$num,$content);
				    $re_info['status'] = 1;
				    $re_info['qiandaomun'] = $data['lian_day'];
					$re_info['msg'] = '签到成功';
				}else{
				  	$re_info['status'] = 0;
					$re_info['msg'] = '未知错误';
				}
			}
		}else{
			  $data['uid'] =$userid;
			  $data['year'] =$year;
			  $data['moth'] =$moth;
			  $data['day'] =$day;
			  $data['totalday'] =1;
			  $data['lian_day'] =1;
			  $data['savetime'] =time();
			  $data['total_jifen'] =$num;
			  $u_db->where(array('userid'=>$userid))->setInc('sign_total',1);
	          $u_db->where(array('userid'=>$userid))->setInc('jf_daysign',$num);
			  $res = $qd_db->insert($data);
			  if($res){
			  	// 给用户积分
			  	$this->IntegralToUser($userid,$num);

			  	$content='连续签到1天';
			  	$this->add_qd_detial($userid,$num,$content);
			    $re_info['status'] = 1;
			    $re_info['qiandaomun'] = $data['lian_day'];
				$re_info['msg'] = '签到成功';
			  }else{
			  	$re_info['status'] = 0;
				$re_info['msg'] = '未知错误';
			  }
		}
	}else{
		$re_info['status'] = 0;
		$re_info['msg'] = '非法访问';
	}
	return $re_info;
	}


	public function add_qd_detial($uid,$money,$content){
	    $detail_db = Db::name('daydetail');
	    $data['d_uid']=$uid;
	    $data['d_addtime']=time();
	    $data['d_money']=$money;
	    $data['d_content']=$content;
	    $res = $detail_db->insert($data);
	    return $res;
	}

	//给用户积分
	private function IntegralToUser($uid,$num){
		$res=Db::name('user_wealth')->where('uid',$uid)->setInc('integral',$num);
		if($res){
			$detail=array();
            $detail['content']='签到奖励'.$num;
            $detail['from_type']=1; //1-转入 2-转出
            $detail['type']='children';
            $detail['type_name']='签到奖励';
            $detail['uid']=$uid;
            $detail['create_time']=time();
            $detail['status']=1;
            $detail['money']=$num;
            $detail['money_record']=Db::name('user_wealth')->where('uid',$uid)->value('integral');
            Db::name('integral_detail')->insert($detail); 
		}
	}

}
