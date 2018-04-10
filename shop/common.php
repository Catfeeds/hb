<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


function p($data){
    header("Content-type: text/html; charset=utf-8");
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    exit();
}

//网站头部信息
function site_info($field=null){
    $info=db('config')->where('group',1)->column('value','name');
    if($field)
        return $info[$field];
    else
        return $info;
}



//检测用户是否登录
function user_login()
{
    return model('Home/user')->user_login();
}





//获取当前控制名称
function controller_name()
{
	$request = \think\Request::instance();
    return $request->controller();
}

//获取模块名称
function model_name()
{
	$request = \think\Request::instance();
    return $request->module();
}

//获取当前方法名称
function action_name()
{
	$request = \think\Request::instance();
    return $request->action();
}



/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @return string
 * @author jry <598821125@qq.com>
 */
function user_md5($str, $auth_key=null)
{
    if (!$auth_key) {
        $auth_key = config('AUTH_KEY') ?: '0755web';
    }
    return '' === $str ? '' : md5(sha1($str) . $auth_key);
}

/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 * @author jry <598821125@qq.com>
 */
function admin_login()
{
    return model('admin/Admin')->is_login();
}



if( ! function_exists('array_column'))
{
  function array_column($input, $columnKey, $indexKey)
  {
    $columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;
    $indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;
    $indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;
    $result = array();
 
    foreach ((array)$input AS $key => $row)
    { 
      if ($columnKeyIsNumber)
      {
        $tmp = array_slice($row, $columnKey, 1);
        $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;
      }
      else
      {
        $tmp = isset($row[$columnKey]) ? $row[$columnKey] : $row;
      }
      if ( ! $indexKeyIsNull)
      {
        if ($indexKeyIsNumber)
        {
          $key = array_slice($row, $indexKey, 1);
          $key = (is_array($key) && ! empty($key)) ? current($key) : NULL;
          $key = is_null($key) ? 0 : $key;
        }
        else
        {
          $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
        }
      }
 
      $result[$key] = $tmp;
    }
 
    return $result;
  }
}


/**
 * 获取上传文件路径
 * @param  int $id 文件ID
 * @return string
 */
function get_cover($id = null, $type = null)
{
    return model('admin/Upload')->getCover($id, $type);
}




/**
 * 获取父级信息
 */
function get_parent($pid,$field='account'){
    $account=db('user')->where('userid',$pid)->value($field);
    if($account)
        return $account;
    else
        return '无';
}



/**
 * 判断当前访问的用户是  PC端  还是 手机端  返回true 为手机端  false 为PC 端
 * @return boolean
 */
/**
　　* 是否移动端访问访问
　　*
　　* @return bool
　　*/
function isMobile()
{
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    return true;

    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    {
    // 找不到为flase,否则为true
    return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile');
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            return true;
    }
        // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    {
    // 如果只支持wml并且不支持html那一定是移动设备
    // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        }
    }
            return false;
 }

function is_weixin() {
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return true;
    } return false;
}

/**
 * [get_banner 获取广告图]
 * @param  [type] $position [位置]
 * @param  [type] $type [查找类型 select、find]
 * @return [type]       [description]
 */
function get_banner($position,$type='select'){
    if(!isset($position) || empty($position)){
        return false;
    }
    $where['b_type']=$position;
    $where['status']=1;
    $table=db('banner');
    if($type=='find'){
        $info=$table->where($where)->order('b_order desc')->find();
    }else{
        $info=$table->where($where)->order('b_order desc')->select();
    }
    return $info;
}

//错误提示
function error($message='',$jumpUrl='',$status=0,$result='') {
    if(request()->isAjax()) {// AJAX提交
            $data           =   array();
            $data['info']   =   $message;
            $data['url']    =   $jumpUrl;
            $data['status'] =   $status;
            $data['result']    =   $result;
            exit(json_encode($data));
    }
    exit();
}

//成功提示
function success($message='',$jumpUrl='',$status=1,$result='') {
    if(request()->isAjax()) {// AJAX提交
            $data           =   array();
            $data['info']   =   $message;
            $data['url']    =   $jumpUrl;
            $data['status'] =   $status;
            $data['result'] =   $result;
            exit(json_encode($data));
    }
    exit();
}

/**
 * 字节格式化
 * @access public
 * @param string $size 字节
 * @return string
 */
function byte_Format($size) {
    $kb = 1024;          // Kilobyte
    $mb = 1024 * $kb;    // Megabyte
    $gb = 1024 * $mb;    // Gigabyte
    $tb = 1024 * $gb;    // Terabyte

    if ($size < $kb)
        return $size . 'B';

    else if ($size < $mb)
        return round($size / $kb, 2) . 'KB';

    else if ($size < $gb)
        return round($size / $mb, 2) . 'MB';

    else if ($size < $tb)
        return round($size / $gb, 2) . 'GB';
    else
        return round($size / $tb, 2) . 'TB';
}


//按日期搜索
function date_query($field){

        $date_start=input('date_start');
        $date_end=input('date_end');
        if(!empty($date_start) && !empty($date_end) && ($date_start == $date_end)){
            $map["FROM_UNIXTIME(".$field.",'%Y-%m-%d')"]=$date_end;
        }
        else if($date_start!='' && $date_end!='' && $date_start !=$date_end){
            $map[$field]=array('between',array(strtotime($date_start),strtotime($date_end)+86400));
        }
        else if($date_start!='' && empty($date_end)){
            $map[$field]=array('gt',strtotime($date_start)+86400);
        }
        else if(empty($date_start) && $date_end!=''){
            $map[$field]=array('lt',strtotime($date_end)+86400);
        }
        if(isset($map) && !empty($map))
            return $map;
        else
            return false;
}



/**
 * 获取商品一二三级分类
 * @return type
 */
function get_goods_category_tree(){
    $tree = $arr = $result = array();
    $cat_list = db('good_category')->cache(true)->where("is_show = 1")->order('sort_order desc')->select();//所有分类
    if($cat_list){
        foreach ($cat_list as $val){
            if($val['level'] == 2){
                $arr[$val['pid']][] = $val;
            }
            if($val['level'] == 3){
                $crr[$val['pid']][] = $val;
            }
            if($val['level'] == 1){
                $tree[] = $val;
            }
        }

        foreach ($arr as $k=>$v){
            foreach ($v as $kk=>$vv){
                $arr[$k][$kk]['sub_menu'] = empty($crr[$vv['id']]) ? array() : $crr[$vv['id']];
            }
        }

        foreach ($tree as $val){
            $val['tmenu'] = empty($arr[$val['id']]) ? array() : $arr[$val['id']];
            $result[$val['id']] = $val;
        }
    }
    return $result;
}


//防注入，字符串处理，禁止构造数组提交
//字符过滤
//陶
function safe_replace($string) {
    if(is_array($string)){ 
       $string=implode('，',$string);
       $string=htmlspecialchars(str_shuffle($string));
    } else{
        $string=htmlspecialchars($string);
    }
    $string = str_replace('%20','',$string);
    $string = str_replace('%27','',$string);
    $string = str_replace('%2527','',$string);
    $string = str_replace('*','',$string);
    $string=str_replace("select","",$string);
    $string=str_replace("join","",$string);
    $string=str_replace("union","",$string);
    $string=str_replace("where","",$string);
    $string=str_replace("insert","",$string);
    $string=str_replace("delete","",$string);
    $string=str_replace("update","",$string);
    $string=str_replace("like","",$string);
    $string=str_replace("drop","",$string);
    $string=str_replace("create","",$string);
    $string=str_replace("modify","",$string);
    $string=str_replace("rename","",$string);
    $string=str_replace("alter","",$string);
    $string=str_replace("cas","",$string);
    $string=str_replace("or","",$string);
    $string=str_replace("=","",$string);
    $string = str_replace('"','&quot;',$string);
    $string = str_replace("'",'',$string);
    $string = str_replace('"','',$string);
    $string = str_replace(';','',$string);
    $string = str_replace('<','&lt;',$string);
    $string = str_replace('>','&gt;',$string);
    $string = str_replace("{",'',$string);
    $string = str_replace('}','',$string);
    $string = str_replace('--','',$string);
    $string = str_replace('(','',$string);
    $string = str_replace(')','',$string);

    return $string;
}


function error_alert($mes){
    echo "<meta charset=\"utf-8\"/><script>alert('".$mes."');javascript:history.back(-1);</script>";
    exit;
}
function success_alert($mes,$url=''){
    if($url!=''){
        echo "<meta charset=\"utf-8\"/><script>alert('".$mes."');location.href='" .$url. "';</script>";
    }else{
       echo "<meta charset=\"utf-8\"/><script>alert('".$mes."');location.href='" .$jumpUrl. "';</script>"; 
    }
    exit;
}

/**
 * 检查手机号码格式
 * @param $mobile 手机号码
 */
function check_mobile($mobile){
    if(preg_match('/1[34578]\d{9}$/',$mobile)){
        return true;
    }
    return false;
}

/**
 * 检查固定电话
 * @param $mobile
 * @return bool
 */
function check_telephone($mobile){
    if(preg_match('/^([0-9]{3,4}-)?[0-9]{7,8}$/',$mobile))
        return true;
    return false;
}

/**
 * 检查邮箱地址格式
 * @param $email 邮箱地址
 */
function check_email($email){
    if(filter_var($email,FILTER_VALIDATE_EMAIL))
        return true;
    return false;
}


/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv 是否进行高级模式获取（有可能被伪装） 
 * @return mixed
 */
function get_client_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}


//检查网站是否关闭
function is_close_site(){
    
    $where['name']='TOGGLE_WEB_SITE';
    $info=db('Config')->where($where)->field('value,tip')->find();
    return $info;    
}


/**
 * [sendMsg description]
 * @param  [type] $mobile [手机号码]
 * @param  [type] $key    [场景验证]
 * @return [type]         [description]
 */
function sendMsg($mobile,$key=null){
  
    $mobile=safe_replace($mobile);
    if(empty($mobile)){
        $mes['status']=0;
        $mes['message']='手机号码不能为空';
        return $mes;
    }
    if(!check_mobile($mobile)){
        $mes['status']=0;
        $mes['message']='手机号码格式错误';
        return $mes;
    }
    
    if(time() >  session('set_time')+60 || session('set_time') == '') {
        $user_mobile =  $mobile;
        $code=rand(100000,999999);
        
        //发送短信
         // if(isMobile($user_mobile)){//国内短信发送接口
            $content="【宏八】您的验证码为".$code."，5分钟内有效";//要发送的短信内容
            $res=setmyCode($user_mobile,$content);
            if($res){
                session('set_time',time());
                $str=trim($code).trim($mobile);
                if($key)
                    $str=$str.$key;
                $sms_code=sha1(md5($str));
                session('sms_code',$sms_code);

                $mes['status']=1;
                $mes['message']='短信发送成功'.$code;
                return $mes;
             }
             else{
                $mes['status']=0;
                $mes['message']='短信发送失败';
                return $mes;
             }
         // }else{
         //    $mes['status']=0;
         //    $mes['message']='手机号码不在正确';
         //    return $mes;
         // }
         
    }else{
          $msgtime=session('set_time')+60 - time();
          $data = $msgtime.'秒之后再试';
          $mes['status']=0;
          $mes['message']=$data;
          return $mes;
    }
}

    function setmyCode($mobile,$msg){
            return true;
            //↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓

            //创蓝发送短信接口URL, 请求地址请参考253云通讯自助通平台查看或者询问您的商务负责人获取
            $chuanglan_config['api_send_url'] = 'http://smssh1.253.com/msg/send/json';

            //创蓝变量短信接口URL, 请求地址请参考253云通讯自助通平台查看或者询问您的商务负责人获取
            $chuanglan_config['API_VARIABLE_URL'] = 'http://smssh1.253.com/msg/variable/json';

            //创蓝短信余额查询接口URL, 请求地址请参考253云通讯自助通平台查看或者询问您的商务负责人获取
            $chuanglan_config['api_balance_query_url'] = 'http://smssh1.253.com/msg/balance/json';
            //创蓝账号 替换成你自己的账号
            $chuanglan_config['api_account']    = '';

            //创蓝密码 替换成你自己的密码
            $chuanglan_config['api_password']   = '';

            //↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
            //创蓝接口参数
            $postArr = array (
                'account'  =>  $chuanglan_config['api_account'],
                'password' => $chuanglan_config['api_password'],
                'msg' => urlencode($msg),
                'phone' => $mobile,
                'report' => 'true'
            );
            
            $result = curlPost( $chuanglan_config['api_send_url'] , $postArr);
            if(!is_null(json_decode($result))){
                
                $output=json_decode($result,true);
                if(isset($output['code'])  && $output['code']=='0'){
                    return true;
                }else{
                    return false;
                }
            }else{
                    return false;
            }
    }

    /**
     * 通过CURL发送HTTP请求
     * @param string $url  //请求URL
     * @param array $postFields //请求参数 
     * @return mixed
     */
    function curlPost($url,$postFields){
        $postFields = json_encode($postFields);
        $ch = curl_init ();
        curl_setopt( $ch, CURLOPT_URL, $url ); 
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8'
            )
        );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt( $ch, CURLOPT_TIMEOUT,1); 
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
        $ret = curl_exec ( $ch );
        if (false == $ret) {
            $result = curl_error(  $ch);
        } else {
            $rsp = curl_getinfo( $ch, CURLINFO_HTTP_CODE);
            if (200 != $rsp) {
                $result = "请求状态 ". $rsp . " " . curl_error($ch);
            } else {
                $result = $ret;
            }
        }
        curl_close ( $ch );
        return $result;
    }




//验证短信验证码
function check_sms($code,$mobile,$key=null){
  $str=trim($code).trim($mobile);
  if($key)
    $str=$str.$key;

  $md5_code=sha1(md5($str));
  $set_time=session('set_time');
  $sms_code=session('sms_code');
  if(time() - $set_time <= 300  && $code!='' && $md5_code==$sms_code){
    $res=true;
  }else{
    $res=false;
  }
  return $res;

}
//清除短信session
function del_check_sms(){
    session('set_time',null);
    session('sms_code',null);
}


/**
 * 验证身份证
 * @return string
 */
function check_id_card($id_card){
  if(strlen($id_card)==18){
    return idcard_checksum18($id_card);
  }elseif((strlen($id_card)==15)){
    $id_card=idcard_15to18($id_card);
    return idcard_checksum18($id_card);
  }else{
    return false;
  }
}
// 计算身份证校验码，根据国家标准GB 11643-1999
function idcard_verify_number($idcard_base){
  if(strlen($idcard_base)!=17){
    return false;
  }
  //加权因子
  $factor=array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
  //校验码对应值
  $verify_number_list=array('1','0','X','9','8','7','6','5','4','3','2');
  $checksum=0;
  for($i=0;$i<strlen($idcard_base);$i++){
    $checksum += substr($idcard_base,$i,1) * $factor[$i];
  }
  $mod=$checksum % 11;
  $verify_number=$verify_number_list[$mod];
  return $verify_number;
}
// 将15位身份证升级到18位
function idcard_15to18($idcard){
  if(strlen($idcard)!=15){
    return false;
  }else{
    // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
    if(array_search(substr($idcard,12,3),array('996','997','998','999')) !== false){
      $idcard=substr($idcard,0,6).'18'.substr($idcard,6,9);
    }else{
      $idcard=substr($idcard,0,6).'19'.substr($idcard,6,9);
    }
  }
  $idcard=$idcard.idcard_verify_number($idcard);
  return $idcard;
}
// 18位身份证校验码有效性检查
function idcard_checksum18($idcard){
  if(strlen($idcard)!=18){
    return false;
  }
  $idcard_base=substr($idcard,0,17);
  if(idcard_verify_number($idcard_base)!=strtoupper(substr($idcard,17,1))){
    return false;
  }else{
    return true;
  }
}


/**
 * [upload_file 上传图片]
 * @param  [type] $name [input]
 * @return [type]       [数组]
 */
function upload_img($name)
{
   // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file($name);
    
    // 移动到框架应用根目录/public/uploads/ 目录下
    $upload_config=config('UPLOAD_CONFIG');
    $maxSize=$upload_config['maxSize'];
    $ext=$upload_config['ext'];
    $rootPath=$upload_config['rootPath'];
    $savePath=$upload_config['savePath'];

    //如果是多张图片
    if(is_array($file)){
        $files=$file;
        foreach($files as $file){
            // 移动到框架应用根目录/uploads/ 目录下
            $info = $file->move($rootPath);
            if($info){
                // 成功上传后 获取上传信息
                $data['status']=true;
                $data[]['path']=$savePath.$info->getSaveName();
            }else{

                //上传失败获取错误信息
                $data['status']=false;
                $data['error']=$file->getError();
                break;
            }    
        }
    }else{
        $info = $file->validate(['size'=>$maxSize,'ext'=>$ext])->move($rootPath);
        if($info){
            $data['status']=true;
            $data['path']=$savePath.$info->getSaveName();
             
        }else{
            // 上传失败获取错误信息
            $data['status']=false;
            $data['error']=$file->getError();
        }
    }

    return $data;
}


function check_pwd($value){
    if(preg_match('/^[0-9a-zA-Z]{6,20}$/',$value)){
        return true;
    }
    return false;
    
}


#++生成二维码+S+
function sp_dir_create($path,$mode = 0777) {
    if (is_dir($path))return true;
        $ftp_enable = 0;
        $path = sp_dir_path($path);
        $temp = explode('/',$path);
        $cur_dir = '';
        $max = count($temp) -1;
        for ($i = 0;$i <$max;$i++) {
        $cur_dir .= $temp[$i] .'/';
        if (@is_dir($cur_dir))
        continue;
        @mkdir($cur_dir,0777,true);
        @chmod($cur_dir,0777);
    }
    return is_dir($path);
}

function sp_dir_path($path) {
    $path = str_replace('\\','/',$path);
    if (substr($path,-1) != '/')
        $path = $path .'/';
    return $path;
}

function set_code_img($userid,$hurl){
    $drpath = './uploads/usercode';
    $imgma = 'code' . md5($userid) . '.png';
    $img_path=$drpath . '/' . $imgma;
    $savepath='/uploads/usercode/'. $imgma;
    if (!file_exists($img_path)) {
        sp_dir_create($drpath);
        vendor("phpqrcode.phpqrcode");
        $phpqrcode = new \QRcode();
        $size = "7";
        $errorLevel = "L";
        $phpqrcode->png($hurl, $img_path, $errorLevel, $size);
        // $picpath = './static/home/wap/home/images/banner.jpg';
        // $image = \think\Image::open($picpath);
        // $image->water($drpath . '/' . $imgma, array(247, 715), 100)->save($drpath . '/t' . $imgma);
    }
    return $savepath;
} 
#++生成二维码+E+



//生成唯一订单号
function get_order_no($table,$pre=null){
    $no=date('YmdHis');
    $no=$no.rand(1000,9999);
    if($pre)
      $no=$pre.$no;  
    //验证订单号是否存在
    $count=db($table)->where('order_no',$no)->count(1);
    if($count!=0)
        get_order_no($table,$pre);
    return $no;
}

//获取配置表
function get_config($name){
    return db('config')->where('name',$name)->value('value');
}

//获取配置表
function get_config_byid($id){
    return db('config')->where('id',$id)->value('value');
}


//用户等级
function user_level($level=null){
    if($level===null)
    {
        $level=model('home/User')->getField('level');
    }
    $level_name = db('user_level')->where('level',$level)->value('level_name');
    if($level_name)
        return $level_name;
    else
        return '无';
}


/**
 * 多个数组的笛卡尔积
*
* @param unknown_type $data
*/
function combineDika() {
    $data = func_get_args();
    $data = current($data);
    $cnt = count($data);
    $result = array();
    $arr1 = array_shift($data);
    foreach($arr1 as $key=>$item) 
    {
        $result[] = array($item);
    }       

    foreach($data as $key=>$item) 
    {                                
        $result = combineArray($result,$item);
    }
    return $result;
}


/**
 * 两个数组的笛卡尔积
 * @param unknown_type $arr1
 * @param unknown_type $arr2
*/
function combineArray($arr1,$arr2) {         
    $result = array();
    foreach ($arr1 as $item1) 
    {
        foreach ($arr2 as $item2) 
        {
            $temp = $item1;
            $temp[] = $item2;
            $result[] = $temp;
        }
    }
    return $result;
}


//判断用户是否商家
function check_seller(){

    $uid=user_login();
    $where['userid']=$uid;
    $seller=db('user')->where($where)->value('seller');
    if($seller>0){
        return true;
    }
    return false;
}


//++++支付宝支付--旧的账号++S++
 // function alipayconfig($data=null){
 //    // $config = array (   
 //    //     //应用ID,您的APPID。
 //    //     'app_id' => "2018020302138048",

 //    //     //商户私钥，您的原始格式RSA私钥
 //    //     'merchant_private_key' => "MIIEowIBAAKCAQEAzxWIhJjF3H5GGvii49nEHL2iCb9wHLy+qsQGtwlGOM0116K9jB6hJHV3WLWmNisSutuc7Nr0zf1LH1pSaKEultSwveEjbjhIvBkDfiwvWdy1EtN5gjvD/nyVKhpRQZAubqU0sqDig8rDMap9rFqpiX3sKF1XW2zWv6CWOmKq0kzAInLW/ntrvr9biy5k4fw+OR6IgxC3GBdxSSY2XlJ3C5OS1ZiZD54r8MO6TB//dih61clBSy+uBHzGApgWPS+Bpeqhmnr9HNRV2CyVC1H4gBqPLOwIWSWlc7LgJRtZRA+XIKncky1mgUqi27Vj8VJYG+m5ZaVgzeUxAT6tE4dQswIDAQABAoIBACORFzlu48zTA0dunMt1g3FMQKBb+O12nWjG8kBNn3nyBOVcViHSwOp6Il1iFYIIM9dUEMe9c35NmrFv2eeOh2nwbcqu+F7d2+Ayi58IB7nvZkoteBkeGrOCwjvQ+VPBZ7gpN7vWVhE8qfnFxn/rsmKi9gSYw4A4WUngUu0ENUKZDOcH6kQ/rNcnbzdRnCAN0DFF4sfjCnciniEbG4HEiNqQl3kaasnd3607SJDL5FA4UaBO12u52R2IITfhWFQUmT1R2Bc+CNsDQ05ujvxWyO3TBRIwTu7nApr+5fkAvR/ua0nZJhDzwfm8xRhbHV4UvtWHsMU2Wz9dEhK2ZasrvEECgYEA7QXgtkaJwRl+SQ+7G0wQFLK2idgETgd7abXTaLcoEjJP6Fcs0lELKkSLv0xq5wLyMCQoOzqB/ZRi/UWqd+ERj5f+0wjdxnywg8Du7Tw9otibKyifoejuzMJJmCRqtlPO1IElFt30UMp9beyaTsr1YTRo2I3Bz1NIvafvoGvtRtUCgYEA36oELefvGDRZfX7jeH1/WiAyC9GrviqxvlkSeJKaxx7q1E2duS7SG3BKaEGnJrr5197sWyh8FuNtU5BK8+8Etz3iliPxRVbnRTmWJANZWtNwZ7gfQG3lTLrWnBCMeLYhkvJiwAUOcUpjtC48nNr9JfoYeqjIz8G+zlPW9JobDWcCgYEAz0Ptjdc/DOHbIc6kwqkQAtmIcB+7G/TFAdqjRRWs78SZRcY9hqiiB9MrFRyg+uQDnv9vQuPV2kZRDcNG30+sSJIUnrxJGxHcVUp4ZHHiQC4D+oiqly4W7G0VZ/qoakn9Oqy4Hzf2NlPrvR1CjpZCXz8yU/QaP89Hc7mP/QuD0QUCgYAnQeEv6Yi21+FpPI9Sg7yJpiMCng+l9jpybZHnZdwS3SNcli775PLt6/yzZeqfyqu1ryQPMADvx4VV6HqvbCGIxCz0K2TaxdEb/mqS8Z+KaJhPLCsYFPHtUNIAXIs7WMR11WNtzrVlPyhW5NKwuWM7ejU3uk5c4OXLsz2Ee1QKOwKBgHmZNDEq6H43kC1+0b4/+6gd1a/NIg3/+uS0kYqlQ2qxSM8C4oUJDVsQp3Vs+3jN/gOv20Dt0V+oBthY/eATDxCrOPiGOrCZFF7gk0S5xe1Im6xydIY/QM5SMbf7CcVaWDmd4LnISzhpRGGu4GowsULgBPUs/+jjv6Z1qLiVoAV8",
        
 //    //     //异步通知地址
 //    //     'notify_url' => isset($data['notify_url']) ? $data['notify_url']:"http://lndttx.net/home/Pay/notify_url",
        
 //    //     //同步跳转
 //    //     'return_url' => isset($data['return_url']) ? $data['return_url']:"http://lndttx.net",

 //    //     //编码格式
 //    //     'charset' => "UTF-8",

 //    //     //签名方式
 //    //     'sign_type'=>"RSA2",

 //    //     //支付宝网关
 //    //     'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

 //    //     //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
 //    //     'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAhzQEYcMOPfKW1zlvDoxVyUtY5U8mh9mdcd+H3c5Laya1+4KUKegvX6T5TIVNJR4c3XxrB3eF7x5FskiwrnzY0yB+tj8i71SLTIbWqLiR6brM8+PxX38P9LbDR58VpWPh7ZglWvAvm/iEiwVdeAClQ3e9dchIx6JLoXfbDT+j4iF9rx2yltmJIp8ulreh780it1QLeslEz6WGuvQ3KTgNYFdYWBQcPcFxb1rrHbuM6VAFe9Bt/3XUA1tdyXEWHqax2EzIQWDvFChBk2oxow0xE4Ye4fgubP/ZVsFoHLRmoVGX/85Rt6SI2WGawU1Bm4VqhbpeRCnykyj+81zDDkHtEwIDAQAB",
        
    
 //    // );
    
 //    return $config;
 // }
//++++支付宝支付--旧的账号++E++

//++++支付宝支付++S++
 function alipayconfig($data=null){
    $config = array (   
        //应用ID,您的APPID。
        'app_id' => "12123123",

        //商户私钥，您的原始格式RSA私钥
        'merchant_private_key' => "",
        
        //异步通知地址
        'notify_url' => isset($data['notify_url']) ? $data['notify_url']:"http://lndttx.net/home/Pay/notify_url",
        
        //同步跳转
        'return_url' => isset($data['return_url']) ? $data['return_url']:"http://lndttx.net",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "",
        
    
        );
    return $config;
 }


 function alipay($data){
        header("Content-type:text/html;charset=utf-8");
        vendor('alipay/wappay/service/AlipayTradeService');
        vendor('alipay/wappay/buildermodel/AlipayTradeWapPayContentBuilder');

        $config=alipayconfig($data);

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $data['order_no'];
        //订单名称，必填
        $subject = isset($data['good_name'])?$data['good_name']:'商品支付';
        //付款金额，必填
        $total_amount = $data['total_price'];
        //商品描述，可空
        $body = isset($data['good_name'])?$data['good_name']:'商品支付';
        //超时时间
        $timeout_express="1m";
        $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setOutTradeNo($out_trade_no);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setTimeExpress($timeout_express);

        $payResponse = new \AlipayTradeService($config);
        $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        return ;
    }

    //支付宝支异步通知地址
    function alipay_pay_back(){
        vendor('alipay/wappay/service/AlipayTradeService');
        $config=alipayconfig();
        $arr=$_POST;
        $alipaySevice = new \AlipayTradeService($config); 
        // $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);
        return $result;
    }
    
//++++支付宝支付++E++



//按订单前缀取表
function get_table_name($order_no){
    //订单前缀
    $pre=substr($order_no,0,2);
    $table_arr=array('UD'=>'update_order','CZ'=>'money_recharge');
    $table=$table_arr[$pre];

    return $table;
}