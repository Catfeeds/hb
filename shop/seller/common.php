<?php

/**
 * 检测用户是否登录
 */
function seller_login()
{
    return model('Seller/user')->user_login();
}


function category_name($id){
    return db('good_category')->where('id',$id)->value('name');
}