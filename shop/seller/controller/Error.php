<?php
namespace app\admin\controller;
use think\Request;

class Error 
{
    public function index(Request $request)
    {
        //根据当前控制器名来判断要执行那个城市的操作
        //$cityName = $request->controller();
        //return $this->city($cityName);
    }
    public function _empty($name){
        return '404';
    }
}
?>