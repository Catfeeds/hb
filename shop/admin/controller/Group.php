<?php
namespace app\admin\controller;
use think\Controller;
/**
 * 部门控制器
 * 
 */
class Group extends Base
{
    /**
     * 部门列表
     * 
     */
    public function index()
    {
        // 搜索
        $keyword         = input('keyword');
        if(!empty($keyword)){
            $condition       = array('like', '%'.$keyword.'%');
            $map['title'] = $condition;
        }

        // 获取所有角色
        $map['status'] = array('egt', '0'); //禁用和正常状态
        $data_list     = model('Group')
            ->where($map)
            ->order('sort asc, id asc')
            ->select();
        $this->assign('list',$data_list);

        return $this->fetch();
    }

    /**
     * 新增部门
     * 
     */
    public function add()
    {
        if (request()->isAjax()) {
            $group_object       = model('Group');
            $data               = input('post.');
            $menu_auth          = input('post.menu_auth/a');
            if(empty($data['title'])){
                error('请添加角色名');
            }
            if(empty($menu_auth)){
                error('请选择权限');
            }
            $data['menu_auth']  = implode(',',$menu_auth);
            if ($data) {
                $data['create_time']=time();
                $data['status']=1;
                $id = $group_object->insert($data);
                if ($id) {
                    success('新增成功', url('index'));
                } else {
                    error('新增失败');
                }
            } else {
                error('新增失败');
            }
        } else {
            $all_module_menu_list=$this->getMenuTree();
            // dump($all_module_menu_list);die;
            $this->assign('all_module_menu_list', $all_module_menu_list);
            return $this->fetch('edit');
        }
    }

    /**
     * 编辑部门
     * 
     */
    public function edit($id=0)
    {
        if (request()->isAjax()) {
            $group_object       = model('Group');
            $data               = input('post.');
            $menu_auth          = input('post.menu_auth/a');
            if(empty($data['title'])){
                error('请添加角色名');
            }
            if(empty($menu_auth)){
                error('请选择权限');
            }
            $data['menu_auth']  = implode(',',$menu_auth);
            if ($data) {
                $data['update_time']=time();
                if ($group_object->update($data) !== false) {
                    success('更新成功', url('index'));
                } else {
                    error('更新失败');
                }
            } else {
                error('更新失败');
            }
        } else {
           //获取角色信息
            $where['id']=$id;
            $info=model('Group')->find($id);

            // 获取功能模块的后台菜单列表
            $all_module_menu_list=$this->getMenuTree();
            $this->assign('all_module_menu_list', $all_module_menu_list);
            $info['menu_auth']=explode(',', trim($info['menu_auth'],','));
            $this->assign('info', $info);
            return $this->fetch('edit');
        }
    }

     // 获取功能模块的后台菜单列表
    private function getMenuTree(){
        $tree                 = new \tree\Tree();
        $all_module_menu_list = array();

        $con['status']     = 1;
        $menu=db('Menu')->where($con)->order('sort asc,id asc')->select();
        $temp                               = $menu;
        $menu_list_item                     = $tree->list2tree($temp);
        return $menu_list_item;
    }


    /**
     * 设置一条或者多条数据的状态
     * 
     */
    public function setStatus($model = 'gruop', $script = false)
    {
        $ids = input('ids/a');
        if (is_array($ids)) {
            if (in_array('1', $ids)) {
                $this->error('超级管理员组不允许操作');
            }
        } else {
            if ($ids === '1') {
                $this->error('超级管理员组不允许操作');
            }
        }
        parent::setStatus($model);
    }
}
