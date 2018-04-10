<?php
namespace app\adminmall\controller;
use think\Controller;
use think\Db;
use app\admin\controller\Base;

class Comment extends Base
{


    //评论列表页
    public function index()
    {
         //搜索
        $map=array();
        $keyword                  = input('keyword', '', 'string');
        if($keyword){
            $condition            = array('like', '%' . $keyword . '%');
            $map['username|mobile|good_name'] = $condition;
        }
        $map['seller_id']=0;
        $user_object   = Db::name('good_comment'); 

        $data_list     = $user_object
            ->where($map)
            ->order('id desc')
            ->paginate(10);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        return $this->fetch();
    }

     //商家
    public function sellercomment()
    {
         //搜索
        $map=array();
        $keyword                  = input('keyword', '', 'string');
        if($keyword){
            $condition            = array('like', '%' . $keyword . '%');
            $map['username|mobile'] = $condition;
        }
        $map['seller_id']=array('gt',0);
        $user_object   = Db::name('good_comment'); 

        $data_list     = $user_object
            ->where($map)
            ->order('id desc')
            ->paginate(10);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        return $this->fetch();
    }
   

    //删除文章
    public function delete(){
            $id  = input('ids');//传过来的新闻id    
            $where['id'] = $id;      
            $dltnews = db('good_comment')->where($where)->delete();                    
            if ($dltnews===false){
                error('删除失败');
            }else{
                success('删除成功');
            } 
    }





}
