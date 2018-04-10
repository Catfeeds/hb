<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Db;

class Sellerapply extends Base
{
   public function apply()
    {
        // 搜索
        $keyword                                  = input('keyword');
        if($keyword!=''){
            $condition                            = array('like', '%' . $keyword . '%');
            $uwhere['username|mobile'] = $condition;
            $uid=Db::name('user')->where($uwhere)->column('userid');
            if($uid)
                $map['uid']=array('in',$uid);
            else
                $map['uid']=0;
        }
       
        //等级
        $user_type=input('user_type');
        if($user_type!=''){
            $map['a.user_type'] = $user_type; 
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

        $type=input('type/d',0);
        $map['status'] = $type; 
       
        $table   = Db::name('seller_apply');
        $data_list     = $table
            ->where($map)
            ->order('id desc')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        return $this->fetch();
    }


    //详情页
    public function detail(){
        $id=input('id/d');
        $table=Db::name('seller_apply');
        $where['id']=$id;
        $info=$table->where($where)->find();
        $u_info=Db::name('user_checkinfo')->where('uid',$info['uid'])->find();
        if($u_info){
            $info=array_merge($info,$u_info);
        }
        $this->assign('info',$info);
        return $this->fetch();
    }

    //修改状态
    public function setDataStatus(){

        $id=input('id/d');
        $agree=input('agree/d');
        $content=input('content');
        if(empty($agree)){
            error('请选择状态');
        }
        if($agree==2 && empty($content)){
            error('请填写拒绝理由');
        }
        if($id){
            $where['id']=$id;
            $where['status']=0;

            $table=Db::name('seller_apply');
            $info=$table->where($where)->find();
            $uid=$info['uid'];
            $count=Db::name('shop_info')->where('uid',$uid)->count(1);
            if($count>0 && $agree==1){
                error('该用户已是商家');
            }
            
            $res=$table->where($where)->setField('status',$agree);
            //添加店铺信息
            if($res && $agree==1){

                Db::name('user')->where('userid',$info['uid'])->update(array('level'=>3,'seller'=>1));

                $data['uid']=$info['uid'];
                $data['shop_name']=$info['shop_name'];
                $data['respon_name']=$info['respon_name'];
                $data['respon_mobile']=$info['respon_mobile'];
                $data['respon_email']=$info['respon_email'];
                $data['province']=$info['province'];
                $data['city']=$info['city'];
                $data['district']=$info['district'];
                $data['addresss_detail']=$info['addresss_detail'];
                $data['create_time']=$info['create_time'];
                $data['industry_id']=','.$info['industry_id'].',';
                $data['fee']=$info['fee'];
                $data['industry_name']=$info['industry_name'];
                $res=Db::name('shop_info')->insert($data);
            }


            if($res){
                success('操作成功',url('apply'));
            }else{
                error('操作失败');
            }
        }
        
    }



    

}
