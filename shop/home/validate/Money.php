<?php
namespace app\home\validate;
use think\Validate;
use think\Db;
//提现验证
class Money extends Validate
{
    // 验证规则
    protected $rule = [
        'type'                  => 'require|check_type',
        'money'            	    => 'require|regex:^[1-9]\d*$|max_get',
        'code'                  => 'require|check_code',
        'pwd'			        => 'require|check_safepwd',
    ];
    //错误信息
    protected $message  = [
        'type.require'          => '请选择提现账户',
        'type.check_type'       => '提现账户有误',
        'money.require'         => '提现金额不能为空',
        'money.regex'           => '提现金额只能为整数',
        'code.require'          => '验证码不能为空',
        'code.check_code'       => '验证码错误或已过期',
        'pwd.require'           => '交易密码不能为空',
        'pwd.check_safepwd'     => '交易密码错误',
    ];

    public function max_get($money,$rule,$data){
        //提现限制
        $config=db('config')->where('id','in',[24,25,47])->column('name,value');
        $money_max=$config['money_max'];//单笔提现额度
        $money_beishu=$config['money_beishu']; //提现倍数
        $money_count=$config['money_date_count']; //每天提现次数
        //宏宝提现
        if($data['type']==2){
            $money_max=$money_max*100;
            $money_beishu=$money_beishu*100;
            //单笔提现额度
            if($money_max>0 && $money>$money_max){
                return '超出限额，单笔最大提现额度为'.($money_max);
            }
            //提现倍数
            if($money_beishu>0 && ($money<$money_beishu || $money%$money_beishu!=0)){
                return '提现数量只能为'.($money_beishu).'的倍数';
            }


        }else{ //现金提现

            //单笔提现额度
            if($money_max>0 && $money>$money_max){
                return '超出限额，单笔最大提现额度为'.$money_max;
            }
            //提现倍数
            if($money_beishu>0 && ($money<$money_beishu || $money%$money_beishu!=0)){
                return '提现金额只能为'.$money_beishu.'的倍数';
            }
            
        }

        //每天提现次数
        $where['uid']=user_login();
        $where['type']=$data['type'];
        $where["FROM_UNIXTIME(create_time,'%Y%m%d')"]=date('Ymd');
        $count=Db::name('money_get')->where($where)->count(1);
        if($money_count<=$count){
            return '每天最多可提现'.$money_count.'次';
        }
        
        return true;
    }
    
    //验证码
    public function check_code($value,$rule,$data){
        //验证短信
        $mobile=model('User')->getField('mobile');
        if(!check_sms($value,$mobile)){
            return false;
        }
        return true;
    }

    public function check_safepwd($value,$rule,$data){
        //验证交易密码
        if(!model('User')->checkSafePwd($value)){
            return false;
        }
        return true;
    }

    public function check_type($value,$rule,$data){
            $arr=array(1,2);
            if(!in_array($value,$arr)){
                return false;
            }
            return true;
    }
}