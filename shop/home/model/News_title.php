<?php
namespace app\home\model;

use think\Model;

class News_title extends Model
{
    
   
    protected $name='news_title';

    //取新闻栏目名称
    public function all_news_son($pid)
    {
       return $this->where(array('pid'=>$pid))->where('id != 6')->order('sort')->Field('id,title')->select();
    }

    public function getField($pid,$field){//暂时未用到
        return $this->where('userid',$userid)->value($field);
    }

}