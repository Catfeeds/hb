<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Db;

class Rechargedetail extends Base
{
   public function index()
    {
        $map=array();
        $map['status']=1;
        // 搜索
        $keyword                      = input('keyword');
        if($keyword!=''){
            $condition                = array('like', '%' . $keyword . '%');
            $map['username|mobile'] = $condition;
        }
        $type=input('type');
        if($type){
            $map['type']=$type;
        }

        $paytype=input('paytype');
        if($paytype){
            $map['paytype']=array('like', '%' . $paytype . '%');
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
       
        $table     = Db::name('money_recharge');

        //统计总金额
        $total=$table->where($map)->sum('money');

        $data_list = $table
            ->where($map)
            ->order('id desc')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        $this->assign('total',$total);
        return $this->fetch();
    }



    //修改状态
    public function setDataStatus(){

        $id=input('id/d');
        $reply=input('reply');
        $status=input('status');
        if($id && $status>0){
            $table=Db::name('money_recharge');
            $where['id']=$id;
            $where['status']=0;
            $where['type']='underline';
            $info=$table->where($where)->find();
            if(empty($info)){
                error('操作失败');
            }

            $data['status']=$status;
            $data['reply']=$reply;
            $data['admin_id']=admin_login();
            $res=$table->where($where)->update($data);
            //通过,给用户添加金额
            if($res && $status==1){
                $uid=$info['uid'];
                $total=$info['money'];
                $res=Db::name('user_wealth')->where('uid',$uid)->setInc('money',$total);
                if($res){
                    $detail['content']='线下充值'.$total;
                    $detail['from_type']=1; //1-转入 2-转出
                    $detail['type']='underline';
                    $detail['type_name']='线下充值';
                    $detail['uid']=$uid;
                    $detail['create_time']=time();
                    $detail['status']=1;
                    $detail['money']=$total;
                    $detail['money_record']=Db::name('user_wealth')->where('uid',$uid)->value('money');
                    Db::name('money_detail')->insert($detail);
                }

            }   

            if($res){
                success('操作成功',url('index'));
            }else{
                error('操作失败');
            }
        }
        
    }


}
