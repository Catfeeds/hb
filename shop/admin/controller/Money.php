<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Db;

class Money extends Base
{
   public function index()
    {
        $map=array();
        // 搜索
        $keyword                      = input('keyword');
        if($keyword!=''){
            $condition                = array('like', '%' . $keyword . '%');
            $map['username|mobile'] = $condition;
        }
        $status=input('status/d',0);
        $map['status']=$status;

        $type=input('type');
        if($type){
            $map['type']=$type;
        }
        $feetime=input('feetime');
        if($feetime!=''){
            $map['fee_time']=$feetime;
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
       
        $table     = Db::name('money_get');
        $data_list = $table
            ->where($map)
            ->order('id desc')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        return $this->fetch();
    }



    //修改状态
    public function setDataStatus(){

        $id=input('id/d');
        $reply=input('reply');
        $status=input('status');
        if($id && $status>0){
            $table=Db::name('money_get');
            $where['id']=$id;
            $where['status']=0;
            $info=$table->where($where)->find();
            if(empty($info)){
                error('操作失败');
            }

            $data['status']=$status;
            $data['reply']=$reply;
            $data['admin_id']=admin_login();
            $res=$table->where($where)->update($data);

            //华宝提现，奖励购物券
            if($res && $status==1){
                if($info['type']==2)
                    $coupon=$info['money']*0.07/100;
                else
                   $coupon=$info['money']*0.07;

                $this->addcoupon($info['uid'],$coupon);
            }

            //拒绝,退回金额
            if($res && $status==2){
                $uid=$info['uid'];
                $total=$info['money'];
                if($info['type']==1){
                    $res=Db::name('user_wealth')->where('uid',$uid)->setInc('money',$total);
                    if($res){
                        $detail['content']='提现审核不通过，退回'.$total;
                        $detail['from_type']=1; //1-转入 2-转出
                        $detail['type']='moneyback';
                        $detail['type_name']='提现失败';
                        $detail['uid']=$uid;
                        $detail['create_time']=time();
                        $detail['status']=1;
                        $detail['money']=$total;
                        $detail['money_record']=Db::name('user_wealth')->where('uid',$uid)->value('money');
                        Db::name('money_detail')->insert($detail);
                    }
                }else{
                    $res=Db::name('user_wealth')->where('uid',$uid)->setInc('anzi',$total);
                    if($res){
                        $detail['content']='提现审核不通过，退回'.$total;
                        $detail['from_type']=1; //1-转入 2-转出
                        $detail['type']='moneyback';
                        $detail['type_name']='提现失败';
                        $detail['uid']=$uid;
                        $detail['create_time']=time();
                        $detail['status']=1;
                        $detail['money']=$total;
                        $detail['money_record']=Db::name('user_wealth')->where('uid',$uid)->value('anzi');
                        Db::name('anzi_detail')->insert($detail);
                    }
                }

                //发送信息
                if($reply){
                    $msg['create_time']=time();
                    $msg['status']=0;
                    $msg['send']=1;
                    $msg['uid']=$uid;
                    $msg['content']=$reply;
                    $msg['type']=1;
                    $msg['title']='提现审核';
                    db('message')->insert($msg);
                }
                
            }   

            if($res){
                success('操作成功',url('index'));
            }else{
                error('操作失败');
            }
        }
        
    }


    private function addcoupon($uid,$num){
        $total=$num;
        $res=Db::name('user_wealth')->where('uid',$uid)->setInc('coupon',$total);
        if($res){
            $detail['content']='提现返'.$total;
            $detail['from_type']=1; //1-转入 2-转出
            $detail['type']='moneyback';
            $detail['type_name']='提现返还';
            $detail['uid']=$uid;
            $detail['create_time']=time();
            $detail['status']=1;
            $detail['money']=$total;
            $detail['money_record']=Db::name('user_wealth')->where('uid',$uid)->value('coupon');
            Db::name('coupon_detail')->insert($detail);
        }
    }


}
