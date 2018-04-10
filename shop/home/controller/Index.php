<?php
namespace app\home\controller;
use think\Controller;
use think\Db;
class Index extends Common
{


    public function index()
    {
        //推广二维码
    	$uid=user_login();
        $url ="http://".$_SERVER['HTTP_HOST'].url('home/Login/selectreg',array('pid'=>$uid));
        $path=set_code_img($uid,$url);
        $this->assign('code_path',$path);

        //取栏目名称
        $menu_son=model('Menu')->all_news_son(346);
        $this->assign('menu_son',$menu_son);

        //首页取top(n)条新闻
        $newtop=model('news')->top(5);
        $this->assign('newtop',$newtop);    
        
        //给帮助中心默认id 
        $help_son=model('Menu')->all_news_son(6);
        $this->assign('help_son',$help_son);

        //获取用户头像
        $u_info=model('User')->where('userid',$uid)->field('head_img,level')->find();
        $head_img=$u_info['head_img'];
        $this->assign('head_img',$head_img);
        $this->assign('level',$u_info['level']);

        //猜你喜欢
        $where['status']=1;
        $where['is_recommend']=1;
        $list=db('good')->field('good_id,good_name,good_cover_img,good_price,market_price')->where($where)->order('good_sort desc')->limit(10)->select();
        $count=count($list);
        $less=10-$count;
        //如果推荐商品数量不足,取所有商品
        if($less>0){
           unset($where['is_recommend']);
           $glist=db('good')->field('good_id,good_name,good_cover_img,good_price,market_price')->where($where)->order('good_id desc')->limit($less)->select();
           if(count($glist)>0)
                $list=array_merge($list,$glist); 
        }

        $this->assign('goodlist',$list);
        $this->assign('goodcount',count($list));

        //消息
        $this->message();
        
        //统计上一天新增积分
        // $where=array();
        // $Yestoday_start=strtotime(date("Y-m-d",strtotime("-1 day")));
        // $Yestoday_end=$Yestoday_start+86400;
        // $where['from_type']=1;
        // $where['create_time']=array('BETWEEN',array($Yestoday_start,$Yestoday_end));
        // $lastdate_integral=Db::name('integral_detail')->where($where)->sum('money');

        // //积分总额
        // $total_integral=Db::name('user_wealth')->sum('integral');

        // $this->assign('lastdate_integral',$lastdate_integral);
        // $this->assign('total_integral',$total_integral);

        return $this->fetch() ;
    }

    //更多列表
    public function more(){
    	return $this->fetch() ;
    }

    //消息
    private function message(){
        $uid=user_login();
        $count=Db::name('message')->where('status',0)->where('uid',$uid)->count(1);
        if($count==0){

            $time=time();
            $time=$time-86400*30;  //支取30以内的
            $where['create_time']=array('gt',$time);
            $where['uid']=0;

            $message_id=Db::name('message_read')->where('uid',$uid)->value('message_id');
            if($message_id){
                $arr=explode(',', $message_id);
                $where['id']=array('not in',$arr);
                $id=Db::name('message')->where($where)->order('id desc')->value('id');
                if($id){
                    $count=1;
                }
            }else{
                $id=Db::name('message')->where($where)->order('id desc')->value('id');
                if($id){
                    $count=1;
                }
            }

        }
        $this->assign('message_count',$count);
    }


}
