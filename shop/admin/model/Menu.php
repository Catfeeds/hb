<?php
namespace app\admin\model;

use think\Model;

class Menu extends Model
{
	/**
     * [getCol 获取用户可操作控制器]
     * @return [type] [description]
     */
    public function getCol(){
        $uid        = admin_login();
        if($uid==1){
            return $uid;
        }
        $auth_id    = db('admin')->where(array('id'=>$uid))->value('auth_id');
        //根据用户ID获用户角色
        $group_info = db('group')->find($auth_id);
        $group_auth = $group_info['menu_auth']; // 获得当前登录用户的权限列表
        //顶级菜单
        $col = $this->where('status',1)->where('id','in',explode(',', trim($group_auth,',')))->order('sort asc, id asc')->column('col');
        return $col;
    }


    /**
     * 获取最顶级菜单
     */
    public function getTopMenu(){

        $uid  = admin_login();
        //超级管理员
        if($uid==1){
                //顶级菜单
                $con['status']      = 1;
                $con['level']      = 0;
                $system_module_list_g = $this->where($con)->order('sort asc, id asc')->select();
                foreach ($system_module_list_g as $key => $val) {
                    $where['level']=2;
                    $where['gid']=$val['id'];
                    $info=$this->where($where)->order('sort asc, id asc')->field('mod,col,act,param,param_value')->find();
                    if($info['col'] && $info['act'] && $info['mod']){
                        $system_module_list_g[$key]['col']=$info['col'];
                        $system_module_list_g[$key]['act']=$info['act'];
                        $str='';
                        if($info['param']){
                            $str=array($info['param'] => $info['param_value']);
                            $system_module_list_g[$key]['url']=url($info['mod'].'/'.$info['col'].'/'.$info['act'],$str);
                        }else{
                            $system_module_list_g[$key]['url']=url($info['mod'].'/'.$info['col'].'/'.$info['act']);
                        }
                    }
                }
                $menu_list['g_menu']=$system_module_list_g;
            return $menu_list;
        }
        //非超级管理员
        $auth_id    = db('admin')->where(array('id'=>$uid))->value('auth_id');
        //根据用户ID获用户角色
        $group_info = db('group')->find($auth_id);
        $group_auth = $group_info['menu_auth']; // 获得当前登录用户所角色的权限列表
            //顶级菜单
            $con['level']       = 0;
            $con['status']      = 1;
            $con['id']          = array('in',trim($group_auth,','));
            $system_module_list_g = $this->where($con)->order('sort asc, id asc')->select();
            foreach ($system_module_list_g as $key => $val) {
                $where['level']=2;
                $where['gid']=$val['id'];
                $where['id'] = array('in',trim($group_auth,','));
                $info=$this->where($where)->order('sort asc, id asc')->field('mod,col,act,param,param_value')->find();
                if($info['col'] && $info['act'] && $info['mod']){
                    $system_module_list_g[$key]['col']=$info['col'];
                    $system_module_list_g[$key]['act']=$info['act'];
                    $str='';
                    if($info['param']){
                        $str=array($info['param'] => $info['param_value']);
                        $system_module_list_g[$key]['url']=url($info['mod'].'/'.$info['col'].'/'.$info['act'],$str);
                    }else{
                        $system_module_list_g[$key]['url']=url($info['mod'].'/'.$info['col'].'/'.$info['act']);
                    }
                }
            }
        $menu_list['g_menu']=$system_module_list_g;
        return $menu_list;
    }


    /**
     * 获取二三级菜单
     * @param string $addon_dir
     */
    public function getAllMenu($gid=1)
    {
        
        $uid        = admin_login();
        //超级管理员
        if($uid==1){
            //父级菜单
            $con['status']   = 1;
            $con['level']    = 1;
            $con['gid']      = $gid;
            $system_module_list_p=$this->where($con)->order('sort asc, id asc')->select();
            $menu_list['p_menu']=$system_module_list_p;
            //子级菜单
            $con['level']      = 2;
            $system_module_list_c=$this->where($con)->order('sort asc, id asc')->select();
            $menu_list['c_menu']=$system_module_list_c;
            return $menu_list;
        }

        $auth_id    = db('admin')->where(array('id'=>$uid))->value('auth_id');
        //根据用户ID获用户角色
        $group_info = db('group')->find($auth_id);
        $group_auth = $group_info['menu_auth']; // 获得当前登录用户所属部门的权限列表
        // 获取所有菜单
            $con['status']      = 1;
            $con['id']          = array('in',trim($group_auth,','));
            $con['gid']         = $gid;
            //父级菜单
            $con['level']      = 1;
            $system_module_list_p=$this->where($con)->order('sort asc, id asc')->select();
            $menu_list['p_menu']=$system_module_list_p;
            //子级菜单
            $con['level']      = 2;
            $system_module_list_c=$this->where($con)->order('sort asc, id asc')->select();
            $menu_list['c_menu']=$system_module_list_c;

        return $menu_list;
    }

    /**
     * 根据菜单ID的获取其所有父级菜单
     * @return array 父级菜单集合
     */
    public function getParentMenu()
    {
        $col=controller_name();
        $act=action_name();
        $mod=model_name();
        if($col!='Index'){
            $where['mod']       = $mod;
            $where['col']       = $col;
            $where['act']       = $act;
            if($this->where($where)->count(1)==0){
                unset($where['act']);
            }
        }
        $where['status']    = 1;
        $where['level']     = 2;
        //取当前菜单的顶级
        $m_info=$this->where($where)->field('pid,gid,name')->find();
        if(empty($m_info)){
            return false;
        }
        //取父级名称
        $p_where['id']=$m_info['pid'];
        $p_name=$this->where($p_where)->value('name');
        //取顶级名称
        $g_where['id']=$m_info['gid'];
        $g_name=$this->where($g_where)->value('name');
        // 面包屑导航
        $m_info['name']=array($g_name,$p_name,$m_info['name']);
        return $m_info;
    }

}