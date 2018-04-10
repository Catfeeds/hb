<?php
namespace app\home\controller;
use think\Controller;
use think\Db;
class Turntable extends Common{
    /**
     * 直推奖励 
     */
   public function index(){
        $this->assign('title','大转盘抽奖');
        $this->assign('info','');
        return $this->fetch();
    }

    public function detail(){
      $userid=user_login();
      $list=Db::name('nzbill')->where('bill_uid',$userid)->order('bill_id desc')->limit(500)->select();
      $this->assign('list',$list);
      $this->assign('title','中奖纪录');
      return $this->fetch();
    }

    /**
     * 转盘
     */
    public function turn(){
        if(!request()->isAjax()){
            return false;
        }

        $userid=user_login();
        $gailv=Db::name('turntable_lv')->order('id')->find();

        $prize_arr = array( 
            '0' => array( 'id'=>1, 'min'=>0,  'max'=>90,    'prize'=>'1000',  'name'=>'1000积分',  'v'=>$gailv['one']), 
            '1' => array( 'id'=>2, 'min'=>91, 'max'=>180,   'prize'=>'500',   'name'=>'500积分',   'v'=>$gailv['two']), 
            '2' => array( 'id'=>3, 'min'=>181, 'max'=>270,  'prize'=>'0',   'name'=>'谢谢参与',   'v'=>$gailv['three']), 
            '3' => array( 'id'=>4, 'min'=>271, 'max'=>360,  'prize'=>'200',  'name'=>'200积分',   'v'=>$gailv['four']), 
        );

        foreach ($prize_arr as $key => $val) { 
            $arr[$val['id']] = $val['v']; 
        } 
    
        $rid = $this->getRand($arr); //根据概率获取奖项id 
        $res = $prize_arr[$rid-1]; //中奖项 
        $bidb = Db::name('nzbill');

        $store=Db::name('user_wealth');

     
        $cangku_num=$store->where('uid',$userid)->value('integral');
        if($cangku_num<100){
            error('积分不足100，每抽奖一次需要100个积分');
        }

        //扣减积分
        if(!$store->where('uid',$userid)->setDec('integral',100)){
            error('抽奖失败');
        }

        $detail=array();
        $detail['content']='抽奖扣除100';
        $detail['from_type']=2; //1-转入 2-转出
        $detail['type']='zp';
        $detail['type_name']='转盘抽奖';
        $detail['uid']=$userid;
        $detail['create_time']=time();
        $detail['status']=1;
        $detail['money']=100;
        $detail['money_record']=$cangku_num-100;
        Db::name('integral_detail')->insert($detail); 

      

      // 给用户添加记录
      $num=$res['prize'];
      $id=$res['id'];
      if($num>0){
        //抽中宏宝
        // if($id==1){
        //   $data=array();
        //   $data['anzi']=array('exp','`anzi` + '.$num);
        //   $data['total_anzi']=array('exp','`total_anzi` + '.$num);
        //   if($store->where('uid',$userid)->update($data)){
        //     $detail=array();
        //     $detail['content']='抽奖获得'.$num;
        //     $detail['from_type']=1; //1-转入 2-转出
        //     $detail['type']='zp';
        //     $detail['type_name']='转盘抽奖';
        //     $detail['uid']=$userid;
        //     $detail['create_time']=time();
        //     $detail['status']=1;
        //     $detail['money']=$num;
        //     $detail['money_record']=$store->where('uid',$userid)->value('anzi');
        //     Db::name('anzi_detail')->insert($detail); 
        //   }
        // }

       // if($id==2 || $id==4){
          $data=array();
          $data['integral']=array('exp','`integral` + '.$num);
          $data['total_integral']=array('exp','`total_integral` + '.$num);
          if($store->where('uid',$userid)->update($data)){
            $detail=array();
            $detail['content']='抽奖获得'.$num;
            $detail['from_type']=1; //1-转入 2-转出
            $detail['type']='zp';
            $detail['type_name']='转盘抽奖';
            $detail['uid']=$userid;
            $detail['create_time']=time();
            $detail['status']=1;
            $detail['money']=$num;
            $detail['money_record']=$store->where('uid',$userid)->value('integral');
            Db::name('integral_detail')->insert($detail); 
          }
       // }
        
      }

      $u_info=session('user_login');
      $data=array();
      $data['bill_uid']=$userid;
      $data['bill_num']=$num;
      $data['bill_name']=$res['name'];
      $data['bill_reason']='转盘抽奖,'.$res['name'];
      $data['bill_time']=time();
      $data['bill_type']=1;
      $data['bill_username']=$u_info['username'];
      $data['bill_account']=$u_info['account'];
      $add_res = $bidb->insert($data);//获得记录
      if(!$add_res){
         error('抽奖失败');
      }

      $min = $res['min']; 
      $max = $res['max']; 
      $result['angle'] = mt_rand($min,$max); //随机生成一个角度 
      $result['prize'] = $res['prize']; 
      $result['prize_name'] = $res['name']; 
      success($result);
    }

    // 抽奖转盘
    private function getRand($proArr) { 
        $result = ''; 
        //概率数组的总概率精度 
        $proSum = array_sum($proArr); 
        //概率数组循环 
        foreach ($proArr as $key => $proCur) { 
          $randNum = mt_rand(1, $proSum); 
          if ($randNum <= $proCur) { 
            $result = $key; 
            break; 
          } else { 
            $proSum -= $proCur; 
          } 
        } 
        unset ($proArr); 
        return $result; 
    }
}