<?php
namespace app\home\controller;
use think\Controller;
use think\Db;
class Around extends Common
{
	//信息列表
    public function index()
    {
        $list=Db::name('industry')->field('id,name')->where('pid',0)->order('id')->limit(10)->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    //店铺获取地址
    public function distance(){ 

        if(request()->isAjax()){
            $longitude=input('post.longitude');
            $latitude=input('post.latitude');
            $type=input('type/d',0);
            $keyword=input('keyword');
            if($longitude && $latitude){

                $data['longitude']=$longitude;
                $data['latitude']=$latitude;
                session('lon_lat',$data);

                //取经纬度+1范围内
                $where['shop_j']=array('between',array($longitude-1,$longitude+1));
                $where['shop_w']=array('between',array($latitude-1,$latitude+1));
                if($keyword){
                   $map['shop_name']=array('like','%'.$keyword.'%');
                   $list=Db::name('shop_info')->field('shop_name,shop_logo,province,city,district,addresss_detail,shop_j,shop_w,uid')->where($map)->select(); 
                }
                elseif($type){
                    $where['industry_id']=array('like','%,'.$type.',%');
                    $list=Db::name('shop_info')->field('shop_name,shop_logo,province,city,district,addresss_detail,shop_j,shop_w,uid')->where($where)->select();
                }else{
                    $list=Db::name('shop_info')->field('shop_name,shop_logo,province,city,district,addresss_detail,shop_j,shop_w,uid')->where($where)->limit(20)->select();
                }

                if(empty($list)){
                   $list=''; 
                }
                return $list;
            }
        }
        

    }  



    //地图
    public function map(){

    	return $this->fetch();

    }

    //查询
    public function search(){
    	return $this->fetch();
    }

    //分类
    public function typelist(){
    	$this->assign('title','商家列表');
    	return $this->fetch();
    }

    //详情
    public function detail(){
        $uid=input('id/d');
        if($uid){

            $info=Db::name('shop_info')->where('uid',$uid)->find();
            $this->assign('info',$info);

            //评论列表
            $list=Db::name('good_comment')->field('username,star_ability,star_attitude,star_price,content,good_item,create_time')->where('seller_id',$uid)->order('id desc')->limit(100)->select();


            $this->assign('list',$list);
            $this->assign('title','商家详情');
            return $this->fetch();
        }
    	
    }

    //评论
    public function comment(){
    	
    	$this->assign('title','评论');
    	return $this->fetch();
    }
}





