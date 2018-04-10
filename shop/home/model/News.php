<?php
namespace app\home\model;

use think\Model;

class News extends Model
{
	
 
    //取栏目下的新闻
    public function all_news_son($pid)
    {
    $where['status']= 1;//状态为1展示
       if($pid != 0){
    $where['pid']= $pid;//要取的类型id
    }
       return $this->where($where)->order('newtop desc')->select();//取出类型下的新闻
    }
    

    public function getField($pid,$field){//暂时未用到        
        return $this->where('userid',$userid)->value($field);
    }

    //取首页条新闻
    public function top($limit){
        $where['status']= 1;//状态为1展示
        return $this->where($where)->order('newtop desc')->limit($limit)->select();
    }

    //新闻详情
    public function detail($id){ 
        if($id){//浏览次数
        $this->where(array('id'=>$id))->setInc('times');
        }   
        return $this->where(array('id'=>$id))->find();
    }
    
    public function shabi(){
 echo "111";
        return $this->where('id=4')->select();
    }
    
}