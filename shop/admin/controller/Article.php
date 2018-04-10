<?php
namespace app\admin\controller;
use think\Controller;
/**
 * 管理员控制器
 * 
 */
class Article extends Base
{
    /**
     * 管理员列表
     * 
     */


    //文章列表页
    public function index()
    {
         //搜索
        $map=array();
        $keyword                  = input('keyword', '', 'string');
        if($keyword){
            $condition            = array('like', '%' . $keyword . '%');
            $map['title|id|type'] = $condition;
        }
        
        $user_object   = db('article'); 

        $data_list     = $user_object
            ->where($map)
            ->order('type')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        return $this->fetch();
    }

    //添加文章页
    public function addarticle(){   
        $id=input('ids');
        if(isset($id)){
            $info = db('article')->find($id);
            $this->assign('info',$info);
        }
        return $this->fetch();      
    }


    //保存文章
    public function savearticle(){

          if (request()->isAjax()) {
                $table = db('article');
                $data  = input('post.');         
              
                if(empty($data['title'])){
                   error('标题不能为空');
                }
                //修改
                $data['savetime']=time();
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
    public function deleterticle(){
            $data  = input('ids');//传过来的新闻id    
            $id['id'] = $data;      
            $dltnews = db('article')->where($id)->delete();                    
            if ($dltnews===false){
                error('删除失败');
            }else{
                success('删除成功', url('index'));
            } 
    }





}
