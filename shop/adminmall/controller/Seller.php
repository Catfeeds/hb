<?php
namespace app\adminmall\controller;
use think\Controller;
use think\Session;
use think\Db;
use app\admin\controller\Base;

class Seller extends Base
{
    public function index()
    {
        $map=array();

        $keyword    = input('keyword', '');
        if($keyword){
            $map['shop_name']=array('like','%'.$keyword.'%');
        }
       

        //按日期搜索
        $date=date_query('create_time');
        if($date){
            $where=$date;
            if(isset($map))
                $map=array_merge($map,$where);
            else
                $map=$where;
        }
        
        $list=Db::name('shop_info')->where($map)->order('uid desc')->paginate(10);
        $this->assign('list',$list);
        $this->assign('table_data_page',$list->render());
        return $this->fetch();
    }


    //详情页
    public function detail(){
        $id=input('id/d');
        $info=Db::name('shop_info')->where('uid',$id)->find();
        $c_info=Db::name('user_checkinfo')->where('uid',$info['uid'])->find();
        if($c_info){
            $info=array_merge($info,$c_info);
        }
        $u_info=Db::name('user')->field('user_type,username,mobile')->where('userid',$id)->find();
        if($u_info){
            $info=array_merge($info,$u_info);
        }
        $this->assign('info',$info);
        return $this->fetch();
    }

    //商家列表
    public function sellerlist(){

        // 搜索
        $keyword    = input('keyword', '', 'string');
        $querytype  = input('querytype','account','string');
        $map['a.seller']=1;
        if($keyword){
            $condition = array('like', '%' . $keyword . '%');
            $map[$querytype] = $condition;
        }
        
        //按日期搜索
        $date=date_query('reg_date');
        if($date){
            $where=$date;
            if(isset($map))
                $map=array_merge($map,$where);
            else
                $map=$where;
        }

        // 获取所有用户
        $user   = db('user a');
        if(!isset($map)){
            $map=true;
        }

        //分页
        $table=$user;
        $data_list     = $table
            ->join(config('prefix').'user_wealth b','a.userid = b.uid','LEFT')
            ->field('a.userid,a.username,a.email,a.account,a.mobile,a.reg_date,a.status,a.pid,a.level,a.user_type,b.money,b.integral,b.anzi')
            ->where($map)
            ->order('a.userid desc')
            ->paginate(10);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        
        $this->assign('table_data_page',$page);
       return $this->fetch(); 
    }

}
