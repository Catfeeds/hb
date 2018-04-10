<?php
namespace app\home\controller;
use think\Controller;
class Order extends Common
{

//新闻中心
public function index()
{
    //取出栏目列表
    $menu_son=model('Menu')->all_news_son(346);
    $this->assign('menu_son',$menu_son);

    //点击栏目获取id对应的新闻
    $pid=input('new_ids');
    $tit = model('News')->all_news_son($pid); 
    $this->assign('tit',$tit);

    //给帮助中心默认id
    $help_son=model('Menu')->all_news_son(6);
    $this->assign('help_son',$help_son);
    return $this->fetch();
}

//新闻详情
public function newsdetail()

{
    $this->assign('title','新闻详情');
    //点击新闻获取id对应详情
    $id = input('news_id');
    $news_detail=model('news')->detail($id);
    $this->assign('news_detail',$news_detail);
    return $this->fetch() ;
}

//商学院个人介绍
public function sxy()
{
    $this->assign('title','电商学院');
    $m=db('school_people');
    $pple=$m->select();
    $this->assign('pple',$pple);
    return $this->fetch();
}

//商学院个人作品
public function sxy2()
{
    $this->assign('title','商学院大标题');
    $mp=db('school_people');
    $id['id']= input('people_id');
    $one=$mp->where($id)->find();
    $this->assign('one',$one);
    $md=db('school_details');
    $ids['people_id']=input('people_id');
    $all=$md->where($ids)->select();
    $this->assign('all',$all);
    return $this->fetch();
}
//商学院作品详情
public function sxy3()
{
    $this->assign('title','视频详情');
    $md=db('school_details');
    $id['id']= input('id'); 
    $ones=$md->where($id)->find();
    $this->assign('ones',$ones);
    if($id)
    {//浏览次数
        $m=db('school_people');
        $pid['id']=$ones['people_id'];
        $m->where($pid)->setInc('numeration');
    }  
    return $this->fetch();
}

}
