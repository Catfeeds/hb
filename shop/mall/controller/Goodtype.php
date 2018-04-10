<?php
namespace app\mall\controller;
use think\Controller;

class Goodtype extends controller
{
    public function index()
    {


    	//产品分类
        $category=db('good_category');
        $cate_where['is_show']=1;
        //一级分类
        $cate_one=$category->where($cate_where)->field('id,name,image,pid')->order('sort_order desc')->select();
        $tree=new \tree\Tree();
        $list=$tree->list2tree($cate_one);
        // dump($list);die;

    	$to_html=array(
    		'title'		=>	'产品分类',
    		'cate_list' =>	$list,
    	);
    	$this->assign($to_html);
        return $this->fetch() ;
    }
}
