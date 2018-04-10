<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Db;

class Useradvice extends Base
{
   public function index()
    {
        // 搜索
        $keyword                                  = input('keyword');
        if($keyword!=''){
            $condition                                = array('like', '%' . $keyword . '%');
            $map['username|account'] = array(
                $condition,
                $condition,
                '_multi' => true,
            );
        }
        

        $map['status'] = array('neq', '2'); 
        $type=input('type');
        if($type=='over'){
           $map['status'] = array('eq', '2');  
        }
        $table   = Db::name('user_advice');

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
    public function edit(){
        $id=input('id/d');
        $letter=Db::name('user_advice');
        $where['id']=$id;
        if($letter->where($where)->value('status')==0){
            $letter->where($where)->setField('status',1);
        }
        $value=$letter->where($where)->find();
        $this->assign('info',$value);
        return $this->fetch();
    }


     //保存回复
    public function savemessage(){
        $reply=input('reply');
        $id=input('id',0,'intval');
        if(empty($id)){
            error('参数错误');
        }
        if(empty($reply)){
            error('请填写回复内容');
        }

        $uid=Db::name('user_advice')->where('id',$id)->value('userid');
        $res=Db::name('user_advice')->where('id',$id)->setField('status',2);
        if($res){

            $data['content']=$reply;
            $data['title']='反馈回复';
            $data['uid']=$uid;
            $data['create_time']=time();
            $data['status']=0;
            $data['type']=1;
            $res=Db::name('message')->insert($data);
        }
       
        if($res){
            success('操作成功',url('index'));
           
        }else{
          error('操作失败');
        }
    }

    #站内信之单独删除
     public function delete(){
        $letter=Db::name('user_advice');
        $id=input('id/d');
        $bool=$letter->delete($id);
        if($bool){
            success('删除成功');
        }else{
            error('删除失败');
        }

    }

}
