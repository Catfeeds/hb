<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Db;
class Base extends controller
{
    /**
     * 初始化方法
     * @author jry <598821125@qq.com>
     */
    protected function _initialize()
    {
        if(!session::get("islogin")){
            echo "404";exit();
        }

        // 登录检测
        if (!admin_login()) {
            //还没登录跳转到登录页面
            $this->redirect('admin/Login/logout');
        }

        // 权限检测
        $current_url = model_name() . '/' . controller_name() . '/' . action_name();
        if ('admin/Index/index' !== $current_url) {

            if (!model('admin/Group')->checkMenuAuth()) {
                $this->error('权限不足！', url('Admin/Index/index'));
            }
        }

     
        // 获取左侧导航
        $this->getMenu();
    }

    // 后台主菜单
    public function getMenu(){
        $module_object = model('Admin/Menu');

        //选种的顶部菜单ID
        $_menu_tab=$module_object->getParentMenu();
        // dump($_menu_tab);die;
        $_menu_tab['gid'] ? $_menu_tab['gid'] :$_menu_tab['gid']=1;
        // 获取所有导航
        $menu_list=$module_object->getAllMenu($_menu_tab['gid']);
        $menu_top=$module_object->getTopMenu();
        // $select_url=$module_object->SelectMenu();

        $this->assign(array(
            '_menu_list_g'  =>  $menu_top['g_menu'],//爷爷级
            '_menu_list_p'  =>  $menu_list['p_menu'],//父级
            '_menu_list_c'  =>  $menu_list['c_menu'],//子级
            '_menu_tab'     =>  $_menu_tab,
        ));
    }

    /**
     * 设置一条或者多条数据的状态
     * @param $script 严格模式要求处理的纪录的uid等于当前登陆用户UID
     * @author jry <598821125@qq.com>
     */
    public function setStatus($model, $script = false)
    {
        $ids    = input('ids/a');
        $status = input('status');
        if (empty($ids)) {
            error('请选择要操作的数据');
        }
        $model_primary_key       = db($model)->getPk();
        $map[$model_primary_key] = array('in', $ids);
        if ($script) {
            $map['uid'] = array('eq', admin_login());
        }
        switch ($status) {
            case 'forbid': // 禁用条目
                $data = array('status' => 0);
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success' => '禁用成功', 'error' => '禁用失败')
                );
                break;
            case 'resume': // 启用条目
                $data = array('status' => 1);
                $map  = array_merge(array('status' => 0), $map);
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success' => '启用成功', 'error' => '启用失败')
                );
                break;
            case 'recycle': // 移动至回收站
                $data['status'] = -1;
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success' => '成功移至回收站', 'error' => '删除失败')
                );
                break;
            case 'restore': // 从回收站还原
                $data = array('status' => 1);
                $map  = array_merge(array('status' => -1), $map);
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success' => '恢复成功', 'error' => '恢复失败')
                );
                break;
            case 'delete': // 删除条目
                $result = db($model)->where($map)->delete();
                if ($result) {
                    success('删除成功，不可恢复！');
                } else {
                   error('删除失败');
                }
                break;
            default:
                error('参数错误');
                break;
        }
    }






    /**
     * 对数据表中的单行或多行记录执行修改 GET参数id为数字或逗号分隔的数字
     * @param string $model 模型名称,供M函数使用的参数
     * @param array  $data  修改的数据
     * @param array  $map   查询时的where()方法的参数
     * @param array  $msg   执行正确和错误的消息
     *                       array(
     *                           'success' => '',
     *                           'error'   => '',
     *                           'url'     => '',   // url为跳转页面
     *                           'ajax'    => false //是否ajax(数字则为倒数计时)
     *                       )
     * @author jry <598821125@qq.com>
     */
    final protected function editRow($model, $data, $map, $msg)
    {
        $id = array_unique((array) input('id', 0));
        $id = is_array($id) ? implode(',', $id) : $id;
        //如存在id字段，则加入该条件
        $fields = db($model)->getTableInfo('', 'fields');
        if (in_array('id', $fields) && !empty($id)) {
            $where = array_merge(
                array('id' => array('in', $id)),
                (array) $where
            );
        }
        $msg = array_merge(
            array(
                'success' => '操作成功！',
                'error'   => '操作失败！',
                'url'     => ' ',
                'ajax'    => request()->isAjax(),
            ),
            (array) $msg
        );
        $result = db($model)->where($map)->update($data);
        if ($result != false) {
           success($msg['success'], $msg['url'], $msg['ajax']);
        } else {
           error($msg['error'], $msg['url'], $msg['ajax']);
        }
    }

    final protected function editTableRow($table, $data, $map, $msg)
    {
        $id = array_unique((array) input('id', 0));
        $id = is_array($id) ? implode(',', $id) : $id;
        //如存在id字段，则加入该条件
        $fields = db($table)->getTableInfo('', 'fields');
        if (in_array('id', $fields) && !empty($id)) {
            $where = array_merge(
                array('id' => array('in', $id)),
                (array) $where
            );
        }
        $msg = array_merge(
            array(
                'success' => '操作成功！',
                'error'   => '操作失败！',
                'url'     => ' ',
                'ajax'    => request()->isAjax(),
            ),
            (array) $msg
        );
        $result = db($table)->where($map)->update($data);
        if ($result != false) {
           success($msg['success'], $msg['url'], $msg['ajax']);
        } else {
           error($msg['error'], $msg['url'], $msg['ajax']);
        }
    }
}
