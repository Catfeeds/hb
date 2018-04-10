<?php
//获取分类名称
function category_name($id){
    return db('good_category')->where('id',$id)->value('name');
}


//热卖商品
function goodlist($where,$limit,$order='good_sort desc'){
	$where['status']=1;
	$list=db('good')->field('good_id,good_name,good_cover_img,good_price,market_price')->where($where)->order($order)->limit($limit)->select();
	return $list;
}

//获取商品名单
function get_shop_name($value){
	if($value){
		$name=db('shop_info')->where('uid',$value)->value('shop_name');
	}
	else
		$name=site_info('WEB_SITE_NAME').'(自营)';
	return $name;
}

//获取店铺联系人的电话
function get_shop_mobile($value){
	if($value){
		$mobile=db('shop_info')->where('uid',$value)->value('server_tel');
	}
	else{
		$mobile=db('config')->where('id',9)->value('value');
	}
	return $mobile;
}
