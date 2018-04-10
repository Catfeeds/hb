<?php


function category_name($id){
    return db('good_category')->where('id',$id)->value('name');
}
