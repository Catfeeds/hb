<?php
namespace app\adminmall\model;

use think\Model;

class Good extends Model
{
	/**
     * 数据库表名
     *
     */
    protected $name = 'good';

    public function goodsave($data){

        $good_id=$data['good_id'];
        if(isset($data['good_image'])){
            $good_image=$data['good_image'];
            unset($data['good_image']);
        }
        
        if(isset($data['item'])){
            $item=$data['item']; //规格名称
            unset($data['item']);
        }
        if(isset($data['price'])){
           $price=$data['price']; //规格价格
            unset($data['price']);
        }
        if(isset($data['store'])){
            $store=$data['store']; //规格库存
            unset($data['store']);
        }
        if(isset($data['att_text'])){
            $att_text=$data['att_text']; //规格值
            unset($data['att_text']);
        }
        if(isset($data['att_value'])){
            $att_value=$data['att_value']; //规格值
            unset($data['att_value']);
        }
        
        
        //修改
        if($good_id){

           //添加规格
            if(isset($item) && count($item)>0){
                $this->addgoodattr($item,$price,$store,$att_text,$att_value,$good_id);
            }else{
                //删除原来的参数
                db('good_price')->where('good_id',$good_id)->delete();
            }
            return $this->where('good_id',$good_id)->update($data);
        }else{ //保存
            $data['status']=1;
            $data['create_time']=time();
            $res = $this->insert($data);
            if($res){
                $good_id=$this->getLastInsID();
                //添加商品图片
                if(count($good_image)>0)
                    $this->addgoodimg($good_image,$good_id);
                //添加规格
                if(isset($item) && count($item)>0){
                   $this->addgoodattr($item,$price,$store,$att_text,$att_value,$good_id);
                }
            }
            return $res;
        }
    }

    /**
     * [addgoodimg 添加商品图片]
     * @param  [type] $data    [description]
     * @param  [type] $good_id [description]
     * @return [type]          [description]
     */
    protected function addgoodimg($data,$good_id){
        $table=db('good_img');
        $post_data=array();
        $post_data['good_id']=$good_id;
        foreach ($data as $k => $val) {
            $post_data['img_url']=$val;
            if($val)
                $table->insert($post_data);
        }
    }

    /**
     * [addgoodattr 添加商品规格]
     * @param  [type] $item  [description]
     * @param  [type] $price [description]
     * @param  [type] $store [description]
     * @return [type]        [description]
     */
    protected function addgoodattr($item,$price,$store,$att_text,$att_value,$good_id){
        // $good_attribute=db('good_attribute');
        $table=db('good_price');
        //删除原来的参数
        $table->where('good_id',$good_id)->delete();

        $data=array();
        $data['good_id']=$good_id;
        foreach ($att_text as $k => $v) {
            $data['price']=$price[$k];
            $data['store']=$store[$k];
            $data['good_attr_value']=trim($att_value[$k]);
            $data['good_attr_text']=str_replace(chr(13),'',trim($v));
            if($v)
                $table->insert($data);
        }
    }
}