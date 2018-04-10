<?php
namespace app\home\controller;
use think\Controller;
use think\Db;
class Wealth extends Common
{
    

    public function index(){
        $uid=user_login();
        $wealth=db('user_wealth')->where('uid',$uid)->find();
        //银行卡数量
        $count=db('user_bank')->where('uid',$uid)->count(1);
        $wealth['bank_count']=$count;

        //统计上一天新增积分
        $Yestoday_start=strtotime(date("Y-m-d",strtotime("-1 day")));
        $Yestoday_end=$Yestoday_start+86400;
        $where['from_type']=1;
        $where['create_time']=array('BETWEEN',array($Yestoday_start,$Yestoday_end));
        $lastdate_integral=Db::name('integral_detail')->where($where)->sum('money');

        $this->assign('lastdate_integral',$lastdate_integral);
        $this->assign('wealth',$wealth);
        return $this->fetch() ;
    }

    //充值
    public function recharge(){

    	if(request()->isAjax()){
    		
    		$pay_type=input('post.pay_type/d');
    		if($pay_type!=1 && $pay_type!=2){
    			error('操作失败');
    		}
            $money=input('post.money');
            if(empty($money)){
                error('请输入金额');
            }
            if(!preg_match('/^[1-9]\d*$/', $money)){
                error('请输入整数');
            }


    		$data['uid']=user_login();
    		$data['create_time']=time();
    		$data['status']=0;
            $data['money_record']=model('UserWealth')->getField('money');
            $data['money']=$money;
            $data['content']='充值'.$money;
            $data['from_type']=1; //1-转入 2-转出
    		//在线支付
    		if($pay_type==1){
                $data['type']='online';
    			$data['type_name']='在线充值';
                $data['order_no']=get_order_no('money_recharge','CZ'); //订单号
    		}
            if($pay_type==2){
                $bank_name=input('post.bank_name');
                $user_name=input('post.huming');
                $card_no=input('post.kahao');
                $img=input('post.img');
                if($money<100){
                    error('金额不能小于100元');
                }
                if(empty($bank_name)){
                    error('请选择转账银行');
                }
                if(empty($user_name)){
                    error('请填写户名');
                }
                if(empty($card_no)){
                    error('请填写卡号');
                }
                if(empty($img)){
                    error('请上传支付凭证');
                }
                $data['type']='underline';
                $data['type_name']='线下充值';
                $data['bank_name']=$bank_name;
                $data['user_name']=$user_name;
                $data['card_no']=$card_no;
                $data['img']=$img;
            }
            
            $user=session('user_login');
            $data['username']=$user['username'];
            $data['account']=$user['account'];
            $data['mobile']=$user['mobile'];
            $res=db('money_recharge')->insert($data);
            $id=db('money_recharge')->getLastInsID();
            if($res){
                if($pay_type==1)
                    success('',url('Pay/selectpay',array('id'=>$id,'order_no'=>$data['order_no'],'money'=>$money,'type'=>'cz')));
                else
                    success('提交成功，等待平台审核');
            }
            else{
                error('操作失败');
            }
    	}

        //公司收款账户
        $company_info=db('config')->where('id','in',[39,40,41])->order('id asc')->column('value','name');
        $this->assign('company_info',$company_info);
    	//银行卡号
    	$list=db('bank_name')->order('sort desc')->select();
    	$this->assign('list',$list);
        $this->assign('title','充值');
        //充值明细地址
    	$this->assign('head_datail_url',url('Wealth/rechargedatail'));
    	return $this->fetch() ;
    }

    //充值记录
    public function rechargedatail(){
        $where['uid']=user_login();
        $list=Db::name('money_recharge')->where($where)->order('id desc')->limit(500)->select();
        //状态名称
        $this->status_name();
        $this->assign('list',$list);
        $this->assign('title','充值记录');
        return $this->fetch() ;
    }

    //充值明细
    public function recdetail(){
        $id=input('id/d');
        if($id){
            $where['uid']=user_login();
            $where['id']=$id;
            $table=db('money_recharge');

            $info=$table->where($where)->find();
            //状态名称
            $this->status_name();
            $this->assign('info',$info);
            $this->assign('title','充值明细');
            return $this->fetch();
        }
    }


    //提现
    public function getmoney(){

        //保存
        if(request()->isAjax()){
            if(!is_check_user()){
                error('请先认证身份');
            }
            //默认银行卡
            $uid=user_login();
            $bank_info=db('user_bank')->where('uid',$uid)->where('is_default',1)->find();
            if(empty($bank_info)){
                $bank_info=db('user_bank')->where('uid',$uid)->order('id desc')->find();
            }
            if(empty($bank_info)){
                error('暂无收款账户，请添加收款银行卡');
            }   
            $post_data=input('post.');
            $validate=validate('Money');
            if(!$validate->check($post_data)){
                error($validate->getError());
            }

            $type=$post_data['type'];
            //扣除余额
            $money=$post_data['money'];
            if($type==1)
                $money_fee=20;  // 0.2%的税费     
            else
                $money_fee=20;  // 10%+7%+3%的税费   

            $fee=$money*$money_fee/100;
            $total=$money;

            // 启动事务
             Db::startTrans();
            //余额提现
            if($type==1){
                $user_money=model('UserWealth')->getField('money');
                if($user_money<$money){
                   error('余额不足');
                }
                if($user_money<$total){
                    error('余额不足扣除手续费,需手续费'.$fee);
                }
                $res=model('UserWealth')->where('uid',$uid)->setDec('money',$total);

            }else{ //宏宝提现
                $user_money=model('UserWealth')->getField('anzi');
                if($user_money<$money){
                   error('余额不足');
                }
                if($user_money<$total){
                    error('余额不足扣除手续费,需手续费'.$fee);
                }
                $res=model('UserWealth')->where('uid',$uid)->setDec('anzi',$total);
            }


            $uid=user_login();
            //添加明细
            if($res){
                $user=session('user_login');
                $add['type']        =   $type;
                $add['type_name']   =   $type==1 ? '现金提现':'宏宝提现';
                $add['uid']         =   $uid;
                $add['money']       =   $money;
                $add['fee']         =   $fee;
                $add['fee_time']    =   1;
                $add['status']      =   0;
                $add['create_time'] =   time();
                $add['bank_name']   =   $bank_info['bank_name'];
                $add['user_name']   =   $bank_info['user_name'];
                $add['card_no']     =   $bank_info['bank_no'];
                $add['bank_branch']     =   $bank_info['bank_branch'];
                $add['username']    =   $user['username'];
                $add['mobile']      =   $user['mobile'];
                $add['account']     =   $user['account'];
                $res=Db::name('money_get')->insert($add);
            }

            //现金明细
            if($type==1){
                $detail['content']='提现'.$money.',手续费'.$fee;
                $detail['from_type']=2; //1-转入 2-转出
                $detail['type']='getmoney';
                $detail['type_name']='提现';
                $detail['uid']=$uid;
                $detail['create_time']=time();
                $detail['status']=1;
                $detail['money']=$money;
                $detail['money_record']=$user_money-$money;
                $res=Db::name('money_detail')->insert($detail);
            }else{
                $detail['content']='提现'.$money.',手续费'.$fee;
                $detail['from_type']=2; //1-转入 2-转出
                $detail['type']='getmoney';
                $detail['type_name']='提现';
                $detail['uid']=$uid;
                $detail['create_time']=time();
                $detail['status']=1;
                $detail['money']=$money;
                $detail['money_record']=$user_money-$money;
                $res=Db::name('anzi_detail')->insert($detail);
            }

            if($res){
                // 提交事务
                Db::commit(); 
                del_check_sms();
                success('提现成功,等待审核');
            }
            else{
                // 回滚事务
                Db::rollback();
                error('操作失败');
            }
        }
        $uid=user_login();
        //默认银行卡
        $bank_no=db('user_bank')->where('uid',$uid)->where('is_default',1)->value('bank_no');
        if(empty($bank_no)){
            $bank_no=db('user_bank')->where('uid',$uid)->order('id desc')->value('bank_no');
        }
        if($bank_no)
            $this->assign('bank_no',substr($bank_no, -4));

        //提现限制
        $config=db('config')->where('id','in',[24,25])->column('name,value');
        $info=model('UserWealth')->where('uid',$uid)->field('money,anzi')->find();

        
        // $this->assign('fee_list',$fee_list);
        $this->assign('config',$config);
        $this->assign('info',$info);
        $this->assign('title','申请提现');
        //提现明细地址
        $this->assign('head_datail_url',url('Wealth/getmoneydatail'));

        return $this->fetch() ; 
    }

    //提现记录
    public function getmoneydatail(){
        $where['uid']=user_login();
        $list=Db::name('money_get')->where($where)->order('id desc')->limit(500)->select();
        //状态名称
        $this->status_name();
        $this->assign('list',$list);
        $this->assign('title','提现记录');
        return $this->fetch() ;
    }

    //提现明细
    public function getdetail(){
        $id=input('id/d');
        if($id){
            $where['uid']=user_login();
            $where['id']=$id;
            $table=db('money_get');

            $info=$table->where($where)->find();
            //状态名称
            $this->status_name();
            $this->assign('info',$info);
            $this->assign('title','提现明细');
            return $this->fetch();
        }
    }





    //明细记录
    public function detail(){
        $type=input('type/d');
        $from_type=input('f_type/d'); //状态
        if($type==0){
            $table=db('money_detail');
            $where['uid']=user_login();
            $where['from_type']=$from_type==0 ? array('in',array(1,2)):$from_type;
        }else if ($type==2) {
            $table=db('anzi_detail');
            $where['uid']=user_login();
            $where['from_type']=$from_type==0 ? array('in',array(1,2)):$from_type;
        }else if ($type==1) {
            $table=db('integral_detail');
            $where['uid']=user_login();
            $where['from_type']=$from_type==0 ? array('in',array(1,2)):$from_type;
        }

        $list=$table->where($where)->order('id desc')->limit(500)->select();
        //状态名称
        $this->status_name();
        $this->assign('list',$list);
        $this->assign('title','记录明细');
        // $this->assign('back_url',url('Wealth/index'));
        return $this->fetch();
    }

    private function status_name(){
        //状态名称
        $status_name=array(0=>'<span>交易中</span>',1=>'<span>已完成</span>',2=>'<span style="color:red" >不通过</span>');
        $this->assign('status_name',$status_name);
    }

    public function onedetail(){
        $id=input('id/d');
        $type=input('type/d');
        if($id){
            $where['uid']=user_login();
            $where['id']=$id;
            if($type==0)
                $table=db('money_detail');
            elseif ($type==1) {
                $table=db('integral_detail');
            }elseif ($type==2) {
                $table=db('anzi_detail');
            }

            $info=$table->where($where)->find();
            //状态名称
            $this->status_name();
            $this->assign('info',$info);
            $this->assign('title','明细');
            return $this->fetch();
        }
    }

    //我的钱包
    public function mywallet(){
        $this->assign('title','我的钱包');
        return $this->fetch();
    }

    //绑定银行卡
    public function bankcard(){

        $table=db('user_bank');
        $list=$table->where('uid',user_login())->select();
        $this->assign('list',$list);
        $this->assign('title','我的银行卡');
        return $this->fetch();
    }

     //添加银行卡
    public function addbankcard(){
        //保存
        if(request()->isAjax()){
            $post_data=input('post.');
            //+++验证数据++S+
            if(empty($post_data['bankname']))
                error('请选择开户银行');
            if(empty($post_data['username']))
                error('请填写开户名');
            if(empty($post_data['bankno']))
                error('请填写银行卡号');
            $bank_id=$post_data['bankname'];
            $bank_info=db('bank_name')->where('id',$bank_id)->where('status',1)->field('bank_name,bank_img')->find();
            if(empty($bank_info)){
                error('开户银行不存在');
            }
            //+++验证数据++E+
            $data=array();
            $data['uid']=user_login();
            $data['bank_name']=$bank_info['bank_name'];
            $data['bank_img']=$bank_info['bank_img'];
            $data['bank_no']=$post_data['bankno'];
            $data['bank_branch']=$post_data['bank_branch'];
            $data['user_name']=$post_data['username'];
            $data['is_default']=$post_data['default'];
            $table=db('user_bank');

            $res=$table->insert($data);
            $id=$table->getLastInsID();
            if($res){
                //修改默认
                $default=$post_data['default'];
                if($default==1){
                    $where=array();
                    $where['id']=array('neq',$id);
                    $where['is_default']=1;
                    $table->where($where)->setField('is_default',0);
                }
                success('保存成功',url('bankcard'));
            }else{
                error('保存失败');
            }
        }

        //银行卡
        $list=db('bank_name')->where('status',1)->order('sort desc')->select();
        $this->assign('list',$list);
        $this->assign('title','添加银行卡');
        return $this->fetch();
    }

    //删除银行卡
    public function deletebank(){
        $id=input('id/d');
        if($id){
            $where['id']=$id;
            $where['uid']=user_login();
            $res=db('user_bank')->where($where)->delete();
            if($res)
                 success('删除成功');
             else
                error('删除失败');
        }
    }




    public function setdefault(){
        $id=input('post.id/d');
        if($id){
            $table=db('user_bank');
            $where['id']=array('neq',$id);
            $where['is_default']=1;
            $table->where($where)->setField('is_default',0);
            $table->where('id',$id)->setField('is_default',1);
            return $id;
        }
    }



    //库存积分
    public function kucunintegral(){

        if(!check_seller()){
            error_alert('非商家用户');
        }

        $uid=user_login();
        $kucun_integral=db('user_wealth')->where('uid',$uid)->value('kucun_integral');
        $this->assign('kucun_integral',$kucun_integral);
        $this->assign('title','库存积分');
        //明细地址
        $this->assign('head_datail_url',url('Wealth/kucunintegraldetail'));
        return $this->fetch();
    }

     //购买库存积分
    public function buykucunintegral(){
        if(!check_seller()){
            error_alert('非商家用户');
        }
        $uid=user_login();
        $info=db('user_wealth')->where('uid',$uid)->field('money,anzi')->find();
        $this->assign('info',$info);

        $this->assign('title','购买库存积分');
        return $this->fetch();
    }

    //分发库存积分
    public function sellkucunintegral(){
        $uid=user_login();
        $kucun_integral=db('user_wealth')->where('uid',$uid)->value('kucun_integral');

        if(request()->isAjax()){
            $seller=Db::name('user')->where('userid',$uid)->value('seller');
            if(empty($seller) || $seller==0){
                error('非商家用户,不能分发');
            }

            $num=input('post.num');
            $mobile=input('post.mobile');
            $content=input('post.content');
            if($content){
                $content=','.$content;
            }
            if(empty($mobile)){
                error('请输入买家手机号');
            }
            if(!check_mobile($mobile)){
                error('手机号格式错误');
            }
            $info=Db::name('user')->where('mobile',$mobile)->field('userid,username,account,mobile')->find();
            if(empty($info)){
                error('买家不存在');
            }
            if(empty($num)){
                error('请输积分数量');
            }
            if(!preg_match('/^[1-9]\d*$/', $num)){
                error('请输入整数');
            }
            //单笔限额5W，每天限10单
            if($num>50000){
                error('消费金额不能大于5W');
            }
            $limit_where['uid']=$uid;
            $limit_where['from_type']=2;
            $limit_where['create_time']=array('BETWEEN',array(strtotime(date('Y-m-d')),strtotime(date('Y-m-d'))+86400));
            $count=Db::name('kucun_integral_detail')->where($limit_where)->count(1);
            if($count>=10){
               error('每天最多可分发10单'); 
            }

            
            $total=$num;
            $num=$num*100;

            //验证库存积分是否足够
            if($kucun_integral<$num){
                error('库存积分不足');
            }


            //扣除自己的库存积分
            $res=Db::name('user_wealth')->where('uid',$uid)->setDec('kucun_integral',$num);
            if(!$res){
                error('分发失败');
            }
            //给消费添加积分奖励
            $data=array();
            $data['integral']=array('exp','`integral` + '.$num);
            $data['total_integral']=array('exp','`total_integral` + '.$num);
            $res=Db::name('user_wealth')->where('uid',$info['userid'])->update($data);
            if(!$res){
                error('分发失败');
            }


            //添加库存积分明细
            $kucun_detail=array();
            $kucun_detail['content']='会员:'.$info['username'].' '.$info['mobile'].$content;
            $kucun_detail['from_type']=2; //1-转入 2-转出
            $kucun_detail['type']='sellkucunintegral';
            $kucun_detail['type_name']='分发库存积分';
            $kucun_detail['uid']=$uid;
            $kucun_detail['create_time']=time();
            $kucun_detail['status']=1;
            $kucun_detail['money']=$num;
            $kucun_detail['money_record']=$kucun_integral-$num;
            Db::name('kucun_integral_detail')->insert($kucun_detail);


            //添加积分明细
            $detail=array();
            $detail['content']='购买商品获得'.$num;
            $detail['from_type']=1; //1-转入 2-转出
            $detail['type']='buygood';
            $detail['type_name']='购买商品';
            $detail['uid']=$info['userid'];
            $detail['create_time']=time();
            $detail['status']=1;
            $detail['money']=$num;
            $detail['money_record']=Db::name('user_wealth')->where('uid',$info['userid'])->value('integral');
            Db::name('integral_detail')->insert($detail);

            //给商家上级、消费者上级奖励积分
            model('mall/UserPay')->Excintegralfenfa($info['userid'],$uid,$total);

            success('分发成功');
        }

        if(!check_seller()){
            error_alert('非商家用户');
        }

        $this->assign('kucun_integral',$kucun_integral);

        $this->assign('title','库存积分发布');
        return $this->fetch();
    }


    //保存库存积分
    public function savekucunintegral(){
        $uid=user_login();
        $num=input('post.num');
        $code=input('post.code/d');
        $safepwd=input('post.pwd');
        $paytype=input('post.paytype');

        if(!check_seller()){
            error('非商家用户');
        }

        if(empty($paytype) || !in_array($paytype, array(1,2))){
            error('请选择支付方式');
        }
        if(empty($num)){
            error('请输入购买金额');
        }
        if(!preg_match('/^[1-9]\d*$/', $num)){
            error('购买金额请输入整数');
        }
        
        if(empty($code)){
            error('请输入验证码');
        }
        if(empty($safepwd)){
            error('请输入安全密码');
        }

        if(!model('User')->checkSafePwd($safepwd)){
            error('安全密码错误或未设置');
        }

        //验证短信
        $mobile=model('User')->getField('mobile');
        if(!check_sms($code,$mobile)){
            error('验证码错误或已过期'); 
        }

        if($paytype==1){
            $money=$num;
            $old_money=Db::name('user_wealth')->where('uid',$uid)->value('money');
            if($old_money<$money){
                error('金额不足，至少需要'.$money);
            }
            $data['money']=array('exp','`money` - '.$money);
        }
        else{
            $old_anzi=Db::name('user_wealth')->where('uid',$uid)->value('anzi');
            $anzi=$num*100;
            if($old_anzi<$anzi){
                error('宏宝不足，至少需要'.$anzi);
            }
            $data['anzi']=array('exp','`anzi` - '.$anzi);
        }

        $total=$num*1350;
        $data['kucun_integral']=array('exp','`kucun_integral` + '.$total);
        $data['integral']=array('exp','`integral` + '.($num*100));
        $data['total_integral']=array('exp','`total_integral` + '.($num*100));
       
        $res=Db::name('user_wealth')->where('uid',$uid)->update($data);
        if($res){
            //金额明细
            if($paytype==1){
                $detail['content']='购买'.$total.'个库存积分';
                $detail['from_type']=2; //1-转入 2-转出
                $detail['type']='buykucunintegral';
                $detail['type_name']='购买库存积分';
                $detail['uid']=$uid;
                $detail['create_time']=time();
                $detail['status']=1;
                $detail['money']=$money;
                $detail['money_record']=$old_money-$money;
                $res=db('money_detail')->insert($detail);
            }else{ //宏宝明细
                $detail['content']='购买'.$total.'个库存积分';
                $detail['from_type']=2; //1-转入 2-转出
                $detail['type']='buykucunintegral';
                $detail['type_name']='购买库存积分';
                $detail['uid']=$uid;
                $detail['create_time']=time();
                $detail['status']=1;
                $detail['money']=$anzi;
                $detail['money_record']=$old_anzi-$anzi;
                Db::name('anzi_detail')->insert($detail);
            }

            //添加积分明细
            $data=array();
            $data['content']='购买库存积分';
            $data['from_type']=1; //1-转入 2-转出
            $data['type']='buykucunintegral';
            $data['type_name']='购买库存积分';
            $data['uid']=$uid;
            $data['create_time']=time();
            $data['status']=1;
            $data['money']=$num*100;
            $data['money_record']=Db::name('user_wealth')->where('uid',$uid)->value('integral');
            Db::name('integral_detail')->insert($data);

            //添加库存积分明细
            $kucun_detail['content']='购买'.$total.'个库存积分';
            $kucun_detail['from_type']=1; //1-转入 2-转出
            $kucun_detail['type']='buykucunintegral';
            $kucun_detail['type_name']='购买库存积分';
            $kucun_detail['uid']=$uid;
            $kucun_detail['create_time']=time();
            $kucun_detail['status']=1;
            $kucun_detail['money']=$total;
            $kucun_detail['money_record']=Db::name('user_wealth')->where('uid',$uid)->value('kucun_integral');
            Db::name('kucun_integral_detail')->insert($kucun_detail);

            success('购买成功');
        }else{
            error('购买失败');
        }
    }

    //库存积分明细
    public function kucunintegraldetail(){
        $uid=user_login();
        $from_type=input('f_type/d');
        $where['uid']=$uid;
        $where['from_type']=$from_type==0 ? array('in',array(1,2)):$from_type;
        $list=Db::name('kucun_integral_detail')->where($where)->order('id desc')->limit(500)->select();
        $this->assign('list',$list);
        $this->assign('title','库存积分明细');
        return $this->fetch();
    }

    public function kcdetail(){
        $id=input('id/d');
        $info=Db::name('kucun_integral_detail')->where('id',$id)->find();
        //状态名称
        $this->assign('info',$info);
        $this->assign('title','明细');
        return $this->fetch();
    }


    //优惠券
    public function coupon(){

        $uid=user_login();
        $total=Db::name('user_wealth')->where('uid',$uid)->value('coupon');
        //明细记录
        $from_type=input('f_type/d'); //状态
        $where['uid']=$uid;
        $where['from_type']=$from_type==0 ? array('in',array(1,2)):$from_type;
        $list=Db::name('coupon_detail')->where($where)->order('id desc')->limit(100)->select();
        $this->assign('list',$list);
        $this->assign('total',$total);
        $this->assign('title','我的购物券');
        return $this->fetch();
    }

    //申请额度调配
    public function updatesellnum(){

        $this->assign('title','积分分发额度');
        return $this->fetch();
    }

    //钱包存入
    public function getin(){

        $this->assign('title','钱包存入');
        return $this->fetch();
    }

    //钱包支取
    public function getout(){

        $this->assign('title','钱包支取');
        return $this->fetch();
    }


    //获取用户信息
    public function userinfo(){
        if(request()->isAjax()){
            $mobile=input('post.mobile');
            if(empty($mobile)){
                exit('请输入买家手机号');
            }
            if(!check_mobile($mobile)){
                exit('手机号格式错误');
            }
            $info=Db::name('user')->where('mobile',$mobile)->field('userid,username,account,mobile')->find();
            if(empty($info)){
                exit('买家不存在');
            }
            exit($info['username'].'  '.$info['account']);
        }
    }
}
