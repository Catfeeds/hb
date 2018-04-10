<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Db;
/**
 * 管理员控制器
 * 
 */
class User extends Base
{
   /**
     * 用户列表
     * 
     */
    public function index()
    {

        // 搜索
        $keyword    = input('keyword', '', 'string');
        $querytype  = input('querytype','account','string');
        $level     = input('level');
        if($keyword){
            $condition = array('like', '%' . $keyword . '%');
            $map[$querytype] = $condition;
        }
        
        //按日期搜索
        $date=date_query('reg_date');
        if($date){
            $where=$date;
            if(isset($map))
                $map=array_merge($map,$where);
            else
                $map=$where;
        }

        if($level!=''){
             $map['a.level']=$level;
        }

        // 获取所有用户
        $user   = db('user a');
        if(!isset($map)){
            $map=true;
        }

        //分页
        $table=$user;
        $data_list     = $table
            ->join(config('prefix').'user_wealth b','a.userid = b.uid','LEFT')
            ->field('a.userid,a.username,a.email,a.account,a.mobile,a.reg_date,a.status,a.pid,a.level,a.user_type,b.money,b.integral,b.anzi')
            ->where($map)
            ->order('a.userid desc')
            ->paginate(10,false,['query'=>request()->param()]);

        $total_count=$data_list->total();

        $this->assign('list',$data_list);
        $page=$data_list->render();
        
        $this->assign('table_data_page',$page);
        return $this->fetch();
    }
    

    /**
     * 新增用户
     * 
     */
    public function add()
    {
        if (request()->isAjax()) {

            $user_object = model('Admin');
            $data        = input('post.');
            //验证数据
            $validate = validate('Admin');
            if(!$validate->scene('add')->check($data)){
                error($validate->getError());
            }
             // 密码为空表示不修改密码
            unset($data['repassword']);
            if(!$_POST['password'])
                unset($data['password']);
            else{
                $data['password']=user_md5($data['password']);
            }
            if ($data) {
                $data['create_time']=time();
                $data['status']=1;
                $id = $user_object->insert($data);
                if ($id) {
                    success('新增成功', url('index'));
                } else {
                    error('新增失败');
                }
            } else {
                error('新增失败');
            }
        } else {
                $role=model('Group')->where(array('status'=>array('neq',-1),'id'=>array('neq',1)))->field('id,title')->order('id')->select();
                $this->assign('role',$role);
                return $this->fetch('edit');
        }
    }

    /**
     * 编辑用户
     * 
     */
     public function edit()
    {
        if (request()->isAjax()) {
            $data=input();
            if(empty($data['login_pwd'])){
                unset($data['relogin_pwd']);
                unset($data['login_pwd']);
            }
            if(empty($data['safety_pwd'])){
                unset($data['resafety_pwd']);
                unset($data['safety_pwd']);
            }

            //验证数据
            $validate = validate('home/User');
            if(!$validate->scene('edit')->check($data)){
                error($validate->getError());
            }

            $user_object = model('home/User');

            if(!empty($data['login_pwd'])){
               $salt= substr(md5(time()),0,3);
               $data['login_pwd']=$user_object->pwdMd5($data['login_pwd'],$salt);
               $data['login_salt']=$salt;
            }
    
            if(!empty($data['safety_pwd'])){
               $salt= substr(md5(time()),0,3);
               $data['safety_pwd']=$user_object->pwdMd5($data['safety_pwd'],$salt);
               $data['safety_salt']=$salt;
            }

            unset($data['relogin_pwd']);
            unset($data['resafety_pwd']);

            $result = $user_object
                ->field('userid,account,username,mobile,email,safety_pwd,safety_salt,login_pwd,login_salt')
                ->update($data);
            if ($result) {
                success('更新成功');
            } else {
                error('更新失败');
            }
            
        } else {
            $id=input('id/d');
            // 获取账号信息
            $info = Db::name('user')->find($id);
            $parent=Db::name('user')->where('userid',$info['pid'])->value('account');
            $info['parent']=$parent ? $parent :'无';

            //认证信息
            $check_info=Db::name('user_checkinfo')->where('uid',$id)->find();

            $this->assign('check_info',$check_info);
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 设置一条或者多条数据的状态
     * 
     */
    public function setStatus($model = 'user', $script = false)
    {
        parent::setStatus($model);
    }


    //用户登录
    public function userlogin(){
        $userid=input('userid',0,'intval');
        $user=model('Home/User');
        $info=$user->find($userid);
        if(empty($info)){
            return false;
        }
        $login_id=$user->auto_login($info);
        if($login_id){
            session('in_time',time());
            session('login_from_admin','admin');
            $this->redirect('Home/Index/index');
        }
    }


    /**
     * 编辑财富
     * 
     */
    public function AddFruits()
    {
        if (request()->isAjax()) {
            $uid=input('post.uid/d');
            $field=input('field');
            $type=input('type');
            $num=input('post.num');
            if(empty($num)){
                error('请输入一个数值');
            }
            if($type=='add'){

                $res=Db::name('user_wealth')->where('uid',$uid)->setInc($field,$num);
                if($res){

                    $old_num=Db::name('user_wealth')->where('uid',$uid)->value('money');
                    if($field=='money'){
                        $data['uid']=$uid;
                        $data['create_time']=time();
                        $data['status']=1;
                        $data['money_record']=$old_num;
                        $data['money']=$num;
                        $data['content']='充值'.$num;
                        $data['from_type']=1; //1-转入 2-转出
                        $data['type']='admin';
                        $data['type_name']='后台充值';

                        $user=Db::name('user')->field('username,account,mobile')->where('userid',$uid)->find();
                        $data['username']=$user['username'];
                        $data['account']=$user['account'];
                        $data['mobile']=$user['mobile'];
                        Db::name('money_recharge')->insert($data);
                    }

                    $detail['content']='后台充值'.$num;
                    $detail['from_type']=1; //1-转入 2-转出
                    $detail['type']='admin';
                    $detail['type_name']='后台充值';
                    $detail['uid']=$uid;
                    $detail['create_time']=time();
                    $detail['status']=1;
                    $detail['money']=$num;
                    $detail['money_record']=$old_num;

                    Db::name($field.'_detail')->insert($detail);
                    
                }

            }
            if($type=='dec'){
                $old_num=Db::name('user_wealth')->where('uid',$uid)->value($field);
                if($num>$old_num){
                    error('扣减数量不能大于原有数量');
                }
                $res=Db::name('user_wealth')->where('uid',$uid)->setDec($field,$num);

                if($res){
                    $detail['content']='后台扣减'.$num;
                    $detail['from_type']=1; //1-转入 2-转出
                    $detail['type']='admin';
                    $detail['type_name']='后台扣减';
                    $detail['uid']=$uid;
                    $detail['create_time']=time();
                    $detail['status']=1;
                    $detail['money']=$num;
                    $detail['money_record']=$old_num;
                    Db::name($field.'_detail')->insert($detail);
                }
            }
            
            if($res===false)
                error('操作失败');
            else
                success('操作成功');

        } else {
            $id=input('id/d');
            // 获取账号信息
            $info = Db::name('user')->field('userid,username,account,mobile')->find($id);
            if($info['userid']){
                $wealth=Db::name('user_wealth')->where(array('uid'=>$info['userid']))->find();
                $info=array_merge($info,$wealth);
            }
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    public function setarea(){
        
        $id=input('userid');
        // 获取账号信息
        $info = Db::name('user')->find($id);

        $this->assign('info',$info);
        return $this->fetch();
        
    }


    public function user_area(){

        if (request()->isAjax()) {
            $arr=array(4,5,6);
            $level=input('level/d');
            if(!in_array($level, $arr)){
                error('请选择代理');
            }

            $uid=input('post.userid/d',0);
            $data['area_type']=input('post.area_type/d');

            $data['area_province']=input('post.area_province');
            $data['area_city']=input('post.area_city');
            $data['area_district']=input('post.area_district');
            if($data['area_type']==1){
                $data['area_city']='';
                $data['area_district']='';
            }
            if($data['area_type']==2){
                $data['area_district']='';
            }
            if(!empty($data['area_type'])){
                $data['level']=$level;
            }else{
                error('请选择代理地址');
            }
            $res=db('user')->where(array('userid'=>$uid))->update($data);
            if($res)
                success('操作成功');
            else
                error('操作失败');
        }
        
    }



    /**
     * 用户列表
     * 
     */
    public function userlist()
    {

        // 搜索
        $keyword    = input('keyword', '', 'string');
        $querytype  = input('querytype','account','string');
        $level     = input('level');
        if($keyword){
            $condition = array('like', '%' . $keyword . '%');
            $map[$querytype] = $condition;
        }
        
        //按日期搜索
        $date=date_query('reg_date');
        if($date){
            $where=$date;
            if(isset($map))
                $map=array_merge($map,$where);
            else
                $map=$where;
        }

        if($level!=''){
             $map['a.level']=$level;
        }

        // 获取所有用户
        $user   = db('user a');
        if(!isset($map)){
            $map=true;
        }

        //分页
        $table=$user;
        $data_list     = $table
            ->join(config('prefix').'user_wealth b','a.userid = b.uid','LEFT')
            ->field('a.userid,a.username,a.email,a.account,a.mobile,a.reg_date,a.status,a.pid,a.level,a.user_type,b.money,b.integral,b.anzi')
            ->where($map)
            ->order('a.userid desc')
            ->paginate(10,false,['query'=>request()->param()]);

        $total_count=$data_list->total();

        $this->assign('list',$data_list);
        $page=$data_list->render();
        
        $this->assign('table_data_page',$page);
        return $this->fetch();
    }

}
