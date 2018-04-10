<?php
namespace app\mall\controller;
use think\Controller;
use think\Db;
class Pay extends Controller
{

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

                $res=model('UserPay')->setStatus($out_trade_no);
                
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


    public function wxpay(){
        header("Content-type: text/html; charset=utf-8");
        // 导入微信支付sdk
        Vendor('Weixinpay.Weixinpay');
        $back_url='http://lndttx.net/mall/Pay/wxnotify';
        $wxpay=new \Weixinpay($back_url);
        // 获取jssdk需要用到的数据
        $out_trade_no=input('order_no');
        $data=$wxpay->getParameters($out_trade_no,url('mall/pay/wxpay','','',true));
        // 将数据分配到前台页面
        $assign=array(
            'data'=>json_encode($data)
            );
        $out_trade_no=input('state');
        $url=url('mall/Shopcar/paysuccess',array('order_no'=>$out_trade_no));
        $this->assign('url',$url);
        $this->assign($assign);
        return $this->fetch();
    }

    public function wxnotify(){
        // 导入微信支付sdk
        Vendor('Weixinpay.Weixinpay');
        $back_url='http://lndttx.net/mall/Pay/wxnotify';
        $wxpay=new \Weixinpay($back_url);
        $result=$wxpay->notify();
        if ($result) {
            // 验证成功 修改数据库的订单状态等 $result['out_trade_no']为订单号
            $out_trade_no=$result['out_trade_no'];
            $res=model('UserPay')->setStatus($out_trade_no);
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
                        'REDIRECT_URL'=>'http://lndttx.net/mall/index/index',//回调路径
                        'NOTIFY_URL' => 'http://lndttx.net/mall/Pay/wxnotify/', // 接收支付状态的连接
                   );//读取配置
            $notify_url             = $config['NOTIFY_URL'].'out_trade_no/'.$pay_order_data;//拼接回调路径，带单号方便回调
            $wechatAppPay           = new \wechatAppPay($config['APPID'], $config['MCHID'], $notify_url, $config['KEY']);
            $params['body']         = '宏八商品';                       //商品描述
            $params['out_trade_no'] = $pay_order_data;    //自定义的订单号
            $params['trade_type']   = 'MWEB';                   //交易类型 JSAPI | NATIVE | APP | WAP
            $params['scene_info']   = '{"h5_info": {"type":"Wap","wap_url": "http://lndttx.net","wap_name": "宏八"}}';

            
            $price=db('order_pay')->where('order_no',$out_trade_no)->value('order_total_price');
           
            $money=$price*100;
            $params['total_fee']    = $money; //订单金额 只能为整数 单位为分


            $result                 = $wechatAppPay->unifiedOrder($params);//统一下单方法
            
            $url_encode_redirect_url = urlencode($config['REDIRECT_URL']);//支付成功回调路径
            $url                     = $result['mweb_url'] . '&redirect_url=' . $url_encode_redirect_url;//拼接支付链接
            echo "<script>window.location.href='" . $url . "';</script>";
            exit();
        }

}
