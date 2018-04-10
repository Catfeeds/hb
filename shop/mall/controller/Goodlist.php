<?php
namespace app\mall\controller;
use think\Controller;
class Goodlist extends controller
{
    public function index()
    {
        $type_id=input('id/d');
    	$keywork=input('keywork');//搜索
        $list=array();
        $title='搜索';
    	if($type_id){
            $title=category_name($type_id);

    		$c_where['pid_path']=array('like','%-'.$type_id.'-%');
    		$type_arr=db('good_category')->where($c_where)->column('id');
    		if(count($type_arr)>0){
    			$where['category_id']=array('IN',$type_arr);
    		}
    	}
  
        if($keywork){
            $where['keywords|good_name']=array('like','%'.$keywork.'%');
        }

        $start_price=input('start_price/d');
        $end_price=input('end_price/d');
        if($start_price && $end_price){
            $where['good_price']=array('BETWEEN',array($start_price,$end_price));
        }
        //商品数据
        if(isset($where) && !empty($where)){

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

            $where['status']=1;
            $list=db('good')->field('good_id,good_name,good_cover_img,good_price,good_sell_num,good_integral,ship_fee')->where($where)->order($order_str)->limit(500)->select();
        }
       
        $this->assign('list',$list);
    	$this->assign('title',$title);
        return $this->fetch() ;
    }
}
