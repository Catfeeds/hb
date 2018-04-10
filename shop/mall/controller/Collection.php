<?php
namespace app\mall\controller;
use think\Controller;
use think\Db;
use app\home\controller\Common;
class Collection extends Common
{
  //商品
    public function collecgood(){

      $where['a.uid']=user_login();
      $where['b.status']=1;
      $list=Db::name('good_collect a')->join('ysk_good b','a.good_id=b.good_id')->field('a.id,b.good_name,b.good_cover_img,b.good_price,b.good_id')->where($where)->select();

      $to_html=array(
        'title'       =>  '我的收藏',
        'list'        =>  $list,
        'back_url'    =>  url('User/usercenter'),
      );
      $this->assign($to_html);
       return $this->fetch();
    }

  //店铺
  public function collecshop(){

      $where['a.uid']=user_login();
      $list=Db::name('shop_collect a')->join('ysk_shop_info b','a.seller_id=b.uid')->field('a.id,b.shop_name,b.shop_logo,a.seller_id')->where($where)->order('id desc')->select();


      $to_html=array(
        'title'       =>  '我的收藏',
        'list'        =>  $list,
        'back_url'    =>  url('User/usercenter'),
      );
      $this->assign($to_html);
      return $this->fetch();
   }

   //取消收藏
   public function guitcollect(){
      $id=input('id/d');
      $type=input('type/d');
      if($id){
        $where['uid']=user_login();
        $where['id']=$id;
        if($type==1){
          $res=Db::name('good_collect')->where($where)->delete();
        }else{
          $res=Db::name('shop_collect')->where($where)->delete();
        }
        if($res)
          success('取消成功');
        else
          error('取消失败');
      }
   }

}
