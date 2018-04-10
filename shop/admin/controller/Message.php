<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Message extends Base
{


    //文章列表页
    public function index()
    {
         //搜索
        $map=array();
        $map['send']=1;
        $keyword                  = input('keyword', '', 'string');
        if($keyword){
            $condition            = array('like', '%' . $keyword . '%');
            $map['title'] = $condition;
        }
        
        $user_object   = db('message'); 

        $data_list     = $user_object
            ->where($map)
            ->order('id desc')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);
        $this->messagetype();
        return $this->fetch();
    }

    //添加文章页
    public function add(){   
        $id=input('ids');
        if(isset($id)){
            $info = db('message')->find($id);
            if($info['uid']){
                $info['mobile']=Db::name('user')->where('userid',$info['uid'])->value('mobile');
            }
            
            $this->assign('info',$info);
        }
        $this->messagetype();
        return $this->fetch();      
    }

    private function messagetype(){

        $arr=array(1=>'通知消息',2=>'交易信息',3=>'活动信息',4=>'资产信息');
        $this->assign('typelist',$arr);

    }


    //保存文章
    public function save(){

          if (request()->isAjax()) {
                $table = db('message');
                $data  = input('post.');         
                if(empty($data['type'])){
                   error('分类不能为空');
                }
                if(empty($data['title'])){
                   error('标题不能为空');
                }
                //修改
                $data['create_time']=time();
                $data['status']=0;
                $data['send']=1;

                $mobile=$data['mobile'];
                if($mobile){
                    $userid=Db::name('user')->where('mobile',$mobile)->value('userid');
                    if(empty($userid)){
                        error('指定用户不存在');
                    }
                    $data['uid']=$userid;
                }
                    unset($data['mobile']);
                

                if(isset($data['id']) && !empty($data['id'])){               
                    $up = $table->update($data);
                }else{ //添加                           
                    $up = $table->insert($data);
                }
                if ($up===false) {
                    error('保存失败');
                } else {
                    success('保存成功', url('index'));
                } 
            }
    }

    //删除文章
    public function delete(){
            $id  = input('ids');//传过来的新闻id    
            $where['id'] = $id;      
            $where['send'] = 1;      
            $dltnews = db('message')->where($where)->delete();                    
            if ($dltnews===false){
                error('删除失败');
            }else{
                success('删除成功');
            } 
    }





}
