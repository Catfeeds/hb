<?php
namespace app\mall\controller;
use think\Controller;
use think\Db;
class Shoplist extends controller
{
    //商家店铺
    public function index()
    {
    	$seller_id=input('bid/d',0);
        if($seller_id){

            $where['good_type']=1;
            $where['seller_id']=$seller_id;

            $keywork=input('keywork');//搜索
            if($keywork){
                $where['keywords|good_name']=array('like','%'.$keywork.'%');
            }
            $start_price=input('start_price/d');
            $end_price=input('end_price/d');
            if($start_price && $end_price){
                $where['good_price']=array('BETWEEN',array($start_price,$end_price));
            }

            $order_str='good_sort desc';
            $str=input('order_str');
            if($str=='xl'){
               $order_str='good_sell_num desc'; 
            }
            if($str=='price_asc'){
               $order_str='good_price asc'; 
            }
            if($str=='price_desc'){
               $order_str='good_price desc'; 
            }

            //商品信息
            $list=Db::name('good')->field('good_id,good_name,good_cover_img,good_price,good_sell_num,good_integral,ship_fee')->where($where)->order($order_str)->limit(40)->select();
            $this->assign('list',$list);
            //店铺信息
            $info=Db::name('shop_info')->where('uid',$seller_id)->find();
            $this->assign('info',$info);
        }
        return $this->fetch() ;
    }


    public function moregood(){
        $p = input('p',0);
        $seller_id=input('bid/d',0);
        $page=$p*40; //每页显示40个

        $where['good_type']=1;
        $where['seller_id']=$seller_id;
        $keywork=input('keywork');//搜索
        if($keywork){
            $where['keywords|good_name']=array('like','%'.$keywork.'%');
        }
        $start_price=input('start_price/d');
        $end_price=input('end_price/d');
        if($start_price && $end_price){
            $where['good_price']=array('BETWEEN',array($start_price,$end_price));
        }

        $list=Db::name('good')->field('good_id,good_name,good_cover_img,good_price,good_sell_num,good_integral,ship_fee')->where($where)->order('good_sort desc')->limit($page,40)->select();

        if(empty($list)){
           $list=null; 
        }

        return $list;
    }


    
    //评论
    public function shopcomment(){

        $seller_id=input('seller_id/d');
        if($seller_id){
            //产品评论
            $table=db('good_comment');
            $where['seller_id']=$seller_id;
            $list['all']=$table->field('username,star_ability,star_attitude,star_price,content,good_name,create_time')->where($where)->order('id desc')->select();
            $where['level']=0;
            $list['low']=$table->field('username,star_ability,star_attitude,star_price,content,good_name,create_time')->where($where)->order('id desc')->select();
            $where['level']=1;
            $list['middle']=$table->field('username,star_ability,star_attitude,star_price,content,good_name,create_time')->where($where)->order('id desc')->select();
            $where['level']=2;
            $list['high']=$table->field('username,star_ability,star_attitude,star_price,content,good_name,create_time')->where($where)->order('id desc')->select();
            $this->assign('list',$list);
            $this->assign('title','所有评论');
    	    return $this->fetch();
        }
    }


    //收藏商品
    public function collectshop(){
        if(!request()->isAjax()){
            return false;
        }
        //判断用户是否登录
        if(!user_login()){
            error('您未登录，请先登录');
        }

        $seller_id=input('seller_id/d');
        if($seller_id){
            $uid=user_login();
            $data['uid']=$uid;
            $data['seller_id']=$seller_id;
            $count=db('shop_collect')->where($data)->count(1);
            if($count>0){
                error('已收藏此店铺');
            }

            $data['create_time']=time();
            $res=db('shop_collect')->insert($data);
            //添加店铺收藏数量
            db('shop_info')->where('uid',$seller_id)->setInc('shop_collect',1);
            if($res)
                success('收藏成功');
            else
                error('收藏失败');
        }
        
    }
    

}
