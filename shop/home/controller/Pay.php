<?php
namespace app\home\controller;
use think\Controller;
use think\Db;
class Pay extends controller
{

    public function _initialize(){
        //获取网站头部信息
        $this->assign('site_info',site_info());
    }

    protected function is_user_login(){
      $userid=user_login();
      if(!$userid){
          if(request()->isAjax()){
            success('登录超时',url('home/Login/login'));
          }
          $this->redirect('home/Login/login');
          exit();
       }
    }


    public function selectpay(){

        $this->is_user_login();
        $order_no=input('order_no');
        $money=input('money');
        $id=input('id/d');
        if($order_no){
            $user_money=model('UserWealth')->getField('money');
            $this->assign('id',$id);
            $this->assign('order_no',$order_no);
            $this->assign('money',$money);
            $this->assign('user_money',$user_money);
            $this->assign('title','选择支付方式');
    	    return $this->fetch() ;
        }
        
    }

    //保存支付方式
    public function savepay(){

        $this->is_user_login();

        $paytype=input('post.paytype');
        $safepwd=input('post.pwd');
        $id=input('post.id/d');
        $order_no=input('post.order_no');
        if(empty($paytype) || !in_array($paytype, array(1,2,3,4))){
            error('请选择支付类型');
        }
        if(empty($id) || empty($order_no))
            error('订单不存在');
        if(empty($safepwd))
            error('请输入安全密码');
        if(!model('User')->checkSafePwd($safepwd)){
            error('安全密码错误或未设置');
        }

        //按订单前缀取表
        $table=get_table_name($order_no);
        $order=db($table);
        $where['id']=$id;
        $where['uid']     =user_login();
        $where['status']  =0;
        $info=$order->where($where)->field('uid,money,status,order_no')->find();
        if(empty($info)){
           error('订单不存在或已支付'); 
        }

        //订单号重新赋值
        $order_no=$info['order_no'];

        // 启动事务
        Db::startTrans();
        $pay_name=array(1=>'余额支付',2=>'微信支付',3=>'支付宝支付',4=>'网银支付');
        $order->where($where)->setField('paytype',$pay_name[$paytype]);

        $uid=$info['uid'];
        $money=$info['money'];
        //余额支付
        if($paytype==1){
            //扣除余额
            $UserPay=model('UserPay');
            //金额明细
            $detail['content']='用户升级消耗'.$money;
            $detail['from_type']=2; //1-转入 2-转出
            $detail['type']='updateuser';
            $detail['type_name']='用户升级';
            $res=$UserPay->DecMoney($uid,$money,$detail);
            if($res===true){
                //修改订单状态
                $res=$UserPay->setStatus($order_no,$table);
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
        	$pre=substr($order_no,0,2);
        	$order_no=get_order_no($table,$pre);
        	$order->where($where)->setField('order_no',$order_no);
            // 提交事务
            Db::commit(); 
            if(is_weixin())
                success('',url('wxpay',array('order_no'=>$order_no)));
            else{
                success('',url('h5Pay',array('order_no'=>$order_no)));
            }  
        }
        //支付宝支付
        if($paytype==3) {
            // 提交事务
            Db::commit(); 
            success('',url('alipay',array('order_no'=>$order_no)));  
        }
        //网银支付
        if($paytype==4) {
            error('网银支付暂未开通');
        }

        // // 提交事务
        // Db::commit(); 
        // success('',url('paysuccess',array('order_no'=>$order_no)));
    }






    //支付成功
    public function paysuccess(){

        $this->is_user_login();

        $order_no=input('order_no');
        $where['order_no']=safe_replace($order_no);
        //按订单前缀取表
        $table=get_table_name($order_no);
        $order=db($table);
        $where['order_no']=$order_no;
        $where['uid']     =user_login();
        $info=$order->where($where)->field('money,type_name,order_no,pay_time')->find();
        $info['company_name']=get_config('WEB_SITE_NAME');
        $user=session('user_login');
        $info['account']=$user['account'];

        $this->assign('info',$info);

        $this->assign('title','支付成功');
        return $this->fetch();
    }


    public function wxpay(){
        header("Content-type: text/html; charset=utf-8");
        // 导入微信支付sdk
        Vendor('Weixinpay.Weixinpay');
        $wxpay=new \Weixinpay();
        // 获取jssdk需要用到的数据
        $out_trade_no=input('order_no');
        $data=$wxpay->getParameters($out_trade_no);
        // 将数据分配到前台页面
        $assign=array(
            'data'=>json_encode($data)
            );
        $out_trade_no=input('state');
        $url=url('paysuccess',array('order_no'=>$out_trade_no));
        $this->assign('url',$url);
        $this->assign($assign);
        return $this->fetch();
    }

    //支付宝支付
    public function alipay(){
        
        $this->is_user_login();
        $order_no=input('order_no');

        if(empty($order_no)){
            exit('404');
        }
        //按订单前缀取表
        $table=get_table_name($order_no);
        $order=db($table);
        $where['order_no']=$order_no;
        $where['uid']     =user_login();
        $where['status']  =0;
        $info=$order->where($where)->field('uid,money')->find();
        if(empty($info)){
           error('订单不存在或已支付'); 
        }
 

        $data['order_no']=$order_no;
        $data['total_price']=$info['money'];
        $data['good_name']='商品支付';
        $data['return_url']='http://'.$_SERVER['HTTP_HOST'].'/home/pay/paysuccess/order_no/'.$order_no; //同步跳转地址
        alipay($data);

    }


    //支付宝支异步通知地址
    public function notify_url(){
        
        $result = alipay_pay_back();

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代

            
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            
            //商户订单号
            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号
            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];


            if($_POST['trade_status'] == 'TRADE_FINISHED') {

                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                    //如果有做过处理，不执行商户的业务程序
                        
                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
            }
            else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序            
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
                $total_amount=$_POST['total_amount'];

                $table=get_table_name($out_trade_no);
                $res=model('UserPay')->setStatus($out_trade_no,$table);

                $this->log_test('支付宝'.$out_trade_no.',金额:'.$total_amount);
               
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
                
            echo "success";     //请不要修改或删除
                
        }else {
            //验证失败
            echo "fail";    //请不要修改或删除

        }

    }


    //日志输出
    private function log_test($text) {
        file_put_contents ("log.txt", date ( "Y-m-d H:i:s" ) . "  " . $text . "\r\n", FILE_APPEND );
    }

    /**
     * notify_url接收页面
     * {"appid":"wx6e5bb3029e7e4b9c","bank_type":"CFT","cash_fee":"1","fee_type":"CNY","is_subscribe":"N","mch_id":"1498193922","nonce_str":"test","openid":"ou0MX0y27-BbOBNE6iLRcSi_mezA","out_trade_no":"CZ201802032135539153","result_code":"SUCCESS","return_code":"SUCCESS","time_end":"20180203213541","total_fee":"1","trade_type":"JSAPI","transaction_id":"4200000052201802036597989978"}
     */
    public function wxnotify(){
        // 导入微信支付sdk
        Vendor('Weixinpay.Weixinpay');
        $wxpay=new \Weixinpay();
        $result=$wxpay->notify();
        if ($result) {
            // 验证成功 修改数据库的订单状态等 $result['out_trade_no']为订单号
            $out_trade_no=$result['out_trade_no'];
            $table=get_table_name($out_trade_no);
            $res=model('UserPay')->setStatus($out_trade_no,$table);
            $this->log_test('微信支付：'.$out_trade_no.',金额:'.$result['total_fee']);
        }
    }



    //微信H5支付
    /**
         * @author:hboy;
         * @copyright:2018/2/24;
         * @var:H5支付,为了怕后来者看不懂，注释在下边
         */
        public function h5Pay()
        {
            $pay_order_data = input('order_no');//平台内部订单号  
            $out_trade_no=$pay_order_data;
            Vendor('Weixinpay.WeChatH5pay');//引入微信H5支付SDK
            $config= array(
                        'APPID'      => '', // 微信支付APPID
                        'MCHID'      => '', // 微信支付MCHID 商户收款账号
                        'KEY'        => '', // 微信支付KEY
                        'APPSECRET'  => '',  //公众帐号secert
                        'REDIRECT_URL'=>'http://lndttx.net',//回调路径
                        'NOTIFY_URL' => 'http://lndttx.net/home/Pay/wxnotify/', // 接收支付状态的连接
                   );//读取配置
            $notify_url             = $config['NOTIFY_URL'].'out_trade_no/'.$pay_order_data;//拼接回调路径，带单号方便回调
            $wechatAppPay           = new \wechatAppPay($config['APPID'], $config['MCHID'], $notify_url, $config['KEY']);
            $params['body']         = '宏八商品';                       //商品描述
            $params['out_trade_no'] = $pay_order_data;    //自定义的订单号
            $params['trade_type']   = 'MWEB';                   //交易类型 JSAPI | NATIVE | APP | WAP
            $params['scene_info']   = '{"h5_info": {"type":"Wap","wap_url": "http://lndttx.net","wap_name": "宏八"}}';

            //取价格
            $pre=substr($out_trade_no,0,2);
            if($pre=='TP'){
                $price=db('order_pay')->where('order_no',$out_trade_no)->value('order_total_price');
            }else{
                $table=get_table_name($out_trade_no);
                $price=db($table)->where('order_no',$out_trade_no)->value('money');
            }
            $money=$price*100;
            $params['total_fee']    = $money; //订单金额 只能为整数 单位为分


            $result                 = $wechatAppPay->unifiedOrder($params);//统一下单方法
            
            $url_encode_redirect_url = urlencode($config['REDIRECT_URL']);//支付成功回调路径
            $url                     = $result['mweb_url'] . '&redirect_url=' . $url_encode_redirect_url;//拼接支付链接
            echo "<script>window.location.href='" . $url . "';</script>";
            exit();
        }
        
        
        

}
