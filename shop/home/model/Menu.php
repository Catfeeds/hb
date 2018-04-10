<?php
namespace app\home\model;

use think\Model;

class Menu extends Model
{
	
    //定义
    protected $name='news_title';

    //取新闻栏
    public function all_news_son($pid)
    {
       return $this->where(array('pid'=>$pid))->where('id != 6')->order('sort')->Field('id,title')->select();
    }


    public function getField($pid,$field)
    {//暂时未用到
        return $this->where('userid',$userid)->value($field);
    }

}