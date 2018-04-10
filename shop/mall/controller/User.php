<?php
namespace app\mall\controller;
use think\Controller;
use think\Db;
use app\home\controller\Common;
class User extends Common
{
    public function usercenter()
    {
      $userid=user_login();
      $u_info=Db::name('user')->where('userid',$userid)->field('username,account,head_img')->find();

      //订单状态
      $where['user_id']=$userid;
      $where['order_status']=array('in',array(0,1,2));
      $arr=Db::name('order')->where($where)->group('order_status')->order('order_status asc')->column('order_status,count(1) as tt');

      $order['pay_count']=isset($arr[0]) ? $arr[0]:'0';
      $order['waitf_count']=isset($arr[1]) ? $arr[1]:'0';
      $order['waits_count']=isset($arr[2]) ? $arr[2]:'0';

    	$to_html=array(
    		'title'   =>  '用户中心',
        'u_info'  =>  $u_info,
        'order'   =>  $order,
    	);
    	$this->assign($to_html);
        return $this->fetch() ;
    }

    //用户地址
    public function listaddress(){
      //判断访问路径
      $type=input('type');
      if($type)
        session('cometype',$type);
      
    	$table=db('user_address');
    	$userid=user_login();
    	$where['user_id']=$userid;
    	$list=$table->where($where)->select();
    	$this->assign('list',$list);
    	$this->assign('title','收货地址');
    	return $this->fetch() ;
    }
    //用户地址
    public function editaddress(){

    	$id=input('id/d');
    	if($id){
    		$userid=user_login();
    		$where['user_id']=$userid;
    		$where['id']=$id;
    		$table=db('user_address');
    		$info=$table->where($where)->find();
    		$this->assign('info',$info);
    	}
    	$this->assign('title','收货地址');
    	return $this->fetch() ;
    }

    //保存地址
    public function saveaddress(){
    	$post_data=input('post.');

    	//+++验证数据++S+
        $rule = [
            'username'  	=> 'require',
            'usermobile' 	=> 'require',
            'sheng' 		=> 'require',
            'shi' 			=> 'require',
            'xian' 			=> 'require',
            'detail' 		=> 'require',
        ];
        $msg=[
            'username.require'    	=> '收货人不能为空',
            'usermobile.require'    => '联系电话不能为空',
            'sheng.require' 		=> '请选择所在地区',
            'shi.require' 			=> '请选择所在地区',
            'xian.require' 			=> '请选择所在地区',
            'detail.require' 		=> '详细地址不能为空',
        ];
        $res=$this->validate($post_data,$rule,$msg);
        if(true !== $res){
           error($res);
        }
        //+++验证数据++E+
       	$data=array();
       	$data['user_id']=user_login();
       	$data['user_name']=$post_data['username'];
       	$data['user_mobile']=$post_data['usermobile'];
       	$data['province']=$post_data['sheng'];
       	$data['city']=$post_data['shi'];
       	$data['district']=$post_data['xian'];
       	$data['detail_address']=$post_data['detail'];
       	$data['is_default']=isset($post_data['default']) ? $post_data['default']:0;
       	$table=db('user_address');
       	//修改 
       	if(!empty($post_data['id'])){
       		$id=intval($post_data['id']);
       		$res=$table->where('id',$id)->update($data);
       	}else{
	       	$res=$table->insert($data);
	       	$id=$table->getLastInsID();
       	}
       	if($res){
       		//修改默认
       		if(isset($post_data['default']) && $post_data['default']==1){
       			$where=array();
       			$where['id']=array('neq',$id);
       			$where['is_default']=1;
       			$table->where($where)->setField('is_default',0);
       		}
       		success('保存成功',url('listaddress'));
       	}else{
       		error('保存失败');
       	}
    }

    //个人资料
    public function userinfo(){
        $userid=user_login();
        $u_info=Db::name('user')->where('userid',$userid)->field('username,account,head_img,mobile,reg_date')->find();

        $this->assign('title','个人资料');
        $this->assign('u_info',$u_info);
       return $this->fetch();
    }


    //客服
    public function service(){
      $info=Db::name('config')->where('group',1)->column('value','name');
      $this->assign('info',$info);
      $this->assign('title','客服');
      return $this->fetch();
    }

    //新手上路
    public function userhelp(){
      $list=Db::name('article')->field('title,id')->where('type','3')->order('id desc')->select();
      $this->assign('list',$list); 
      $this->assign('title','新手上路'); 
      return $this->fetch();
    }


    //新手帮助详情
    public function helpdetail(){
      $id=input('id/d');
      if($id){
        $info=Db::name('article')->where('id',$id)->find();
        $this->assign('info',$info);
        $this->assign('title','新手上路'); 
        return $this->fetch();
      }
    }


    
    //个人钱包
    public function wallet(){
      $uid=user_login();
      $info=Db::name('user_wealth')->field('money,integral,anzi')->where('uid',$uid)->find();

       //银行卡数量
        $count=db('user_bank')->where('uid',$uid)->count(1);
        $info['bank_count']=$count;
        $info['coupon_count']=0; //优惠卷数量

      $this->assign('info',$info);
      $this->assign('title','个人钱包');
      return $this->fetch();
    }


}
