<?php
namespace app\adminmall\controller;
use think\Controller;
use app\admin\controller\Base;

class Shopnews extends Base
{


    //文章列表页
    public function index()
    {
         //搜索
        $map=array();
        $keyword                  = input('keyword', '', 'string');
        if($keyword){
            $condition            = array('like', '%' . $keyword . '%');
            $map['title|type'] = $condition;
        }
        
        $user_object   = db('shopnew'); 

        $data_list     = $user_object
            ->where($map)
            ->order('type')
            ->paginate(10);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        return $this->fetch();
    }

    //添加文章页
    public function add(){   
        $id=input('ids');
        if(isset($id)){
            $info = db('shopnew')->find($id);
            $this->assign('info',$info);
        }
        return $this->fetch();      
    }


    //保存文章
    public function save(){

          if (request()->isAjax()) {
                $table = db('shopnew');
                $data  = input('post.');         
                if(empty($data['type'])){
                   error('分类不能为空');
                }
                if(empty($data['title'])){
                   error('标题不能为空');
                }
                //修改
                $data['create_time']=time();
                if(isset($data['id']) && !empty($data['id'])){               
                    $up = $table->update($data);
                }else{ //添加                           
                    $up = $table->insert($data);
                }
                if ($up===false) {
                    error('保存失败');
                } else {
                    success('保存成功', url('index'));
                } 
            }
    }

    //删除文章
    public function delete(){
            $id  = input('ids');//传过来的新闻id    
            $where['id'] = $id;      
            $dltnews = db('shopnew')->where($where)->delete();                    
            if ($dltnews===false){
                error('删除失败');
            }else{
                success('删除成功');
            } 
    }





}
