<?php
namespace app\home\controller;
use think\Controller;
class Userupdate extends Common
{
    public function index()
    {
        $level=model('User')->getField('level');
        $this->assign('level',$level);
        $this->assign('title','升级会员');
        return $this->fetch() ;
    }

    public function userupdate()
    {

        if(request()->isAjax()){
            $update_level=input('post.update_level/d');
            if($update_level!=1 && $update_level!=2){
                error('请选择用户等级');
            }

            $level_info=db('user_level')->field('level_name,level_fee,level')->select();
            $level_name_arr=array_column($level_info,null,'level');
            $level=model('User')->getField('level');
            if($level>=$update_level){
                error('您现在等级为'.$level_name_arr[$level]['level_name'].'，请选择高等级');
            }
            if($level==1 && $update_level==2){
                //如果是宏客，只需不差额
                $money=$level_name_arr[2]['level_fee']-$level_name_arr[1]['level_fee'];
            }else{
                $money=$level_name_arr[$update_level]['level_fee'];
            }
            if($money>0){
                $order_no           =   get_order_no('update_order','UD'); //订单号
                $data['uid']        =   user_login();
                $data['user_level'] =   $update_level;//升级等级
                $data['money']      =   $money;//升级金额
                $data['order_no']   =   $order_no;
                $data['create_time']=   time();
                $data['status']     =   0;
                $data['type_name']  =   '用户升级';
                $res=db('update_order')->insert($data);
                $id=db('update_order')->getLastInsID();
                if($res)
                    success('',url('Pay/selectpay',array('id'=>$id,'order_no'=>$order_no,'money'=>$money)));
                else
                    error('操作失败');
            }

        }

        //用户余额
        $money=model('UserWealth')->getField('money');

        $level=model('User')->getField('level');

        $list=db('user_level')->where('level','in',[1,2])->order('id asc')->select();
        $this->assign('list',$list);
        $this->assign('level',$level);
        $this->assign('money',$money);
        $this->assign('title','用户权益');
        return $this->fetch() ;
    }


    public function userright(){

        $this->assign('title','升级会员');
        return $this->fetch() ;
    }

    public function tocompany(){

        if(request()->isAjax()){

            $uid=user_login();
            $user=db('user');
            $info=$user->where('userid',$uid)->field('level,user_type')->find();
            if($info['user_type']!=0){
                error('非个人用户');
            }
            if($info['level']<1){
                error('只有宏客等级以上才能升级为企业用户');
            }

            $post_data=input('post.');
            if(!isset($post_data['companyname']) || empty($post_data['companyname'])){
                error('请输入公司名称');
            }
            if(!isset($post_data['companylicense']) || empty($post_data['companylicense'])){
                error('请输入营业执照号码');
            }
            if(!isset($post_data['companyorganize']) || empty($post_data['companyorganize'])){
                error('请选择组织机构类型');
            }
            $code=input('post.code/d');
            if(!isset($code) || empty($code)){
                error('请输入验证码');
            }
            //验证短信
            $mobile=model('User')->getField('mobile');
            if(!check_sms($code,$mobile)){
                error('验证码错误或已过期'); 
            }

            $data['company_name']=$post_data['companyname'];
            $data['company_license']=$post_data['companylicense'];
            $data['company_organize']=$post_data['companyorganize'];
            $data['user_type']=1;
            $data['idcard']='';
            
            $res=$user->where('userid',$uid)->update(array('user_type'=>1));
            $res=db('user_checkinfo')->where('uid',$uid)->update($data);
            if($res){
                success('操作成功',url('index/more'));
            }else{
                error('操作失败');
            }
        }

        if(user_type()!=0){
            error_alert('非个人用户');
        }
        $this->assign('title','个人转企业');
        return $this->fetch() ;
    }

}
