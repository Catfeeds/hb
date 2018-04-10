<?php
namespace app\mall\controller;
use think\Controller;
use think\Db;
use app\home\controller\Common;
class Usercomment extends Common
{
    public function commentlist()
    {
      
      $list=array();
      $uid=user_login();
      $where['user_id']=$uid;
      $where['order_status']=array('egt',2);
      $order_id=Db::name('order')->where($where)->column('order_id');
      if($order_id && count($order_id)>0){
        $type=input('type/d',0);
        $datail_where['is_comment']=$type;
        $datail_where['order_id']=array('in',$order_id);
        $list=Db::name('order_detail')->where($datail_where)->order('id desc')->select();
      }

    	$to_html=array(
    		'title'       =>  '我的评论',
        'list'        =>  $list,
    	);
    	$this->assign($to_html);
      return $this->fetch();
    }


    public function gocomment(){
        $id=input('id/d');
        if($id){
          $info=Db::name('order_detail')->find($id);
          $to_html=array(
              'title'       =>  '我的评论',
              'info'        =>  $info,
            );
          $this->assign($to_html);
          return $this->fetch();
        }
    }


    public function savecomment(){
        if(request()->isAjax()){
          $data=input('post.');
          unset($data['id']);
          if(empty($data['star_ability']) || empty($data['star_attitude']) || empty($data['star_price']) || empty($data['content'])){
            error('请填写所有内容');
          }
          $id=input('post.id/d');
          $dwhere['is_comment']=0;
          $dwhere['id']=$id;
          $order_detail=Db::name('order_detail')->where($dwhere)->find();
          $order_id=$order_detail['order_id'];
          if(empty($order_detail)){
            error('操作失败');
          }
          $where=array();
          $uid=user_login();
          $where['user_id'] =$uid;
          $where['order_id']=$order_id;
          $count=Db::name('order')->where($where)->count(1);
          if($count==0){
            error('操作失败');
          }

          //计算级别  0-5 差评  5-10 中评 10-15 好评
          $sum=$data['star_ability']+$data['star_attitude']+$data['star_price'];
          if($sum<5){
            $data['level']=0;
          }elseif ($sum>=5 && $sum<=10) {
            $data['level']=1;
          }elseif ($sum>10) {
            $data['level']=2;
          }

          $user=session('user_login');
          $data['uid']=$uid;
          $data['username']=$user['username'];
          $data['mobile']=$user['mobile'];
          $data['good_id']=$order_detail['good_id'];
          $data['good_name']=$order_detail['good_name'];
          $data['good_item']=$order_detail['attr_text'];
          $data['seller_id']=$order_detail['seller_id']; //商家ID
          $data['create_time']=time();
          $data['order_id']=$order_id;

          $res=Db::name('good_comment')->insert($data);
          Db::name('order_detail')->where($dwhere)->setField('is_comment',1);

          //添加商品评论数
          $good_id=$order_detail['good_id'];
          Db::name('good')->where('good_id',$good_id)->setInc('good_comment',1);

          //添加商家评论数
          $seller_id=$order_detail['seller_id'];
          if(isset($seller_id) && $seller_id>0){
            Db::name('shop_info')->where('uid',$seller_id)->setInc('shop_comment',1);
          }

          if($res)
            success('操作成功',url('usercomment/commentlist',array('type'=>1)));
          else
            error('操作失败');
        }
    }

}
