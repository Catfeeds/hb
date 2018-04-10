<?php
namespace app\admin\controller;
use think\Controller;
/**
 * 管理员控制器
 * 
 */
class Banner extends Base
{
    /**
     * 管理员列表
     * 
     */
    public function index()
    {
       // 搜索
        $keyword                                  = input('keyword', '', 'string');
        $map=array();
        if($keyword){
            $condition                            = array('like', '%' . $keyword . '%');
            $map['b_name'] = $condition;
        }
        $status=input('status');
        if(isset($status)){
            $map['b_type'] = $status;
        }

        // 获取数据
        $user_object   = db('banner'); 

        $data_list     = $user_object
            ->where($map)
            ->order('b_order desc,b_type,id')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        $this->positiondata();

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
            $info = db('banner')->find($id);
            $this->assign('info',$info);
        }
        $this->positiondata();
        return $this->fetch();
        
    }

    /**
     * [save 保存数据]
     * @return [type] [description]
     */
    public function save(){
        if (request()->isPost()) {
            $table = db('banner');
            $data        = input('post.');
            //如果是文件上传
            if(!empty($_FILES['b_img']['name'])){
                $img=upload_img('b_img');
                if($img['status']){
                    $data['b_img']=$img['path'];
                }else{
                   $this->error($img['error']);
                }
            }
            //+++验证数据++S+
            $rule = [
                'b_type'  => 'require',
            ];
            $msg=[
                'b_type.require'    => '请选择广告位置',
            ];
            $res=$this->validate($data,$rule,$msg);
            if(true !== $res){
               $this->error($res);
            }
            //+++验证数据++E+
            

            //修改
            if(isset($data['id']) && !empty($data['id'])){
                $id = $table->update($data);
            }else{ //添加
                $data['create_time']=time();
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


    private function positiondata(){
        $data=array(
            'mall_index_wap' => '商城首页轮播-(手机)',
            'mall_index_pc'  => '商城首页轮播(电脑端)',
            'total'          => '主页轮播图',
            );
        $this->assign('psdata',$data);
    }


    /**
     * 设置一条或者多条数据的状态
     *
     */
    public function bannerStutas()
    {
        $ids = input('ids');
        $status = input('status');
        $table = db('banner');
        if($status=='delete'){
            $b_img=$table->where('id',$ids)->value('b_img');
            @unlink('.'.$b_img);
            $res=$table->delete($ids);
        }else{
             $res=$table->where('id',$ids)->setField('status',$status);
        }
        if($res===false) {
           error('操作失败');
        } else {
            success('操作成功');
        } 
    }
}
