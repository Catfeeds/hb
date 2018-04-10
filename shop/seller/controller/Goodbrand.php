<?php
namespace app\seller\controller;
use think\Controller;
use think\Db;
/**
 * 品牌控制器
 * 
 */
class Goodbrand extends Base
{
    /**
     * 品牌列表
     * 
     */
    public function index()
    {
        //搜索
        $map=array();
        $keyword                               = input('keyword', '', 'string');
        if($keyword){
            $condition                         = array('like', '%' . $keyword . '%');
            $map['brand_name'] = $condition;
        }
        $map['seller_id']=seller_login();
        $user_object   = db('good_brand'); 

        $data_list     = $user_object
            ->where($map)
            ->order('brand_order desc')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);

        return $this->fetch();
    }

    /**
     * 编辑用户
     * 
     */
    public function edit()
    {
        $id=input('id');
        if(isset($id)){
            $info = db('good_brand')->find($id);
            $this->assign('info',$info);
        }
        return $this->fetch();
        
    }

    /**
     * [save 保存数据]
     * @return [type] [description]
     */
    public function save(){
        if (request()->isAjax()) {
            $table = db('good_brand');
            $data        = input('post.');
            
            if(empty($data['brand_name'])){
               $this->error('品牌名称不能为空'); 
            }

            $count=$table->where('brand_name',$data['brand_name'])->count(1);
            if($count>0){
                $this->error('该品牌已存在');
            }

            
            //修改
            if(isset($data['id']) && !empty($data['id'])){
                $where['seller_id']=seller_login();
                $where['id']=$data['id'];
                $id = $table->where($where)->update($data);
            }else{ //添加
                $data['seller_id']=seller_login();
                $data['status']=1;
                $id = $table->insert($data);
            }
            if ($id===false) {
                $this->error('保存失败');
            } else {
                $this->success('保存成功', url('index'));
            } 
        }
    }


    /**
     * 设置一条或者多条数据的状态
     * 
     */
    public function setStatus()
    {
       $table=Db::name('good_brand');
       $status=input('status');
       $id=input('id/d');
       if(empty($id)){
        $this->error('操作失败');
       }
       $where['seller_id']=seller_login();
       $where['id']=$id;
       if($status=='delete'){ //删除
          $res=$table->where($where)->delete();
          if($res){
            $this->success('删除成功');
          }else{
            $this->error('删除失败');
          }
      }
      if($status=='forbid'){ //下架
        $res=$table->where($where)->setField('status',0);
      }
      if($status=='resume'){ //上架
        $res=$table->where($where)->setField('status',1);
      }
      if($res){
        $this->success('操作成功');
      }else{
        $this->error('操作失败');
      }
    }
}
