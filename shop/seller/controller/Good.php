<?php
namespace app\seller\Controller;
use think\Controller;
use think\Db;
use think\Config;
/**
 * 商品控制器
 * 
 */
class Good extends Base
{
  protected function _initialize(){

    $uid=seller_login();
    $where['uid']=$uid;
    $count=Db::name('shop_info')->where($where)->count(1);
    if($count==0){
      if(request()->isAjax()){
        $this->success('未设置店面名称，请先设置店铺',url('Setting/index'));
      }else{
        success_alert('未设置店面名称，请先设置店铺',url('Setting/index'));
      }
    }

    parent::_initialize();
  }
    /**
     * 商品列表
     * 
     */
    public function index()
    {
        $map=array();
       // 搜索
        $keyword                                  = input('keyword', '', 'string');
        if($keyword){
            $condition                                = array('like', '%' . $keyword . '%');
            $map['good_id|good_name|good_price'] = $condition;
        }
        
        $map['seller_id']=seller_login();
        $map['good_type']=1;
        $table   = db('good'); 
        $data_list     = $table
            ->where($map)
            ->order('good_sort desc,category_id')
            ->paginate(10,false,['query'=>request()->param()]);

        $this->assign('list',$data_list);
        $page=$data_list->render();
        $this->assign('table_data_page',$page);

        return $this->fetch();
    }

    /**
     * 新增用户
     * 
     */
    public function add()
    {
        //夸控制器调用获取所有商品分类
        $good_type=$this->getGoodtype();
        $arr=array(
            'good_type'     =>  $good_type,
            'good_brand'    =>  $this->brand(),
            'good_model'    =>  $this->goodmodel(),
            );
        $this->assign($arr);
        return $this->fetch();
        
    }

    //品牌信息
    private function brand($selectid=0){
        $db=db('good_brand');
        $info=$db->where('status',1)->order('brand_order desc')->select();
        $str='';
        foreach ($info as $k => $v) {
            if($selectid==$v['id'])
                $str.='<option selected="true" value="'.$v['id'].'" >'.$v['brand_name'].'</option>';
            else
                $str.='<option value="'.$v['id'].'" >'.$v['brand_name'].'</option>';
        }
        return $str;
    }

    //模型信息
    private function goodmodel($selectid=0){
        $db=db('good_model');
        $info=$db->select();
        $str='';
        foreach ($info as $k => $v) {
            if($selectid==$v['id'])
                $str.='<option selected="true" value="'.$v['id'].'" >'.$v['model_name'].'</option>';
            else
                $str.='<option value="'.$v['id'].'" >'.$v['model_name'].'</option>';
        }
        return $str;
    }

    /**
     * 编辑
     * 
     */
    public function edit($id=0)
    {
          $id=input('ids');
          if(!isset($id) || empty($id)){
            return 'false';
          }

          $map['seller_id']=seller_login();
          $map['good_type']=1;
          $map['good_id']=$id;
          // 获取账号信息
          $info = model('Good')->where($map)->find();
          if(empty($info)){
            return 'false';
          }
          //夸控制器调用获取所有商品分类
          $good_type=$this->getGoodtype($info['category_id']);
          //商品图片
          $good_img=db('good_img')->where('good_id',$id)->select();

          $arr=array(
              'good_type'     =>  $good_type,
              'good_brand'    =>  $this->brand($info['brand_id']),
              'good_model'    =>  $this->goodmodel($info['model_id']),
              'info'          =>  $info,
              'good_img'      =>  $good_img,
          );
          $this->assign($arr);
          return $this->fetch();
    }

    public  function getGoodtype($selectpid=0,$pid='0',$dir="")
    {
        $t=db('good_category');
        $list=$t->where(array('pid'=>$pid,'level'=>array('elt',3)))->order('sort_order desc')->select();
        $i=0;
        if(is_array($list)){
            $html = '';
                $i++;
                foreach($list as $k => $v)
                {
                   if($v['pid'] == $pid)
                   {   
                        if($v['level']==2)
                            $dir="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        if($v['level']==3)
                            $dir="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        //父亲找到儿子
                        $html .= '<option value="'.$v['id'].'"';
                        if($selectpid==$v['id'])
                            $html .='selected="true"';
                        $html .= '>';
                        $html .=  $dir;
                        if($v['level']>1){
                            $html  .=  $v['name'];
                        }else{
                             $html .=  $v['name'];
                        }
                        
                        $html .= $this->getGoodtype($selectpid,$v['id'],$dir);
                        $html = $html."</option>";
                   }
                }
            return $html;
        }
    }



    /**
     * [goodsave 保存商品信息]
     * @return [type] [description]
     */
    public function goodsave(){

        if(!request()->isAjax()) {
          $this->error('操作失败'); 
        }

        $data=input('post.');
        //验证数据
        $validate = validate('Good');
        if(!$validate->check($data)){
            $this->error($validate->getError());
        }
        //判断是否选择模型
        if(isset($data['item'])){
            $price=$data['price'];
            $store=$data['store'];
            if(!isset($price) || empty($price)){
              $this->error('请填写商品规格对应的价格');
            }
            foreach ($price as $k => $v) {
              if(empty($v)){
                $this->error('请填写商品规格对应的价格');
                break;
              }
            }
            
            if(!isset($store) || empty($store)){
              $this->error('请填写商品规格对应的库存');
            }

            foreach ($store as $k => $v) {
              if(empty($v)){
                $this->error('请填写商品规格对应的库存');
                break;
              }
            }
        }
        $good=model('good');
        $res=$good->goodsave($data);
        if($res===false)
          $this->error('保存失败'); 
        else
          $this->success('保存成功');

    }



    /**
     * 设置一条或者多条数据的状态
     * 
     */
    public function setStatus()
    {
       $table=Db::name('good');
       $status=input('status');
       $good_id=input('ids/d');
       if(empty($good_id)){
        $this->error('操作失败');
       }
       $where['seller_id']=seller_login();
       $where['good_type']=1;
       $where['good_id']=$good_id;
       if($status=='delete'){ //删除
          $res=$table->where($where)->delete();
          if($res){
            Db::name('good_price')->where('good_id',$good_id)->delete();
            Db::name('good_img')->where('good_id',$good_id)->delete();
            $this->success('删除成功');
          }else{
            $this->error('删除失败');
          }
      }
      if($status=='forbid'){ //下架
        $res=$table->where($where)->setField('status',0);
      }
      if($status=='resume'){ //上架
        $res=$table->where($where)->setField('status',1);
      }
      if($res){
        $this->success('操作成功');
      }else{
        $this->error('操作失败');
      }
        
    }


    

    /**
     * 动态获取商品规格选择框 根据不同的数据返回不同的选择框
     */
    public function ajaxGetSpecSelect(){
        $goods_id = input('goods_id/d') ? input('goods_id/d') : 0;        
        //$_GET['spec_type'] =  13;
        //type_id 模型ID
        $specList = db('good_attribute')->where("model_id",input('spec_type'))->order('attr_order desc')->select();
        // 获取规格项 
        foreach($specList as $k => $v){
             $specList[$k]['spec_item']=explode(',', $v['attr_value']);
        } 

        //商品规格
        if($goods_id){
          $items_value = db('good_price')->where('good_id',$goods_id)->order('id')->value("GROUP_CONCAT(`good_attr_value` SEPARATOR ',') AS items_id");
          $items_value = explode(',', $items_value);       
          $this->assign('items_value',$items_value);
        }
        
        
        $this->assign('specList',$specList);
        return $this->fetch('ajax_spec_select');        
    }

    /**
     * 动态获取商品规格输入框 根据不同的数据返回不同的输入框
     */    
    public function ajaxGetSpecInput(){

        $good_id = input('good_id/d') ? input('good_id/d') : 0;
        $str = $this->getSpecInput($good_id ,input('post.spec_arr/a',[[]]));
        exit($str);   
    }  

    /**
     * 获取 规格的 笛卡尔积
     * @param $goods_id 商品 id     
     * @param $spec_arr 笛卡尔积
     * @return string 返回表格字符串
     */
    private function getSpecInput($good_id, $spec_arr)
    {
        
        // 排序
        $spec_arr_sort=array();
        $spec_arr2=array();
        foreach ($spec_arr as $k => $v)
        {
            $spec_arr_sort[$k] = count($v);
        }
        asort($spec_arr_sort); 
        $spec_arr2 = $spec_arr;       
        
         $clo_name = array_keys($spec_arr2);//列ID
         $spec_arr2 = combineDika($spec_arr2); //  获取 规格的 笛卡尔积    

         $spec = db('good_attribute')->where(array('id'=>array('in',$clo_name)))->order('id')->column('id,attr_name,attr_value'); // 规格表
         // $specItem = db('SpecItem')->getField('id,item,spec_id');//规格项
         if(isset($good_id) && !empty($good_id))
          $keySpecGoodsPrice = db('good_price')->where('good_id',$good_id)->order('id')->column('good_attr_value,good_attr_text,price,store');//规格项

       $str = "<table class='table table-bordered' id='spec_input_tab'>";
       $str .="<tr>";       
       // 显示第一行的数据
       foreach ($clo_name as $k => $v) 
       {
           $str .=" <td><b>{$spec[$v]['attr_name']}</b></td>";
       }
        $str .="<td><b>价格</b></td><td><b>库存</b></td></tr>";
       // 显示第二行开始 
       foreach ($spec_arr2 as $k => $v) 
       {
            $str .="<tr>";
            $item_key_name = '';
            $item_key_value = '';
            foreach($v as $k2 => $v2)
            {
                $str .="<td><input class='read' readonly='true' name='item[$clo_name[$k2]][]' value='{$v2}'  /></td>";
                $item_key_name.=$spec[$clo_name[$k2]]['attr_name'].':'.$v2.',';
                $item_key_value.=trim($v2).',';
                
            }   
            if(isset($keySpecGoodsPrice[trim($item_key_value,',')]['price']))
              $str .="<td><input class='price' name='price[]' value='".$keySpecGoodsPrice[trim($item_key_value,',')]['price']."'  /></td>";
            else
              $str .="<td><input class='price' name='price[]' value=''  /></td>";
            if(isset($keySpecGoodsPrice[trim($item_key_value,',')]['store']))
              $str .="<td><input class='kucun' name='store[]' value='".$keySpecGoodsPrice[trim($item_key_value,',')]['store']."' />";
            else
              $str .="<td><input class='kucun' name='store[]' value='' />";

            $str .="<input type='hidden' name='att_text[]' value='".trim($item_key_name,',')."' /><input type='hidden' name='att_value[]' value='".trim($item_key_value,',')."' /></td>";            
            $str .="</tr>";           
       }
        $str .= "</table>";
       return $str;   
    }


    /**
     * [changeorder 修改排序]
     * @return [type] [description]
     */
    public function changeorder(){
        $id=input('post.id/d');
        $sort_order=input('post.sort_order');
        if(empty($id)){
          $this->error('修改失败');
        }
        if($sort_order==''){
          $this->error('请输入排序值');
        }

        $sort_order=intval($sort_order);
        $table=db('good');
        $where['good_id']=$id;
        $res=$table->where($where)->setField('good_sort',$sort_order);
        if($res)
            $this->success('修改成功');
        else
            $this->error('修改失败');
    }

    /**
     * [delgoodimg 删除商品图片]
     * @return [type] [description]
     */
    public function delgoodimg(){
        $id=input('get.id/d');
        if(isset($id) && !empty($id)){
          if(db('good_img')->delete($id)){
            return true;
          }else{
            return false;
          }
        }
    }

    public function addgoodimg(){
        $good_id=input('post.good_id/d');

        if(isset($good_id) && !empty($good_id)){
            $data['good_id']=$good_id;
            $data['img_url']=input('post.path');
          if(db('good_img')->insert($data)){
            return true;
          }else{
            return false;
          }
        }
    }

}
