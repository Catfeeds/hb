<?php
namespace app\home\controller;
use think\Controller;
class Usercenter extends Common
{
    public function manageuser()
    {
        $userid=user_login();
        $user=db('user');
        $pid=$user->where('userid',$userid)->value('pid');

        //获取下级人数
        // $where['path']=array('like','%-'.$userid.'-%');
        $where['pid']=$userid;
        $user_count=$user->field('count(userid) as num,level')->where($where)->group('level')->order('level')->select();
        $level_count=array_column($user_count,'num','level');
        $this->assign('pid',$pid);
        $this->assign('level_count',$level_count);
    	$this->assign('title','用户管理');
        return $this->fetch() ;
    }

    //我的分享人、我的上级
    public function parent()
    {
        $userid=user_login();
        $user=db('user');
        $pid=$user->where('userid',$userid)->value('pid');
        $info=$user->field('username,account,mobile,email')->where('userid',$pid)->find();
        $this->assign('info',$info);
    	$this->assign('title','我的分享人');
        return $this->fetch() ;
    }

    //我的下级
    public function children()
    {
        $level=input('level/d');
        if($level==0 || $level==1 || $level==2 || $level==3){
            $where['level']=$level;
            $where['pid']=user_login();
            $list=db('user')->field('userid,username,account,mobile,email,reg_date')->where($where)->select();
            $this->assign('list',$list);
            $title=db('user_level')->where('level',$level)->value('level_name');
            $this->assign('title',$title);
            return $this->fetch() ;
        }
    	
    }


    //设置
    public function userdata(){
        $safety_pwd=model('User')->getField('safety_pwd');
        $this->assign('safety_pwd',$safety_pwd);
        $this->assign('title','设置');
        return $this->fetch();
    }


    //个人信息
    public function usermessage(){
        $userid=user_login();
        //保存
        if(request()->isAjax()){
            $data=input('post.');
            
            if(isset($data['email']) && !empty($data['email'])){
                if(!check_email($data['email'])){
                    error('邮箱格式错误');
                }
                db('user')->where('userid',$userid)->update(array('email'=>$data['email']));
                success('操作成功');
            }
            if(isset($data['head_img']) && !empty($data['head_img'])){
                db('user')->where('userid',$userid)->update(array('head_img'=>$data['head_img']));
                success('操作成功');
            }

        }


        $info=db('user')->field('username,account,head_img,email,mobile,reg_date,user_type')->where('userid',$userid)->find();
        $this->assign('info',$info);
        $this->assign('title','个人信息');
        return $this->fetch();
    }


    //修改密码
    public function updatepassword(){
        //保存
        if(request()->isAjax()){
            $old_pwd=input('post.old_pwd');
            $new_pwd=input('post.new_pwd');
            $rep_pwd=input('post.rep_pwd');
            if(!isset($old_pwd) || empty($old_pwd))
                error('请输入旧密码');
            if(!isset($new_pwd) || empty($new_pwd))
                error('请输入新密码');
            if(!isset($rep_pwd) || empty($rep_pwd))
                error('请输入确认密码');
            if($rep_pwd!=$new_pwd)
                error('两次输入密码不一致');
            if(!check_pwd($new_pwd)){
                error('密码只能为6-20位数字或字母');
            }

            $userid=user_login();
            $user=model('User');
            //验证登录密码
            if(!$user->checkLoginPwd($old_pwd)){
                error('旧密码输入错误');
            }

            //密码加密
            $salt= substr(md5(time()),0,3);
            $data['login_pwd']=$user->pwdMd5($new_pwd,$salt);
            $data['login_salt']=$salt;
            $where['userid']=$userid;
            if($user->save($data,$where)){
                success('操作成功');
            }else{
                error('操作失败');
            }
            
        }
        $this->assign('title','修改密码');
        return $this->fetch();
    }

    //安全密码
    public function safepassword(){
        //保存
        if(request()->isAjax()){
            $old_pwd=input('post.old_safepwd');
            $new_pwd=input('post.new_safepwd');
            $rep_pwd=input('post.rep_safepwd');

            if(!isset($old_pwd) || empty($old_pwd))
                error('请输入旧密码');
            if(!isset($new_pwd) || empty($new_pwd))
                error('请输入新密码');
            if(!isset($rep_pwd) || empty($rep_pwd))
                error('请输入确认密码');
            if($rep_pwd!=$new_pwd)
                error('两次输入密码不一致');
            if(!check_pwd($new_pwd)){
                error('密码只能为6-20位数字或字母');
            }
            $userid=user_login();
            $user=model('User');
            //验证登录密码
            if(!$user->checkSafePwd($old_pwd)){
                error('旧密码输入错误');
            }

            //密码加密
            $salt= substr(md5(time()),0,3);
            $data['safety_pwd']=$user->pwdMd5($new_pwd,$salt);
            $data['safety_salt']=$salt;
            $where['userid']=$userid;
            if($user->save($data,$where)){
                success('操作成功');
            }else{
                error('操作失败');
            }
            
        }

        $this->assign('title','安全密码');
        return $this->fetch();
    }

    //找回安全密码
    public function updatesafepassword(){

        //保存
        if(request()->isAjax()){
            $code=input('post.code');
            $new_pwd=input('post.new_safepwd');
            $rep_pwd=input('post.rep_safepwd');
            if(!isset($code) || empty($code))
                error('请输入验证码');
            if(!isset($new_pwd) || empty($new_pwd))
                error('请输入新密码');
            if(!isset($rep_pwd) || empty($rep_pwd))
                error('请输入确认密码');
            if($rep_pwd!=$new_pwd)
                error('两次输入密码不一致');
            if(!check_pwd($new_pwd)){
                error('密码只能为6-20位数字或字母');
            }

            $userid=user_login();
            $user=model('User');
            //验证短信
            $mobile=$user->getField('mobile');
            if(!check_sms($code,$mobile)){
                error('验证码错误或已过期'); 
            }

            //密码加密
            $salt= substr(md5(time()),0,3);
            $data['safety_pwd']=$user->pwdMd5($new_pwd,$salt);
            $data['safety_salt']=$salt;
            $where['userid']=$userid;
            if($user->save($data,$where)){
                //清除短信session
                del_check_sms();
                success('操作成功');
            }else{
                error('操作失败');
            }
        }

        $this->assign('title','安全密码');
        return $this->fetch();
    }

    //用户反馈
    public function feedback(){
        $this->assign('title','用户反馈');    
        return $this->fetch();
    }
    //提交用户反馈
    public function addfeedback(){
        $u_info=session('user_login');
        $biao=db('user_advice');
        $data=input('post.');
        $data['userid']=$u_info['userid'];
        $data['create_time']=time();
        $data['account']=$u_info['account'];
        $data['username']=$u_info['username'];
        $data['mobile']=$u_info['mobile']; 

        if(empty($data['title'])){
            error('标题不能为空');
        }

        if(empty($data['content'])){
            error('内容不能为空');
        }

        $yes=$biao->insert($data);      
        if($yes===false){
            error('提交失败');
        }else{
            success('提交成功');
        }
    }

    //关于我们
    public function aboutus(){
        $uss=model('article')->find_article(4);
        $this->assign('uss',$uss);
        $this->assign('title','关于我们');
        return $this->fetch();
    }

    //帮助中心
    public  function helpcenter(){
        //点击获取对应id下的帮助
        $pid=input('new_ids');
        $tit = model('News')->all_news_son($pid); 
        $this->assign('tit',$tit);

        //取栏目名称
        $help_son=model('Menu')->all_news_son(6);
        $this->assign('help_son',$help_son);


        $this->assign('title','帮助中心');
        return $this->fetch();   
    }

    //帮助明细//跟新闻页面一样//没有用到
    public  function helpdetail(){
        $this->assign('title','帮助中心');
        return $this->fetch();   
    }
    
}
