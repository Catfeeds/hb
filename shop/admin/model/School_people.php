<?php
namespace app\admin\model;

use think\Model;

class School_people extends Model
{
	/**
     * 检查角色功能权限
     * 
     */
/*    public function checkMenuAuth()
    {
        $current_col = controller_name(); // 当前菜单
        $user_col   = model('admin/Menu')->getCol(); // 获得当前登录用户信息
        if ($user_col != '1') {
            if(!in_array($current_col,$user_col)){
                return false;
            }
           
            return true;
        } else {
            return true; // 超级管理员无需验证
        }
        return false;
    }*/
    public function people_add()
    {
       $m=$this->select();
        p($m);echo '4444';
/*        if(isset($id))
        {
            return $this->db('school_people')->find($id);  
        }*/
    }
 

}