<?php
namespace app\adminmall\controller;
use think\Controller;
use app\admin\controller\Base;
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
        
        $user_object   = db('good_brand'); 

        $data_list     = $user_object
            ->where($map)
            ->order('brand_order desc')
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
               error('品牌名称不能为空'); 
            }
            
            $count=$table->where('brand_name',$data['brand_name'])->count(1);
            if($count>0){
                error('该品牌已存在');
            }
            //修改
            if(isset($data['id']) && !empty($data['id'])){
                $id = $table->update($data);
            }else{ //添加
                $data['status']=1;
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
     * @author jry <598821125@qq.com>
     */
    public function setStatus($model = '', $script = false)
    {
        $model = 'good_brand';
        parent::setStatus($model);
    }
}
