<?php
namespace app\seller\Controller;
use think\Controller;
use think\Db;
use think\Config;

class Order extends Base
{


    //文章列表页
    public function index()
    {
       // 搜索
        $map=array();
        $keyword    = input('keyword', '');
        $querytype  = input('querytype','');
        $order_status     = input('order_status',0);
        if($keyword && $querytype){
            if($querytype=='mobile' || $querytype=='username'){
                $u_where[$querytype]=array('like', '%' . $keyword . '%');
                $uid_arr=Db::name('user')->where($u_where)->column('userid');
                if($uid_arr)
                    $map['user_id']=array('in',$uid_arr);
                else
                    $map['user_id']=0;
            }else{
                $condition = array('like', '%' . $keyword . '%');
                $map[$querytype] = $condition;
            }
        }
        
        //按日期搜索
        $date=date_query('order_create_time');
        if($date){
            $where=$date;
            if(isset($map))
                $map=array_merge($map,$where);
            else
                $map=$where;
        }

        if($order_status!=''){
             $map['order_status']=$order_status;
        }
        $map['seller_id']=seller_login();
        $table   = Db::name('order'); 

        $data_list     = $table
            ->field('order_id,order_no,user_name,user_mobile,order_total_price,order_create_time,order_status')
            ->where($map)
            ->order('order_id desc')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        return $this->fetch();
    }

    
    //详情
    public function detail(){
        $order_id=input('order_id/d');
        $where['order_id'] = $order_id;
        $info=Db::name('order')->where($where)->find();
        $u_info=Db::name('user')->where('userid',$info['user_id'])->field('mobile,username')->find();
        if($u_info){
            $info=array_merge($info,$u_info);
        }
        $list=Db::name('order_detail')->where($where)->select();

        $this->assign('list',$list);
        $this->assign('info',$info);

        return $this->fetch();
    }


    //删除文章
    public function delete(){
        $this->error('删除失败');
        $order_id  = input('order_id/d');//传过来的新闻id
        if(empty($order_id)){
            $this->error('删除失败');
        }    
        $where['order_id'] = $order_id; 
        $where['seller_id']=seller_login(); 
        $res = Db::name('order_detail')->where($where)->delete(); 
        if($res){
            $where['order_status'] = 0; 
            $res = Db::name('order')->where($where)->delete(); 
        }  
                               
        if ($res){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        } 
    }


    public function save(){
        $order_id=input('order_id/d');
        $order_status=input('order_status/d');

        if(empty($order_status)){
            $this->error('请选择订单状态');
        }
        if($order_id){
            $where['order_id']=$order_id;
            $where['seller_id']=seller_login(); 
            $where['order_status']=array('lt',$order_status);
            $status=Db::name('order')->where($where)->value('order_status');
            if($status==0){
               $this->error('订单未支付不可修改'); 
            }

            if($order_status!=2){
              $this->error('不可修改'); 
            }
            //如果是发货，填写发货时间
            if($order_status==2){
                $data['order_ship_time']=time();
                $data['order_status']=2;
                $res=Db::name('order')->where($where)->update($data);
            }else{
                $res=Db::name('order')->where($where)->setField('order_status',$order_status);
            }

            if($res)
                $this->success('操作成功',url('index',array('order_status'=>$status)));
            else
                $this->error('操作失败');
        }
    }



}
