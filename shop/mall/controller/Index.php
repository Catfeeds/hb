<?php
namespace app\mall\controller;
use think\Controller;
use think\Db;
class Index extends controller
{
    public function test(){

        $good_id_arr=Db::name('order_detail')->column('good_id,good_num,attr_value','good_id');
        p($good_id_arr);
    }

    public function index()
    {
    	//产品分类
        $category=db('good_category');
        $cate_where['level']=1;
        $cate_where['is_show']=1;
        $cate_info=$category->where($cate_where)->field('id,name,image')->order('sort_order desc')->limit(9)->select();

        //最新动态
        $newlist=array();
        $newlist=db('shopnew')->order('id desc')->limit(2)->select();


    	$to_html=array(
    		'title'		=>	'商城首页',
    		'banner'	=>  get_banner('mall_index_wap'),//轮播图
            'cate_info' =>  $cate_info,
            'newlist'   =>  $newlist,
    	);
    	$this->assign($to_html);
        return $this->fetch() ;
    }
}
