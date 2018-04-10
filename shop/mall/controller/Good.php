<?php
namespace app\mall\controller;
use think\Controller;
use think\Db;
class Good extends controller
{
    public function details()
    {
    	$good_id=input('good_id/d');
    	if($good_id){
			$where['status']=1;
            $where['good_id']=$good_id;
			$info=db('good')->field('good_id,good_name,good_price,good_sell_num,good_integral,ship_fee,good_cover_img,good_weight,seller_id,good_type,good_content,category_id,good_sort,good_comment,good_store')->where($where)->find();
            //产品图片
            $list_img=db('good_img')->where('good_id',$good_id)->order('id')->select();
            if(count($list_img)==0){
                $list_img[0]['img_url']=$info['good_cover_img'];
            }
            $this->assign('info',$info);
			$this->assign('list_img',$list_img);
            //规格
            $this->goodattr($good_id);


            //相关产品 猜你喜欢
            $this->RelatedGood($info['category_id']);

            //产品评论
            $comment=db('good_comment')->where('good_id',$good_id)->order('id desc')->limit(3)->select();
            $comment_count=count($comment);
            $this->assign('comment_count',$comment_count);
            $this->assign('comment',$comment);

            //获取店铺信息
            if($info['seller_id']>0){
                $shop_info=Db::name('shop_info')->where('uid',$info['seller_id'])->field('shop_name,shop_logo')->find();
                $this->assign('shop_info',$shop_info);
            }
            

        }
        
    	$this->assign('title','产品详情');
        return $this->fetch();
    }



    private function RelatedGood($type_id){
        if($type_id){
            $c_where['pid_path']=array('like','%-'.$type_id.'-%');
            $type_arr=db('good_category')->where($c_where)->column('id');
            if(count($type_arr)>0){
                $where['category_id']=array('IN',$type_arr);
                $where['status']=1;
                $list=db('good')->field('good_id,good_cover_img,good_price')->where($where)->order('good_sort desc,is_recommend desc,is_new desc,is_hot desc')->limit(3)->select();
                $this->assign('relate_list',$list);
            }
        }
    }

    //产品规格
    private function goodattr($good_id){
        $db=db('good_price');
        $info=$db->field('good_attr_value,good_attr_text')->where('good_id',$good_id)->order('id')->select();
        $top_arr=array();
        $data=array();
        $ext_arr=array();
        foreach ($info as $k => $val) {
            $top_arr=explode(',', $val['good_attr_text']);
            foreach ($top_arr as $k => $v) {
                $arr=array();
                $arr=explode(':', $v);
                $value=$arr[1];
                if(!in_array($value, $ext_arr)){
                    $data[$arr[0]][]=$value;
                }
                $ext_arr[]=$value;
            }
        }

         $this->assign('attr_list',$data);
    }

    //获取商品价格库存
    public function getpricestore(){
        if(!request()->isAjax()){
            return false;
        }
        $good_id = input("good_id/d"); // 商品id
        $item = input("item/a"); // 商品规格id
        $item = implode(',',$item);
        $db=db('good_price');

        $where['good_attr_value']=$item;
        $where['good_id']=$good_id;
        $info=$db->field('id,price,store')->where($where)->find();
        if(!empty($info)){
            $data['status']=1;
            $data['result']=$info;
            
        }else{
            $data['status']=$db->getlastsql();
        }
        echo json_encode($data); 
    }



    //商品评论列表
    public function goodcomment(){
        $good_id=input('good_id/d');
        if($good_id){
            //产品评论
            $table=db('good_comment');
            $where['good_id']=$good_id;
            $list['all']=$table->field('username,star_ability,star_attitude,star_price,content,good_item,create_time')->where($where)->order('id desc')->select();
            $where['level']=0;
            $list['low']=$table->field('username,star_ability,star_attitude,star_price,content,good_item,create_time')->where($where)->order('id desc')->select();
            $where['level']=1;
            $list['middle']=$table->field('username,star_ability,star_attitude,star_price,content,good_item,create_time')->where($where)->order('id desc')->select();
            $where['level']=2;
            $list['high']=$table->field('username,star_ability,star_attitude,star_price,content,good_item,create_time')->where($where)->order('id desc')->select();
            $this->assign('list',$list);
            $this->assign('title','所有评论');
            return $this->fetch();
        }
    }


    //收藏商品
    public function collectgood(){
        if(!request()->isAjax()){
            return false;
        }
        //判断用户是否登录
        if(!user_login()){
            error('您未登录，请先登录');
        }

        $good_id=input('good_id/d');
        if($good_id){
            $uid=user_login();
            $data['uid']=$uid;
            $data['good_id']=$good_id;
            $count=db('good_collect')->where($data)->count(1);
            if($count>0){
                error('已收藏此商品');
            }

            $data['create_time']=time();
            $res=db('good_collect')->insert($data);
            if($res)
                success('收藏成功');
            else
                error('收藏失败');
        }
        
    }
    

}
