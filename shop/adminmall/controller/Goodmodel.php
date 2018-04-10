<?php
namespace app\adminmall\controller;
use think\Controller;
use app\admin\controller\Base;
/**
 * 商品模型控制器
 * 
 */
class Goodmodel extends Base
{
    /**
     * 商品模型列表
     * 
     */
    public function index()
    {
        //搜索
        $map=array();
        $keyword                               = input('keyword', '', 'string');
        if($keyword){
            $condition                         = array('like', '%' . $keyword . '%');
            $map['model_name'] = $condition;
        }
        
        $user_object   = db('good_model'); 

        $data_list     = $user_object
            ->where($map)
            ->order('id asc')
            ->paginate(10);

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
            $info = db('good_model')->find($id);
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
            $table = db('good_model');
            $data        = input('post.');
            
            if(empty($data['model_name'])){
               error('模型名称不能为空'); 
            }
            
            //修改
            if(isset($data['id']) && !empty($data['id'])){
                $id = $table->update($data);
            }else{ //添加
                $id = $table->insert($data);
            }
            if ($id===false) {
                error('保存失败');
            } else {
                success('保存成功', url('index'));
            } 
        }
    }

    /**
     * 设置一条或者多条数据的状态
     *
     */
    // public function setStatus($model = 'admin', $script = false)
    // {
    //     $ids = input('ids/a');
    //     if (is_array($ids)) {
    //         if (in_array('1', $ids)) {
    //             error('超级商品模型不允许操作');
    //         }
    //     } else {
    //         if ($ids === '1') {
    //             error('超级商品模型不允许操作');
    //         }
    //     }
    //     parent::setStatus($model);
    // }

    /**
     * 编辑属性
     * 
     */
    public function Attribute()
    {
        $id=input('model_id');
        if(isset($id)){
            $list = db('good_attribute')->where('model_id',$id)->order('attr_order desc')->select();
            $this->assign('list',$list);
        }
        return $this->fetch();
        
    }

    public function Editattribute(){
        $id=input('id');
        $model_id=input('model_id');
        if(isset($id)){
            $info = db('good_attribute')->find($id);
            //把逗号替换换行
            $attr_value_str=$info['attr_value'];
            $this->assign('info',$info);
            $this->assign('attr_value_str',$attr_value_str);
        }

        $model_info = db('good_model')->order('id')->select(); 
        $this->assign('model_info',$model_info);
        $this->assign('model_id',$model_id);
        return $this->fetch();
    }


    public function saveattr(){
        if (request()->isAjax()) {
            $table = db('good_attribute');
            $data        = input('post.');
            $data['attr_value']=trim($data['attr_value']);

            if(empty($data['model_id'])){
               error('请选择所属模型'); 
            }
            if(empty($data['attr_name'])){
               error('请添加规格名称'); 
            }
            if(empty($data['attr_value'])){
               error('请添加规格项'); 
            }

            //修改
            if(isset($data['id']) && !empty($data['id'])){
                $id = $table->update($data);
            }else{ //添加
                $id = $table->insert($data);
            }
            if ($id===false) {
                error('保存失败');
            } else {
                success('保存成功',url('Attribute',array('model_id'=>$data['model_id'])));
            } 
        }
    }

    /**
     * [changeorder 修改排序]
     * @return [type] [description]
     */
    public function changeorder(){
        $id=input('post.id');
        $sort_order=input('post.sort_order');
        $table=db('good_attribute');
        $where['id']=$id;
        $res=$table->where($where)->setField('attr_order',$sort_order);
        if($res)
            success('修改成功');
        else
            error('修改失败');
    }

    public function delete(){
        $id=input('id');
        if(isset($id) && !empty($id)){
            $count=db('good_attribute')->where('model_id',$id)->count(1);
            if($count!=0){
                error('不可删除，改模型下有规格');
            }
            $table=db('good_model');
            $res=$table->delete($id);
            if($res)
                success('删除成功，不可恢复');
            else
                error('删除失败');
        }
        
    }
    public function deleteattr(){
        $id=input('id');
        if(isset($id) && !empty($id)){
            $table=db('good_attribute');
            $res=$table->delete($id);
            if($res)
                success('删除成功，不可恢复');
            else
                error('删除失败');
        }
        
    }

}
