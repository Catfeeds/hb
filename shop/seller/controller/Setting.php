<?php
namespace app\seller\Controller;
use think\Controller;
use think\Db;
use think\Config;
use tree\Tree;
class Setting extends Base{
	public function index(){
		$uid=seller_login();
		$info=Db::name('shop_info')->where('uid',$uid)->find();
		$checkinfo=Db::name('user_checkinfo')->where('uid',$uid)->find();
		if($checkinfo){
			$info=array_merge($info,$checkinfo);
		}

		//店铺分类
		// $industry_id=$info['industry_id'];
		// $arr=explode(',', $industry_id);
		// $where['id']=array('in',$arr);
		// $category=Db::name('industry')->where($where)->value("GROUP_CONCAT(`category_id` SEPARATOR ',')");
		// $list=array();
		// if($category){
		// 	$c_id=explode(',',$category);
		// 	$c_where['id']=array('in',$c_id);
		// 	$data=Db::name('good_category')->where($c_where)->field('id,name,pid')->order('sort_order desc')->select();
		// 	$tree=new Tree();
		// 	$list=$tree->array2tree($data,'name');
			
		// }
		// $this->assign('list',$list);

		$this->assign('info',$info);
		return $this->fetch();
	}


	//店铺设置
	public function setshop(){
		$uid=seller_login();

		if(request()->isAjax()){
            $data=input('post.');

            if(empty($data['shop_logo'])){
            	$this->error('请上传logo');
            }
            if(empty($data['content'])){
            	$this->error('请填写店铺简介');
            }
            if(empty($data['server_tel'])){
            	$this->error('请填写服务电话');
            }
            if(empty($data['work_time'])){
            	$this->error('请填写工作时间');
            }
            if(empty($data['shop_jw'])){
            	$this->error('请填写店铺经纬度');
            }
		     
		     $arr=explode(',', $data['shop_jw']);
		     unset($data['shop_jw']);
		     $data['shop_j']=$arr[0];
		     $data['shop_w']=$arr[1];

		    $res=Db::name('shop_info')->field("shop_logo,content,work_time,server_tel,shop_img,shop_j,shop_w")->where('uid',$uid)->update($data);
		    if($res)
		    	$this->success('操作成功');
		    else
		    	$this->error('操作失败');
        }



		$s_info=Db::name('shop_info')->where('uid',$uid)->field('shop_name,shop_logo,content,work_time,server_tel,shop_img,shop_j,shop_w')->find();
		$s_info['shop_jw']='';
		if($s_info['shop_j'] && $s_info['shop_w']){
			$s_info['shop_jw']=$s_info['shop_j'].','.$s_info['shop_w'];
		}
		$this->assign('s_info',$s_info);
		return $this->fetch();
	}


	//修改店铺名称
	public function updateshop(){
		$value=input('post.value');
		$type=input('post.type/d');

		if(empty($value)){
			$this->error('请输入名称');
		}
		if($type==1){
			$field='shop_name';
		}elseif ($type==2) {
			$field='shop_logo';
		}

		$uid=seller_login();
		$table=Db::name('shop_info');
		$where['uid']=$uid;
		$count=$table->where($where)->count(1);
		if($count>0){ //修改
			$res=$table->where($where)->setField($field,$value);
		}else{ //添加
			$data['uid']=$uid;
			$data[$field]=$value;
			$res=$table->insert($data);
		}
		if($res)
			$this->success('操作成功');
		else
			$this->error('操作失败');
	}

}
?>