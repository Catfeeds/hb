<?php
namespace app\adminmall\validate;
use think\Validate;
use think\Db;

class Good extends Validate
{
    // 验证规则
    protected $rule = [
        'good_name'             => 'require',
        'good_no'            	=> 'unique:good',
        'category_id'           => 'require',
        'good_store'			=> 'require',
        'good_price'			=> 'require',
        'good_cover_img'        => 'require',
    ];
    //错误信息
    protected $message  = [
        'good_name.require'       => '商品名称不能为空',
        'category_id.require'     => '请选择商品分类',
        'good_price.require'      => '密码不能为空',
        'good_store.require'      => '商品库存不能为空',
        'good_cover_img.require'  => '商品封面图不能为空',
        'good_no.unique'          => '商品编号已存在',
    ];
    //应用场景，添加或修改
    protected $scene = [
        'add'  					=>  [],
        'edit' 					=>  [],
    ];
}