<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Db;

class Shopstatus extends Base
{
   public function index()
    {
        // 搜索
        $keyword                                  = input('keyword');
        if($keyword!=''){
            $condition                            = array('like', '%' . $keyword . '%');
            $uwhere['username|mobile'] = $condition;
            $uid=Db::name('user')->where($uwhere)->column('userid');
            if($uid)
                $map['uid']=array('in',$uid);
            else
                $map['uid']=0;
        }
       
        //等级
        $user_type=input('user_type');
        if($user_type!=''){
            $map['a.user_type'] = $user_type; 
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

        $type=input('type/d',1);
        $map['a.is_check_user|a.is_check_company'] = $type; 
       
        $table   = Db::name('user_checkinfo a');
        $data_list     = $table
            ->join(config('prefix').'user b','b.userid = a.uid','LEFT')
            ->field('a.uid,b.username,b.mobile,a.province,a.city,a.district,a.is_check_company,a.is_check_user,a.create_time,a.user_type')
            ->where($map)
            ->order('a.create_time desc')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        return $this->fetch();
    }


    //详情页
    public function detail(){
        $uid=input('uid/d');
        $table=Db::name('user_checkinfo');
        $where['uid']=$uid;
        $info=$table->where($where)->find();
        $u_info=Db::name('user')->where('userid',$uid)->field('username,mobile')->find();
        if($u_info){
            $info=array_merge($info,$u_info);
        }
        $this->assign('info',$info);
        return $this->fetch();
    }

    //修改状态
    public function setDataStatus(){

        $uid=input('uid/d');
        $agree=input('agree/d');
        $reply=input('content');
        if(empty($agree))
            error('请选择状态');

        if($uid){
            $table=Db::name('user_checkinfo');
            $where['uid']=$uid;
            $user_type=$table->where($where)->value('user_type');
            if($user_type==1){
                $where['is_check_company']=1;
                $data['is_check_company']=$agree;
            }
            if($user_type==0){
                $where['is_check_user']=1;
                $data['is_check_user']=$agree;
            }

            $res=$table->where($where)->update($data);
            if($res){
                //发送信息
                if($reply){
                    $msg['create_time']=time();
                    $msg['status']=0;
                    $msg['send']=1;
                    $msg['uid']=$uid;
                    $msg['content']=$reply;
                    $msg['type']=1;
                    $msg['title']='用户认证审核';
                    db('message')->insert($msg);
                }

                success('操作成功',url('index'));
            }else{
                error('操作失败');
            }
        }
        
    }



    //工单记录
    public function orderlist()
    {
        // 搜索
        $keyword                                  = input('keyword');
        if($keyword!=''){
            $condition                            = array('like', '%' . $keyword . '%');
            $uwhere['username|mobile'] = $condition;
            $uid=Db::name('user')->where($uwhere)->column('userid');
            if($uid)
                $map['uid']=array('in',$uid);
            else
                $map['uid']=0;
        }
       
        //等级
        $update_type=input('update_type');
        if($update_type!=''){
            $map['a.update_type'] = $update_type; 
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

        $type=input('type/d',0);
        $map['a.status'] = $type; 
       
        $table   = Db::name('update_userinfo a');
        $data_list     = $table
            ->join(config('prefix').'user b','b.userid = a.uid','LEFT')
            ->field('a.uid,b.username,b.mobile,a.*')
            ->where($map)
            ->order('a.create_time desc')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        return $this->fetch();
    }

     //工单详情页
    public function orderdetail(){
        $id=input('id/d');
        $table=Db::name('update_userinfo');
        $where['id']=$id;
        $info=$table->where($where)->find();
        $u_info=Db::name('user')->where('userid',$info['uid'])->field('username,mobile,user_type')->find();
        if($u_info){
            $info=array_merge($info,$u_info);
        }
        $this->assign('info',$info);
        return $this->fetch();
    }

    //工单
    public function setOrderStatus(){
        $id=input('post.id/d');
        $agree=input('post.agree/d');
        $reply=input('post.reply');
        if(empty($agree))
            error('请选择状态');

        $table=Db::name('update_userinfo');
        $data['admin_id']=admin_login();
        $data['update_time']=time();
        $data['status']=$agree;
        $data['reply']=$reply;

        $where['id']=$id;
        $where['status']=0;
        
        $info=$table->where($where)->field('update_type,new_info,uid')->find();
        if($agree==1 && $info)
        {
            //修改类型 1-修改手机号码 2-修改姓名 3-修改企业名称
            if($info['update_type']==1){
                $count=Db::name('user')->where('mobile',$info['new_info'])->count();
                if($count>0){
                    error('操作失败，该手机号码已被使用');
                }
                Db::name('user')->where('userid',$info['uid'])->setField('mobile',$info['new_info']);
            }
            if($info['update_type']==2){
                Db::name('user')->where('userid',$info['uid'])->setField('username',$info['new_info']);
            }
            if($info['update_type']==3){
                Db::name('user')->where('userid',$info['uid'])->setField('username',$info['new_info']);
                Db::name('user_checkinfo')->where('uid',$info['uid'])->where('is_check_company',2)->setField('company_name',$info['new_info']);
            }
        }
        $res=$table->where($where)->update($data);
        if($res){
            success('操作成功',url('orderlist'));
        }else{
            error('操作失败');
        }
    }
    

}
