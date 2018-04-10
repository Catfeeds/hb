<?php
namespace app\seller\Controller;
use think\Controller;
use think\Db;

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
        $map['seller_id']=seller_login();
        $user_object   = Db::name('good_comment'); 

        $data_list     = $user_object
            ->where($map)
            ->order('id desc')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        return $this->fetch();
    }
   






}
