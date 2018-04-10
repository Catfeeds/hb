<?php
namespace app\home\model;

use think\Model;

class Article extends Model
{
	 // 当前模型名称
 /*   protected $name='user_wealth';*/

    //根据id找到文章表里的一条数据
    public function find_article($id)
    {
        return $this->where('id',$id)->find();
    }



}