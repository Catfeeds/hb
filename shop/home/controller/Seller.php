<?php
namespace app\home\controller;
use think\Controller;
use think\Db;
class Seller extends Common
{
    
    //联盟商家
    public function alliancebusiness(){
        //是否商家
        $userid=user_login();
        $u_where['userid']=$userid;
        $u_where['seller']=array('gt',0);
        $count=Db::name('user')->where($u_where)->count(1);
        if($count>0){
            $url="http://".$_SERVER['HTTP_HOST'].'/seller';
            $this->assign('msg','申请通过，商家登录地址'.$url);
        }

       $this->assign('title','联盟商家');
       return $this->fetch();  
    }

    //判断是否为宏客、宏投，否则不能认证
    private function ishightuser(){
        $userid=user_login();
        $where['userid']=$userid;
        $info=Db::name('user')->where($where)->field('level,seller,user_type')->find();
        if($info['user_type']<=0){
            if(request()->isAjax()){
                error('个人用户不能申请商家');
            }
            error_alert('个人用户不能申请商家');
        }
        if($info['level']<=0){
            if(request()->isAjax()){
                error('先升级为宏客或宏投才能申请商家');
            }
            error_alert('先升级为宏客或宏投才能申请商家');
        }

        //人个人身份才能申请
        if(!is_check_user()){
            if(request()->isAjax()){
                error('请先去认证身份');
            }
            error_alert('请先去认证身份');
        }

        //是否商家
        if($info['seller']==1){
            if(request()->isAjax()){
                error('您已是商家，请不要重复申请');
            }
            error_alert('您已是商家，请不要重复申请');
        }

        return true;

    }


    //填写联系人
    public function contactinfo(){
        session('contact_info',null);
        //验证身份
        $this->ishightuser();
        if(request()->isAjax()){
            
            $contact_name=input('post.contact_name');
            $contact_mobile=input('post.contact_mobile');
            $contact_email=input('post.contact_email');
            if(empty($contact_name)){
                error('请输入姓名');
            }
            if(empty($contact_mobile)){
                error('请输入姓名');
            }
            if(!check_mobile($contact_mobile)){
                error('手机号码格式错误');
            }
            if(empty($contact_email)){
                error('请输入邮箱');
            }
            if(!check_email($contact_email)){
                error('邮箱格式错误');
            }
            $data['con_name']=$contact_name;
            $data['con_mobile']=$contact_mobile;
            $data['con_email']=$contact_email;
            session('contact_info',$data);
            success('',url('shopinfo'));
            
        }
        
       $this->assign('title','商家入驻联系人信息');
       return $this->fetch(); 
    }

    //设置店铺信息
    public function shopinfo(){
        //验证身份
        $this->ishightuser();

        if(request()->isAjax()){

            $uid=user_login();
            //是否申请
            $s_where['uid']=$uid;
            $s_where['status']=0;
            $count=Db::name('seller_apply')->where($s_where)->count(1);
            if($count>0){
               error('你已经提交过申请了，请耐心等待平台审核'); 
            }

            $s_name=input('post.s_name');
            $fz_name=input('post.fz_name');
            $fz_mobile=input('post.fz_mobile');
            $fz_email=input('post.fz_email');
            $addresss=input('post.addresss');
            $addresss_detail=input('post.addresss_detail');
            $industry_name=input('post.industry_name');
            $fee=8;//input('post.fee');

            $data=session('contact_info');
            if(empty($data)){
                success('请填写联系人信息',url('contactinfo'));
            }

            if(empty($s_name))
                error('请填写店铺名称');
            if(empty($fz_name))
                error('请填写负责人姓名');
            if(empty($fz_mobile))
                error('请填写负责人手机');
            if(empty($fz_email))
                error('请填写负责人邮箱');
            if(empty($addresss))
                error('请填写店铺所在地');
            if(empty($addresss_detail))
                error('请填写店铺详细地址');
            if(empty($industry_name))
                error('请填写所属行业');
            if(empty($fee))
                error('请填写服务费系数');
            if(!check_mobile($fz_mobile)){
                error('手机号码格式错误');
            }
            if(!check_email($fz_email)){
                error('邮箱格式错误');
            }
            $user=session('user_login');

            $data['shop_name']=$s_name;
            $data['respon_name']=$fz_name;
            $data['respon_mobile']=$fz_mobile;
            $data['respon_email']=$fz_email;
            $addresss=explode(' ', $addresss);
            $data['province']=$addresss[0];
            $data['city']=$addresss[1];
            $data['district']=$addresss[2];
            $data['addresss_detail']=$addresss_detail;
            $data['industry_id']=$industry_name;
            $data['status']=0;
            $data['create_time']=time();
            $data['uid']=$uid;
            $data['username']=$user['username'];
            $data['account']=$user['account'];
            $data['mobile']=$user['mobile'];
            $data['fee']=$fee;
            $data['industry_name']=Db::name('industry')->where('id',$industry_name)->value('name');
            $res=Db::name('seller_apply')->insert($data);
            if($res){
                success('提交成功，等待平台审核',url('Index/index'));
            }else{
                error('提交失败');
            }

        }




        //主营大累信息
        $list=Db::name('industry')->where('is_show',1)->where('pid',0)->field('name,id')->limit('sort_order desc')->select();
        
        $this->assign('list',$list);
       $this->assign('title','设置店铺信息');
       return $this->fetch(); 
    }
    
}
