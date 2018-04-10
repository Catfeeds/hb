<?php
namespace app\home\controller;
use think\Controller;
use think\Db;
class Userinfo extends Common
{
    public function index()
    {
        $uid=user_login();
        $checkinfo=db('user_checkinfo')->where('uid',$uid)->find();
        $this->assign('checkinfo',$checkinfo);

        $user_type=model('User')->getField('user_type');
        
        $this->assign('user_type',$user_type);
    	$this->assign('title','认证中心');
        return $this->fetch() ;
    }

    //认证手机 
    public function checkmobile()
    {
        //进行验证
        if(request()->isAjax()){
            $code=input('post.code/d');
            if(!isset($code) || empty($code)){
                error('请输入验证码');
            }
            //验证短信
            $mobile=model('User')->getField('mobile');
            if(!check_sms($code,$mobile)){
                error('验证码错误或已过期'); 
            }
            $uid=user_login();
            if(db('user_checkinfo')->where('uid',$uid)->update(array('is_check_mobile'=>1))){
                 //清除短信session
                del_check_sms();
                success('认证成功');
            }else{
                error('认证失败');
            }
        }

        $uid=user_login();
        $is_check_mobile=db('user_checkinfo')->where('uid',$uid)->value('is_check_mobile');

        $this->assign('is_check_mobile',$is_check_mobile);
    	$this->assign('title','手机验证');
        return $this->fetch() ;
    }


    //个人认证
    public function userinfo()
    {
        $uid=user_login();
        $info=db('user_checkinfo')->where('uid',$uid)->find();
        if($info['user_type'] ==1){
            error_alert('非个人用户');
        }
        if($info['is_check_mobile'] !=1){
            error_alert('请先认证手机号码');
        }
        $info['username']=db('user')->where('userid',$uid)->value('username');
        if($info['province'] && $info['city'])
            $info['area']=$info['province'].' '.$info['city'].' '.$info['district'];

        //客服电话
        $tel=Db::name('config')->where('id=9')->value('value');

        $this->assign('tel',$tel);
        $this->assign('info',$info);
    	$this->assign('title','个人认证');
        return $this->fetch() ;
    }

    //个人认证
    public function checkuser()
    {
        if(request()->isAjax()){

            $uid=user_login();
            $info=db('user_checkinfo')->where('uid',$uid)->find();

            if($info['is_check_mobile'] !=1){
                error('请先认证手机号码');
            }
            if($info['user_type'] ==1){
                error('非个人用户');
            }
            if($info['is_check_user']==1 || $info['is_check_user']==2){
                error('不可认证');
            }

            $postdata=input('post.');
            // if(empty($postdata['shop_name'])){
            //     error('请输入店铺名称');
            // }
            if(empty($postdata['username'])){
                error('请填写姓名');
            }
            if(empty($postdata['idcard'])){
                error('请填写身份证');
            }
            if(empty($postdata['idcar_startdate']) || empty($postdata['idcar_endtdate'])){
                error('请选择证件有效期');
            }
            if(empty($postdata['area'])){
                error('请选择所在区域');
            }
            if($postdata['idcard_type']==0 && !check_id_card($postdata['idcard'])){
               error('身份证号格式错误'); 
            }

            $uid=user_login();
            db('user')->where('userid',$uid)->update(array('username'=>$postdata['username']));
            $data=array();
            $str=$postdata['area'];
            $area=explode(' ', $str);
            // $data['shop_name']      =   $postdata['shop_name'];
            $data['country']        =   '中国';
            $data['province']       =   $area[0];
            $data['city']           =   $area[1];
            $data['district']       =   $area[2];
            $data['idcard']         =   $postdata['idcard'];
            $data['idcar_startdate']=   $postdata['idcar_startdate'];
            $data['idcar_endtdate'] =   $postdata['idcar_endtdate'];
            $data['idcard_type']    =   $postdata['idcard_type'];

            $res=db('user_checkinfo')->where('uid',$uid)->update($data);
            if($res!==false){
                success('操作成功',url('checkidcard'));
            }else{
                error('操作失败');
            }
        }

        $uid=user_login();
        $info=db('user_checkinfo')->where('uid',$uid)->find();
        $info['username']=db('user')->where('userid',$uid)->value('username');
        if($info['province'] && $info['city'])
            $info['area']=$info['province'].' '.$info['city'].' '.$info['district'];

        $this->assign('info',$info);
        $this->assign('title','个人认证');
        return $this->fetch() ;
    }

    public function checkidcard(){
        if(request()->isAjax()){
            $uid=user_login();
            $info=db('user_checkinfo')->where('uid',$uid)->find();

            if($info['is_check_mobile'] !=1){
                error('请先认证手机号码');
            }
            if($info['user_type'] ==1){
                error('非个人用户');
            }
            if($info['is_check_user']==1 || $info['is_check_user']==2){
                error('不可认证');
            }
            
            if(empty($info['idcard'])){
                error('请先填写个人信息');
            }
            $postdata=input('post.');
            foreach ($postdata as $key => $value) {
                if(empty($value)){
                    error('请上传所有图片');
                }
            }
            $data['idcard_img_face']=$postdata['face'];
            $data['idcard_img_back']=$postdata['back'];
            $data['idcard_img_hand']=$postdata['hand'];
            $data['is_check_user']  =1;
            $data['create_time']    =   time();
            $res=db('user_checkinfo')->where('uid',$uid)->update($data);
            if($res){
                success('提交成功,我们会在7个工作日内完成审核，请留意您的信息');
            }else{
                error('提交失败');
            }
        }
        return $this->fetch();
    }


    //企业认证
    public function checkcompany()
    {
        $uid=user_login();
        $info=db('user_checkinfo')->where('uid',$uid)->find();
        if($info['is_check_mobile'] !=1){
            error_alert('请先认证手机号码');
        }
        if($info['province'] && $info['city'])
            $info['area']=$info['province'].' '.$info['city'].' '.$info['district'];
        
        if(empty($info['credit_no']) && !empty($info['company_license'])){
            $info['credit_no']=$info['company_license'];
        }

        $this->assign('info',$info);
        $this->assign('title','企业认证');
        return $this->fetch() ;
    }

    public function savecheckcompany(){
        if(!request()->isAjax()){
            exit();
        }

        $uid=user_login();
        $table=db('user_checkinfo');
        $info=$table->where('uid',$uid)->find();
        if($info['is_check_mobile'] !=1){
            error('请先认证手机号码');
        }
        if($info['user_type'] !=1){
            error('非个人用户');
        }

        $level=db('user')->where('userid',$uid)->value('level');
        if($level<1){
            error('只有宏客等级以上才能进行企业认证');
        }

        if($info['is_check_company']==1 || $info['is_check_company']==2){
            error('不可认证');
        }
        $post_data=input('post.');
        // if(empty($post_data['shop_name'])){
        //     error('请输入店铺名称');
        // }
        if(empty($post_data['companyname'])){
            error('请输入公司名称');
        }
        if(empty($post_data['credit'])){
            error('请输入社会信用代码');
        }
        if(empty($post_data['isthree']) && empty($post_data['tax'])){
            error('请输入税务登记证');
        }
        if(empty($post_data['isthree']) && empty($post_data['organize'])){
            error('请输入组织机构证');
        }
        if(empty($post_data['legal'])){
            error('请输入法人姓名');
        }
        if(empty($post_data['companytype'])){
            error('请选择公司类型');
        }
        if(empty($post_data['area'])){
            error('请选择所在区域');
        }
        if($post_data['islegal']==1 && empty($post_data['manageparent'])){
            error('请输入经营负责人');
        }

        $data=array();
        $str=$post_data['area'];
        $area=explode(' ', $str);
        // $data['shop_name']          =   $post_data['shop_name'];
        $data['country']            =   '中国';
        $data['province']           =   $area[0];
        $data['city']               =   $area[1];
        $data['district']           =   $area[2];
        $data['company_name']       =   $post_data['companyname'];
        $data['is_three_card']      =   $post_data['isthree'];
        $data['is_child_company']   =   $post_data['ischild'];
        $data['credit_no']          =   $post_data['credit'];
        $data['tax_no']             =   $post_data['tax'];
        $data['organize_no']        =   $post_data['organize'];
        $data['legal_name']         =   $post_data['legal'];
        $data['company_type']       =   $post_data['companytype'];
        $data['is_legal']           =   $post_data['islegal'];
        $data['manage_parent']      =   $post_data['islegal']==1 ? $post_data['manageparent']:$post_data['legal'];

        db('user')->where('userid',$uid)->update(array('username'=>$data['company_name']));
        $res=$table->where('uid',$uid)->update($data);
        if($res!==false){
            success('提交成功',url('checkcompanycard'));
        }else{
            error('提交失败');
        }

    }

    public function checkcompanycard(){
        if(request()->isAjax()){
            $uid=user_login();
            $table=db('user_checkinfo');
            $info=$table->where('uid',$uid)->find();

            if($info['is_check_mobile'] !=1){
                error('请先认证手机号码');
            }
            if($info['user_type'] !=1){
                error('非企业用户');
            }
            if($info['is_check_company']==1 || $info['is_check_company']==2){
                error('不可认证');
            }
            
            if(empty($info['legal_name'])){
                error('请先填写企业信息');
            }
            $postdata=input('post.');
            foreach ($postdata as $key => $value) {
                if(empty($value)){
                    error('请上传所有图片');
                }
            }
            $data['idcard_img_face']=$postdata['face'];
            $data['idcard_img_back']=$postdata['back'];
            $data['idcard_img_hand']=$postdata['hand'];
            $data['company_license_img']=$postdata['license'];
            $data['is_check_company']  =1;
            $data['create_time']    =   time();
            $res=$table->where('uid',$uid)->update($data);
            if($res){
                success('提交成功,我们会在7个工作日内完成审核，请留意您的信息');
            }else{
                error('提交失败');
            }
        }

        //客服电话
        $tel=Db::name('config')->where('id=9')->value('value');
        $this->assign('tel',$tel);

        return $this->fetch();
    }


    //联盟商家
    public function alliancebusiness(){

       $this->assign('title','联盟商家');
       return $this->fetch();  
    }

    //填写联系人
    public function contactinfo(){

        
       $this->assign('title','联盟商家');
       return $this->fetch(); 
    }
    
}
