<?php
namespace app\admin\controller;
use think\Controller;
/**
 * 管理员控制器
 * 
 */
class Manage extends Base
{
    /**
     * 管理员列表
     * 
     */
    public function index()
    {
       // 搜索
        $keyword                                  = input('keyword', '', 'string');
        if($keyword){
            $condition                                = array('like', '%' . $keyword . '%');
            $map['a.id|a.username|a.nickname'] = $condition;
        }
        

        // 获取所有用户
        $map['a.status'] = array('egt', '0'); // 禁用和正常状态
        $user_object   = db('admin a')->join(config('prefix').'group b', 'a.auth_id=b.id','LEFT'); 

        $data_list     = $user_object
            ->field('a.*,b.title')
            ->where($map)
            ->order('a.id asc')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);

        return $this->fetch();
    }

    /**
     * 新增用户
     * @author jry <598821125@qq.com>
     */
    public function add()
    {
        if (request()->isAjax()) {

            $user_object = model('Admin');
            $data        = input('post.');
            //验证数据
            $validate = validate('Admin');
            if(!$validate->scene('add')->check($data)){
                error($validate->getError());
            }
             // 密码为空表示不修改密码
            unset($data['repassword']);
            if(!$_POST['password'])
                unset($data['password']);
            else{
                $data['password']=user_md5($data['password']);
            }
            if ($data) {
                $data['create_time']=time();
                $data['status']=1;
                $id = $user_object->insert($data);
                if ($id) {
                    success('新增成功', url('index'));
                } else {
                    error('新增失败');
                }
            } else {
                error('新增失败');
            }
        } else {
                $role=model('Group')->where(array('status'=>array('neq',-1),'id'=>array('neq',1)))->field('id,title')->order('id')->select();
                $this->assign('role',$role);
                return $this->fetch('edit');
        }
    }

    /**
     * 编辑用户
     * @author jry <598821125@qq.com>
     */
    public function edit($id=0)
    {
        if (request()->isAjax()) {

            // 提交数据
            $user_object = model('Admin');
            $data        = input('post.');
            $validate    = validate('Admin');
            if(!$validate->scene('edit')->check($data)){
                error($validate->getError());
            }
            // 密码为空表示不修改密码
            unset($data['repassword']);
            if(!$_POST['password'])
                unset($data['password']);
            else{
                $data['password']=user_md5($data['password']);
            }

            if ($data) {
                $data['update_time']=time();
                $result = $user_object
                    ->field('id,nickname,username,password,mobile,auth_id,update_time')
                    ->update($data);
                if ($result) {
                    success('更新成功', url('index'));
                } else {
                    error('更新失败');
                }
            } else {
                error('更新失败');
            }
        } else {
            //角色信息
            $role=model('Group')->field('id,title')->where(array('id'=>array('neq',1)))->order('id')->select();
            $this->assign('role',$role);

            // 获取账号信息
            $info = model('Admin')->find($id);
            unset($info['password']);
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 设置一条或者多条数据的状态
     * @author jry <598821125@qq.com>
     */
    public function setStatus($model = 'admin', $script = false)
    {
        $ids = input('ids/a');
        if (is_array($ids)) {
            if (in_array('1', $ids)) {
                error('超级管理员不允许操作');
            }
        } else {
            if ($ids === '1') {
                error('超级管理员不允许操作');
            }
        }
        parent::setStatus($model);
    }
}
