<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Db;
/**
 * 管理员控制器
 * 
 */
class Tree extends Base
{
   /**
     * 用户列表
     *
     */
    public function index()
    {   
         // 搜索
        $pid        =   input('keyword', '0');
        $user           =   Db::name('user');
        if($pid!='0')
        {
            $k_where['userid|mobile|account'] = $pid;
            $query=$user->where($k_where)->field('userid,pid,username,account,deep')->find();
            $pid=$query['userid'];
            $tree =   $this->getTree($pid,$query);
        }else{
            $tree =   $this->getTree($pid);
        }
       
        
        $this->assign('tree',$tree);

        return $this->fetch();
    }


    public  function getTree($pid='0',$q=null)
    {
        static $deep=5;
        $t=Db::name('user');
        $list=$t->where(array('pid'=>$pid))->order('userid asc')->select();

        if(is_array($list)){
            $html = '';
            if($q){
                $deep=$q['deep']+5;
                $html .= '<li style="display:none" >';
                $html .= '<span><i class="icon-plus-sign fa-plus blue "></i>';
                $html .= $q['username'];
                $html .= '</span> <a href="'.url('User/edit',array('id'=>$q['userid'])).'">';
                $html .= $q['account'];
                $html .= '</a>';
                $html .= $this->getTree($q['userid']);
                $html = $html."</li>";
                return $html ? '<ul>'.$html.'</ul>' : $html ;
            }
            foreach($list as $k => $v)
            {
               if($v['pid'] == $pid)
               {   
                    if($deep<$v['deep']){
                        break;
                    }

                    //父亲找到儿子
                    $html .= '<li style="display:none" >';
                    $html .= '<span><i class="icon-plus-sign fa-plus blue "></i>';
                    $html .= $v['username'];
                    $html .= '</span> <a href="'.url('User/edit',array('id'=>$v['userid'])).'">';
                    $html .= $v['account'];
                    $html .= '</a>';
                    $html .= $this->getTree($v['userid']);
                    $html = $html."</li>";
               }
            }
            return $html ? '<ul>'.$html.'</ul>' : $html ;
        }
    }

}
