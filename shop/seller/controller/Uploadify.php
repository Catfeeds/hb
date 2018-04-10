<?php
namespace app\seller\controller;

class Uploadify extends Base{
   
    public function upload(){
        $func = input('func');
        $path = 'temp';//input('path','temp');
        $info = array(
        	'num'=> input('num/d'),
            'title' => '',       	
            'upload' =>url('Ueditor/imageUp',array('savepath'=>$path,'pictitle'=>'banner','dir'=>'images')),
        	'fileList'=>url('Uploadify/fileList',array('path'=>$path)),
            'size' => '4M',
            'type' =>'jpg,png,gif,jpeg',
            'input' => input('input'),
            'func' => empty($func) ? 'undefined' : $func,
        );
        $this->assign('info',$info);
        return $this->fetch();
    }
    
    /*
              删除上传的图片
     */
    public function delupload(){
        $action = input('action','del');                
        $filename= input('filename');
        // $filename= input('url');
        $filename= str_replace('../','',$filename);
        $filename= trim($filename,'.');
        $filename= trim($filename,'/');
        if($action=='del' && !empty($filename) && file_exists($filename)){
            $size = getimagesize($filename);
            $filetype = explode('/',$size['mime']);
            if($filetype[0]!='image'){
                exit;
            }
            if(unlink($filename)){
            	echo 1;
            }else{
            	echo 0;
            }  
            exit;
        }
    }
    
    public function fileList(){
    	/* 判断类型 */
    	$type = input('type','Images');
    	switch ($type){
    		/* 列出图片 */
    		case 'Images' : $allowFiles = 'png|jpg|jpeg|gif|bmp';break;
    	
    		case 'Flash' : $allowFiles = 'flash|swf';break;
    	
    		/* 列出文件 */
    		default : $allowFiles = '.+';
    	}
        
    	$upload_config=config('UPLOAD_CONFIG');
        $savePath=$upload_config['savePath'];
    	$path =  $savePath.input('path','temp');
    	//echo file_exists($path);echo $path;echo '--';echo $allowFiles;echo '--';echo $key;exit;
    	$listSize = 100000;
    	
    	$key = empty(input('key')) ? '' : input('key');
    	
    	/* 获取参数 */
    	$size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
        $start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
    	$end = $start + $size;
    	
    	/* 获取文件列表 */
    	$files = $this->getfiles($path, $allowFiles, $key);
    	if (!count($files)) {
    		echo json_encode(array(
    				"state" => "没有相关文件",
    				"list" => array(),
    				"start" => $start,
    				"total" => count($files)
    		));
    		exit;
    	}
    	
    	/* 获取指定范围的列表 */
    	$len = count($files);
    	for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
    		$list[] = $files[$i];
    	}
    	
    	/* 返回数据 */
    	$result = json_encode(array(
    			"state" => "SUCCESS",
    			"list" => $list,
    			"start" => $start,
    			"total" => count($files)
    	));
    	
    	echo $result;
    }

    /**
     * 遍历获取目录下的指定类型的文件
     * @param $path
     * @param array $files
     * @return array
     */
    private function getfiles($path, $allowFiles, $key, &$files = array()){
    	if (!is_dir($path)) return null;
    	if(substr($path, strlen($path) - 1) != '/') $path .= '/';
    	$handle = opendir($path);
    	while (false !== ($file = readdir($handle))) {
    		if ($file != '.' && $file != '..') {
    			$path2 = $path . $file;
    			if (is_dir($path2)) {
    				$this->getfiles($path2, $allowFiles, $key, $files);
    			} else {
    				if (preg_match("/\.(".$allowFiles.")$/i", $file) && preg_match("/.*". $key .".*/i", $file)) {
    					$files[] = array(
    						'url'=> '/'.$path2,
    						'name'=> $file,
    						'mtime'=> filemtime($path2)
    					);
    				}
    			}
    		}
    	}
    	return $files;
    }
    
    public function preview(){
	    
	    // 此页面用来协助 IE6/7 预览图片，因为 IE 6/7 不支持 base64
		$DIR = 'preview';
		// Create target dir
		if (!file_exists($DIR)) {
		    @mkdir($DIR);
		}
		
		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 3600; // Temp file age in seconds
		
		if ($cleanupTargetDir) {
		    if (!is_dir($DIR) || !$dir = opendir($DIR)) {
		        die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
		    }
		
		    while (($file = readdir($dir)) !== false) {
		        $tmpfilePath = $DIR . DIRECTORY_SEPARATOR . $file;		
		        // Remove temp file if it is older than the max age and is not the current file
		        if (@filemtime($tmpfilePath) < time() - $maxFileAge) {
		            @unlink($tmpfilePath);
		        }
		    }
		    closedir($dir);
		}
		
		$src = file_get_contents('php://input');
		if (preg_match("#^data:image/(\w+);base64,(.*)$#", $src, $matches)) {		
		    $previewUrl = sprintf(
		        "%s://%s%s",
		        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
		        $_SERVER['HTTP_HOST'],$_SERVER['REQUEST_URI']
		    );
		    $previewUrl = str_replace("preview.php", "", $previewUrl);
		    $base64 = $matches[2];
		    $type = $matches[1];
		    if ($type === 'jpeg') {
		        $type = 'jpg';
		    }
		
		    $filename = md5($base64).".$type";
		    $filePath = $DIR.DIRECTORY_SEPARATOR.$filename;
		
		    if (file_exists($filePath)) {
		        die('{"jsonrpc" : "2.0", "result" : "'.$previewUrl.'preview/'.$filename.'", "id" : "id"}');
		    } else {
		        $data = base64_decode($base64);
		        file_put_contents($filePath, $data);
		        die('{"jsonrpc" : "2.0", "result" : "'.$previewUrl.'preview/'.$filename.'", "id" : "id"}');
		    }
		} else {
		    die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "un recoginized source"}}');
		}
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