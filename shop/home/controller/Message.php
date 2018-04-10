<?php
namespace app\home\controller;
use think\Controller;
use think\Db;
class Message extends Common
{
    

    //消息列表
    public function index(){

        $uid=user_login();
        $where['uid'] =  array(['=',$uid],['=',0],'or');
        $list=Db::name('message')->where($where)->order('id desc')->limit(50)->select();

        $arr=array();
        $message_id=Db::name('message_read')->where('uid',$uid)->value('message_id');
        if($message_id){
            $arr=explode(',', $message_id);
        }
        $this->assign('mid_arr',$arr);
        $this->assign('list',$list);
        $this->assign('title','消息中心');
        return $this->fetch();
    }



    public function detail(){
        $id=input('id/d');
        if($id){
            $table=Db::name('message');
            $where['status']=0;
            $where['id']=$id;
            $table->where($where)->setField('status',1);
            $info=$table->where('id',$id)->find();
            if($info['uid']==0){
                $uid=user_login();
                $message_id=Db::name('message_read')->where('uid',$uid)->value('message_id');
                if($message_id){
                    $arr=explode(',', $message_id);
                    if(!in_array($info['id'],$arr)){
                        $str=$message_id.$info['id'].',';
                        Db::name('message_read')->where('uid',$uid)->setField('message_id',$str);
                    }
                }else{
                    $data=array();
                    $data['uid']=$uid;
                    $data['message_id']=$info['id'].',';
                    Db::name('message_read')->insert($data);
                }
                

            }

            $this->assign('info',$info);
            $this->assign('title','消息中心');
            return $this->fetch();
        }
        
    }

   

    

    
}
