<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 当燃
 * Date: 2015-09-17
 */

namespace app\seller\controller;

use file\File;
use think\log;
use think\Image;
use think\Request;
/**
 * Class UeditorController
 * @package Admin\Controller
 */
class Ueditor extends Base
{
    private $sub_name = array('date', 'Y/m-d');
    private $savePath = 'temp/';

    public function __construct()
    {
        parent::__construct();

        //header('Access-Control-Allow-Origin: http://www.baidu.com'); //设置http://www.baidu.com允许跨域访问
        //header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); //设置允许的跨域header

        date_default_timezone_set("Asia/Shanghai");

        $this->savePath = input('savepath','temp').'/';

        error_reporting(E_ERROR | E_WARNING);

        header("Content-Type: text/html; charset=utf-8");
    }

	

    /**
     * @function imageUp
     */
    public function imageUp()
    {
        // 上传图片框中的描述表单名称，
        $pictitle = input('pictitle');
        $dir = input('dir');
        $title = htmlspecialchars($pictitle , ENT_QUOTES);
        $path = htmlspecialchars($dir, ENT_QUOTES);
        //$input_file ['upfile'] = $info['Filedata'];  一个是上传插件里面来的, 另外一个是 文章编辑器里面来的
        // 获取表单上传文件
        $file = request()->file('file');
        if(empty($file))
            $file = request()->file('upfile');

		$result = $this->validate(
				['file' => $file],
				['file'=>'image|fileSize:40000000|fileExt:jpg,jpeg,gif,png'],
				['file.image' => '上传文件必须为图片','file.fileSize' => '上传文件过大','file.fileExt'=>'上传文件后缀名必须为jpg,jpeg,gif,png']
		);
        if (true !== $result || !$file) {
            $state = "ERROR" . $result;
        } else {
            $savePath = $this->savePath.date('Y').'/'.date('m-d').'/';
            // $ossConfig = tpCache('oss');
            $ossSupportPath = ['goods', 'water'];
            // if (in_array(input('savepath'), $ossSupportPath) && $ossConfig['oss_switch']) {
            if (in_array(input('savepath'), $ossSupportPath)) {
                //商品图片可选择存放在oss
                $object = 'uploads/'.$savePath.md5(time()).'.'.pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);
                $ossClient = new \app\common\logic\OssLogic;
                $return_url = $ossClient->uploadFile($file->getRealPath(), $object);
                if (!$return_url) {
                    $state = "ERROR" . $ossClient->getError();
                    $return_url = '';
                } else {
                    $state = "SUCCESS";
                }
                @unlink($file->getRealPath());
            } else {
                // 移动到框架应用根目录/static/uploadss/ 目录下
                $info = $file->rule(function ($file) {
                return  md5(mt_rand()); // 使用自定义的文件保存规则
                })->move('uploads/'.$savePath);
                if ($info) {
                    $state = "SUCCESS";
                } else {
                    $state = "ERROR" . $file->getError();
                }
                $return_url = '/uploads/'.$savePath.$info->getSaveName();
            }
            $return_data['url'] = $return_url;
        }

        if($state == 'SUCCESS'){
        	if($this->savePath=='Goods/'){
        		$image = new \Think\Image();
        		$water = tpCache('water');
        		$imgresource = ".".$return_data['url'];
        		$image->open($imgresource);
        		if($water['is_mark']==1 && $image->width()>$water['mark_width'] && $image->height()>$water['mark_height']){
        			if($water['mark_type'] == 'text'){
        				$image->text($water['mark_txt'],'./hgzb.ttf',20,'#000000',9)->save($imgresource);
        			}else{
        				$image->water(".".$water['mark_img'],9,$water['mark_degree'])->save($imgresource);
        			}
        		}
        	}
        }
        $return_data['title'] = $title;
        $return_data['original'] = ''; // 这里好像没啥用 暂时注释起来
        $return_data['state'] = $state;
        $return_data['path'] = $path;
        echo json_encode($return_data);
        // return $return_data;
    }


}