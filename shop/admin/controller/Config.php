<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

/**
 * 系统配置控制器
 * 
 */
class Config extends Base
{
    /**
     * 获取某个分组的配置参数
     */
    public function group($group = 1)
    {
        $map['group']  = array('eq', $group);
        $map['status'] = array('eq', 1);
        $field         = 'id,name,value,tip,type,title';
        $data     = db('Config')->where($map)->field($field)->select();
        $data_list=$this->lists($data); 

        $display=array(1=>'base',2=>'system',3=>'siteclose',4=>'fee');
        $this->assign('info',$data_list);
        // header("Content-type: text/html; charset=utf-8");
        // dump($data_list);die;
        return $this->fetch($display[$group]);
    }

    public function lists($list)
    {
        $arr=array();
        foreach ($list as $key => $val) {
            $arr[$val['name']] = $val['value'];
            $arr[$key]['title'] = $val['title'];
            $arr[$key]['tip'] = $val['tip'];
        }
        return $arr;
    }

    /**
     * 批量保存配置
     * 
     */
    public function groupSave()
    {
        $config=input('post.');
        $config_object = db('Config');
        //如果是文件上传
        // if(!empty($_FILES['WEB_SITE_LOGO']['name'])){
        //     $img1=upload_img('WEB_SITE_LOGO');
        //     if($img1['status']){
        //         $config_object->where('name','WEB_SITE_LOGO')->setField('value',$img1['path']);
        //     }else{
        //         $this->error($img1['error']);
        //     }
        // }
        // if(!empty($_FILES['WEB_WX']['name'])){
        //     $img2=upload_img('WEB_WX');
        //     if($img2['status']){
        //         $config_object->where('name','WEB_WX')->setField('value',$img2['path']);
        //     }else{
        //         $this->error($img2['error']);
        //     }
        // }
        if ($config && is_array($config)) {
            foreach ($config as $name => $value) {
                $map = array('name' => $name);
                // 如果值是数组则转换成字符串，适用于复选框等类型
                if (is_array($value)) {
                    $value = implode(',', $value);
                }
                $config_object->where($map)->setField('value',$value);
            }
        }

        success('保存成功！');
    }

    public function BaseSave(){

      $ids=I('post.ids');
      $limit_num=I('post.limit_num');
      $test=M('limit');
      foreach ($ids as $k => $v) {
        $where['id']=$v;
        $data['limit_num']=$limit_num[$k];
        $test->where($where)->save($data);
      }
      $this->success('保存成功！');
      
   }


    public function sitecloseSave()
    {
        $config=input('post.');
        $key=(array_keys($config));
        
        if ($config && is_array($config)) {
            $map['name']=$key[0];
            $config_object = Db::name('Config');
            $data['value']=$config[$key[0]];
            $data['tip']=$config['tip'];

            $config_object->where($map)->update($data);
        }

        success('保存成功！');
    }

    public function turntable(){
        $info=Db::name('turntable_lv')->order('id')->find();
        $this->assign('info',$info);
       return $this->fetch();
    }

    //保存转盘数据
    public function savezhuanpan(){
        $data = input('post.');
        $info=Db::name('turntable_lv')->where('id=1')->update($data);
        success('保存成功！');
    }
}
