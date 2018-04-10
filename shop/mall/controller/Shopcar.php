<?php
namespace app\mall\controller;
use think\Controller;
use think\Db;
use app\home\controller\Common;
class Shopcar extends Common
{
    public function index(){

        $car_data=array();
    	$car_data=$this->car_good();
    	$to_html=array(
    		'title' => '购物车',
    		'list'  => $car_data,
    	);
    	$this->assign($to_html);
        return $this->fetch() ;
    }

    //获取session商品
    private function car_good(){
    	$car_goods=session('car_data');
        if(empty($car_goods)){
            return false;
        }
    	$db=db('good');
    	$good_price=db('good_price');
    	$total_price=0;
    	$total_num=0;
        $arr=array();
        $good_list=array();
    	foreach ($car_goods as $key => $val) {
            $good=array();
    		$info=array();
    		$info=$db->field('good_name,good_cover_img,good_price,good_store,seller_id')->find($val['good_id']);
            
            $good['good_id']=$val['good_id'];
            $good['good_num']=$val['good_num'];
            $good['attr_id']=$val['attr_id'];
    		$good['good_name']=$info['good_name'];
    		$good['good_cover_img']=$info['good_cover_img'];
    		if(empty($val['attr_id'])){
    			$good['good_price']=$info['good_price'];
    			$good['good_store']=$info['good_store'];
    			$total_price+=$info['good_price']*$val['good_num'];
    			$total_num+=$val['good_num'];
    		}
    		else
    		{
    			$where=$arr=array();
    			$where['good_id']=$val['good_id'];
    			$where['id']=$val['attr_id'];
    			$arr=$good_price->where($where)->find();
    			$good['good_price']=$arr['price'];
    			$good['good_store']=$arr['store'];
    			$good['good_attr']=$arr['good_attr_text'];
    			$total_price+=$arr['price']*$val['good_num'];
    			$total_num+=$val['good_num'];
    		}
            $good['seller_id']=$info['seller_id'];
            $good_list[$info['seller_id']][]=$good;
    	}
    	$data['total_price']	=	$total_price;
    	$data['total_num']		=	$total_num;
    	$data['good_list']		=	$good_list;
    	return $data;
    }


    /**
     * ajax 将商品加入购物车
     */
    public function ajaxaddcart(){
        if(!request()->isAjax()){
            return false;
        }

        //判断用户是否登录
        if(!user_login()){
            error('您未登录，请先登录',url('home/Login/login'),2);
        }
        $good_id = input("good_id/d"); // 商品id
        $good_num = input("good_num/d");// 商品数量
        $attr_id = input("attr_id/d"); // 商品规格id
        if(empty($good_id)){
            error('请选择要购买的商品');
        }
        if(empty($good_num) || $good_num<0){
            error('购买商品数量不能为0');
        }
        $good=model('Good');
        //判断商品是否存在
        if(empty($good->isExistGood($good_id))){
            error('购买商品不存在');
        }
        //判断商品是否有规格
        $price_table=db('good_price');
        $count=$price_table->where('good_id',$good_id)->count(1);
        if($count>0){
           if(count($attr_id)<=0){
               error('请选择商品规格');
            }else{
               $price_info=$price_table->where('id',$attr_id)->find();
               if(empty($price_info) || count($price_info)==0){
                error('请选择商品规格');
               }else{
                 //判断库存是否足够
                  if($price_info['store']<$good_num){
                    error('商品库存不足');
                  } 
               }
            } 
        }else{
            //没有规格,查库存是否足够
            $good_store=$good->where('good_id',$good_id)->value('good_store');
            if($good_store<$good_num){
               error('商品库存不足'); 
            }
        }

        $data=array();
        $data['good_id']=$good_id;
        $data['good_num']=$good_num;
        $data['attr_id']=$attr_id;
        //保存session
        $car_goods=session('car_data');
        //此商品不在购物车
        if(empty($car_goods)){
            $car_goods[]=$data;
        }else{

            $is=0;
            foreach ($car_goods as $k => $v) {
              //商品已存在,修改数量
              if($v['good_id']==$good_id && empty($attr_id)){
                $is=1;
                $car_goods[$k]=$data;
              }
              elseif($v['good_id']==$good_id && !empty($attr_id) && $v['attr_id']==$attr_id)
              {
                $is=1;
                $car_goods[$k]=$data;
              }
            }
            if($is==0)
            {
                $car_goods[$k+1]=$data;
            }
        }
        session('car_data',$car_goods);
        $car_goods=session('car_data');
        
        success($car_goods,url('Shopcar/index'));
    }


    public function ajaxdeletecart(){
    	if(!request()->isAjax()){
            return false;
        }

        $good_id = input("good_id/d"); // 商品id
        $attr_id = input("attr_id/d"); // 商品规格id

        $data=array();
        $data['good_id']=$good_id;
        $data['attr_id']=$attr_id;

        //保存session
        $car_goods=session('car_data');
        //此商品不在购物车
        if(!empty($car_goods) || count($car_goods)>0){
            foreach ($car_goods as $k => $v) {
              //商品已存在,修改数量
              if($v['good_id']==$good_id && empty($attr_id)){
                unset($car_goods[$k]);
              }
              elseif($v['good_id']==$good_id && !empty($attr_id) && $v['attr_id']==$attr_id)
              {
                unset($car_goods[$k]);
              }
            }

        }
        session('car_data',$car_goods);
        return 1;

    }

    //去结算
    public function goorder(){
        //判断用户是否登录
        if(!user_login()){
            success_alert('您未登录，请先登录',url('home/Login/login'));
        }

        $car_data=$this->car_good();
        if(empty($car_data['good_list'])){
           error_alert('暂无商品，请重新下单');
        }

        //选择收货地址
        $id=input('id/d');
        $where['user_id']=user_login();
        if($id)
            $where['id']=$id;
        else
            $where['is_default']=1;
        $address=db('user_address')->where($where)->find();

    	$to_html=array(
    		'title'   => '购物车-结算',
    		'list'    => $car_data,
            'address' => $address,
    	);
    	$this->assign($to_html);
        return $this->fetch() ;
        
    }


    //生成订单
    public function saveorder(){
        if(request()->isAjax()){

            if(!user_login()){
                error('您未登录，请先登录');
            }

            $address_id=input('post.address_id/d');
            $order_user_note=input('post.content/a');

            if(!isset($address_id) || empty($address_id)){
                error('请选择收货地址');
            }
            $userid=user_login();
            $address=db('user_address')->where('id',$address_id)->where('user_id',$userid)->find();
            if(empty($address)){
                error('收货地址不存在');
            }

            //获取session内商品id
            $car_goods=session('car_data');
            if(empty($car_goods) || count($car_goods)==0){
                error('暂无商品，请去购买');
            }

            $db=db('good');
            $good_price=db('good_price');
            $total_price=0;
            $data=array();
            $seller_data=array();
            $i=0;
            $msg='';
            foreach ($car_goods as $key => $val) {
                $total=0;
                $good=array();
                $info=array();
                $info=$db->where('good_id',$val['good_id'])->where('status',1)->field('good_id,good_name,good_cover_img,good_price,good_store,good_no,market_price,cost_price,good_integral,seller_id')->find();
                if(empty($info) || count($info)==0){
                    $i++;
                    $msg.='商品'.$info['good_name'].'不存在,请重新下单';
                    break;
                }
                $good['seller_id']=$info['seller_id'];
                $good['good_id']=$info['good_id'];
                $good['good_num']=$val['good_num'];
                $good['good_name']=$info['good_name'];
                $good['good_cover_img']=$info['good_cover_img'];
                $good['good_no']=$info['good_no'];
                $good['market_price']=$info['market_price'];
                $good['cost_price']=$info['cost_price'];
                $good['give_integral']=$info['good_integral'];
                //判断商品是否有规格，有则必选规格
                $count=$good_price->where('id',$val['good_id'])->count(1);
                if($count==0 && empty($val['attr_id'])){
                    //验证库存是否足够
                    if($info['good_store']<$val['good_num']){
                        $i++;
                        $msg.='商品'.$info['good_name'].'库存不足,请重新下单';
                        break;
                    }
                    $good['good_price']=$info['good_price'];
                    $good['attr_text']='';
                    $good['attr_value']='';
                    $total=$info['good_price']*$val['good_num'];
                    $total_price+=$info['good_price']*$val['good_num'];
                }
                else
                {
                    if($count>0 && empty($val['attr_id'])){
                        $i++;
                        $msg.='请选择商品'.$info['good_name'].'对应的规格';
                        break;
                    }

                    $where=$arr=array();
                    $where['good_id']=$val['good_id'];
                    $where['id']=$val['attr_id'];
                    $arr=$good_price->where($where)->find();
                    if(empty($arr) || count($arr)==0){
                        $i++;
                        $msg.='商品'.$info['good_name'].'的规格错误，请重新选择';
                        break;
                    }
                    //验证库存是否足够
                    if($arr['store']<$val['good_num']){
                        $i++;
                        $msg.='商品'.$info['good_name'].'库存不足,请重新下单';
                        break;
                    }
                    $good['good_price']=$arr['price'];
                    $good['attr_text']=$arr['good_attr_text'];
                    
                    $good['attr_value']=$arr['good_attr_value'];
                    $total=$arr['price']*$val['good_num'];
                    $total_price+=$arr['price']*$val['good_num'];
                }
                //按不同商家订单价格
                if(in_array($info['seller_id'], array_keys($seller_data))){
                    $seller_data[$info['seller_id']]=$seller_data[$info['seller_id']]+$total;
                }else{
                    $seller_data[$info['seller_id']]=$total;
                }
                $data[$info['seller_id']][]=$good;
            }
            if($i>0){
                error($msg);
            }
            // echo $total_price;
            // print_r($seller_data);
            // p($good_list);
            
            //先生成订单，再生成支付订单
            if($data){
                // 启动事务
                $db=db();
                $db->startTrans();
                $order=db('order');
                $order_detail=db('order_detail');
                $id_arr=array();
                foreach ($seller_data as $k => $v) {
                    $order_data=array();
                    $order_no='';
                    //订单号
                    $order_no=$this->get_order_no();
                    $order_data=array(
                        'order_no'           => $order_no,
                        'order_status'       => 0,
                        'user_id'            => $userid,
                        'user_name'          => $address['user_name'],
                        'user_mobile'        => $address['user_mobile'],
                        'user_province'      => $address['province'],
                        'user_city'          => $address['city'],
                        'user_district'      => $address['district'],
                        'user_address'       => $address['detail_address'],
                        'order_total_price'  => $v,
                        'order_create_time'  => time(),
                        'order_user_note'    => isset($order_user_note[$k]) ? $order_user_note[$k] : '', //备注
                        'seller_id'          => $k,
                    );
                    $res=$order->insert($order_data);
                    //新增id
                    $order_id=$order->getLastInsID();

                    if(!$res || !$order_id){
                       // 回滚事务
                        $db->rollback();
                        error('订单提交失败'); 
                    }
                    //添加主菜单ID
                    foreach ($data[$k] as $key => $val) {
                        $data[$k][$key]['order_id']=$order_id;
                    }
                    $res=$order_detail->insertAll($data[$k]);
                    if(!$res){
                       // 回滚事务
                        $db->rollback();
                        error('订单提交失败'); 
                    }
                    $id_arr[]=$order_id;
                }
                //生成支付订单
                if($res){
                    $pay_no=$this->get_pay_no();
                    $pay=array(
                        'order_no'            =>    $pay_no,
                        'order_id_list'       =>    implode(',', $id_arr),
                        'order_total_price'   =>    $total_price,
                        'order_status'        =>    0,
                        'user_id'             =>    $userid,
                    );
                    $res=db('order_pay')->insert($pay);
                    $id=db('order_pay')->getLastInsID();
                    if(!$res){
                       // 回滚事务
                        $db->rollback();
                        error('订单提交失败'); 
                    }
                }
                // 提交事务
                $db->commit(); 
                session('car_data',null);
                success('提交成功',url('payway',array('id'=>$id)));
                
            }

        }
    }

    //生成唯一订单号
    private function get_order_no(){
       $order_no='NZ'.date('YmdHis');
       $order_no=$order_no.rand(1000,9999);
       $count=db('order')->where('order_no',$order_no)->count(1);
       if($count>0){
        $this->get_order_no();
       }
       return $order_no;
    }

    //生成唯一订单号
    public function get_pay_no(){
       $order_no='TP'.date('YmdHis');
       $order_no=$order_no.rand(100,999);
       $count=db('order_pay')->where('order_no',$order_no)->count(1);
       if($count>0){
        $this->get_pay_no();
       }
       return $order_no;
    }



    //选择支付方式
    public function payway(){
        //判断用户是否登录
        if(!user_login()){
            success_alert('您未登录，请先登录',url('home/Login/login'));
        }
        $id=input('id/d');
        if(empty($id)){
           error('暂无订单，请去下单');
        }
        $userid=user_login();
        $info=db('order_pay')->where('id',$id)->where('user_id',$userid)->find();
        if(empty($info)){
            exit('订单不存在');
        }
        //获取账户余额
        $wealth=Db::name('user_wealth')->where('uid',$userid)->field('money,coupon')->find();

        $this->assign('wealth',$wealth);  
        $this->assign('info',$info);  
        $this->assign('title','立即支付');  
    	return $this->fetch() ;
    }


    //保存支付方式
    public function savepay(){
        $paytype=input('post.paytype');
        $id=input('post.id/d');
        if(empty($paytype) || !in_array($paytype, array(1,2,3,4,5))){
            error('请选择支付类型');
        }
        if(empty($id))
            error('订单不存在');

        $order=Db::name('order_pay');
        $uid=user_login();
        $where['id']          = $id;
        $where['user_id']     = $uid;
        $where['order_status']= 0;

        $info=$order->where($where)->field('order_no,user_id,order_total_price,order_status,order_id_list')->find();
        if(empty($info)){
           error('订单不存在或已支付'); 
        }
        $order_no=$info['order_no'];

        // 启动事务
        Db::startTrans();
        $pay_name=array(1=>'余额支付',2=>'微信支付',3=>'支付宝支付',4=>'网银支付',5=>'购物券支付');


        unset($where['id']);
        $where['order_id']=array('in',explode(',', $info['order_id_list']));
        
        Db::name('order')->where($where)->update(array('order_pay_code'=>$paytype,'order_pay_name'=>$pay_name[$paytype]));

        $uid=$info['user_id'];
        $total_price=$info['order_total_price'];
        //余额支付 //购物券支付
        if($paytype==1 || $paytype==5){
            //扣除余额
            $UserPay=model('UserPay');
            //金额明细
            $detail['content']='购买商品消耗'.$order_no;
            $detail['from_type']=2; //1-转入 2-转出
            $detail['type']='buygood';
            $detail['type_name']='购买商品';
            $res=$UserPay->DecMoney($uid,$total_price,$detail,$paytype);

            if($res===true){
                //修改订单状态
                $res=$UserPay->setStatus($order_no,$uid);
                if(!$res){
                    // 回滚事务
                    Db::rollback();
                    error('支付失败！'.$res);
                }
                // 提交事务
                Db::commit(); 
                success('',url('paysuccess',array('order_no'=>$order_no)));  
            }else{
                // 回滚事务
                Db::rollback();
                error('支付失败！'.$res);
            }
        }

        //微信支付
        if($paytype==2) {

            $nwhere['id']          = $id;
            $nwhere['user_id']     = $uid;
            $nwhere['order_status']= 0;
            $order_no=$this->get_pay_no();
            Db::name('order_pay')->where($nwhere)->setField('order_no',$order_no);
            // 提交事务
            Db::commit(); 
            if(is_weixin())
                success('',url('mall/Pay/wxpay',array('order_no'=>$order_no))); 
            else
                success('',url('mall/Pay/h5Pay',array('order_no'=>$order_no))); 
               
        }
        //支付宝支付
        if($paytype==3) {
            // 提交事务
            Db::commit(); 
            success('',url('alipay',array('order_no'=>$order_no)));  
        }
        //网银支付
        if($paytype==4) {
            error($pay_name[$paytype].'暂未开通');
        }

        
    } 


    //支付成功
    public function paysuccess(){
        $order_no=input('order_no');
        $total_price=Db::name('order_pay')->where('order_no',$order_no)->value('order_total_price');

        $this->assign('title','支付完成');
        $this->assign('total_price',$total_price);
        $this->assign('back_url',url('Index/index'));
        return $this->fetch() ;
    }


    //支付宝支付
    public function alipay(){
        $order_no=input('order_no');
        if(empty($order_no)){
            exit('404');
        }
        $order=db('order_pay');
        $where['order_no']      =   $order_no;
        $where['user_id']       =   user_login();
        $where['order_status']  =   0;
        $info=$order->where($where)->field('user_id,order_total_price')->find();
        if(empty($info)){
           error('订单不存在或已支付'); 
        }


        $data['order_no']=$order_no;
        $data['total_price']=$info['order_total_price'];
        $data['good_name']='商品支付';
        $data['return_url']=url('mall/Shopcar/paysuccess',array('order_no'=>$order_no),'',true); //同步跳转地址
        $data['notify_url']="http://lndttx.net/mall/Pay/notify_url"; //异步回调地址
        alipay($data);
    }

}
