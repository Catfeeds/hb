<?php
namespace app\admin\controller;
use think\Controller;
/**
* 管理员控制器
* 
*/
class News extends Base
{
/**
* 管理员列表
* 
*/

//栏目列表页
public function index()
{//搜索
	$map=array();
	$keyword             = input('keyword', '', 'string');
	if($keyword){
		$condition           = array('like', '%' . $keyword . '%');
		$map['title|id|sort|pid'] = $condition;
	}
	$user_object   = db('news_title'); 
	$data_list     = $user_object           
	->where($map)
	->order('sort desc')
	->paginate(10,false,['query'=>request()->param()]);
	$this->assign('list',$data_list);
	$page=$data_list->render();
	$this->assign('table_data_page',$page);
	return $this->fetch();
}

//新增栏目页
public function addtitle()
{
	$id=input('id');
	if(isset($id)){
		$info = db('news_title')->find($id);
		$this->assign('info',$info);
	}
	return $this->fetch();
}


//保存栏目名称
public function savetitle()
{
	if (request()->isAjax())
	{
		$table = db('news_title');
		$data   = input('post.');
		if(empty($data['title'])){
			error('栏目名称不能为空'); 
		}
		$data['addtime']=time();
		//修改
		if(isset($data['id']) && !empty($data['id']))
		{
			$titles = $table->update($data);
		}else
		{ //添加                                                  
			$titles = $table->insert($data);
		}
		if ($titles===false) 
		{
			error('保存失败');
		}else
		{
			success('保存成功', url('index'));
		} 
	}     
}

//删除子栏目
public function deletetitle()
{
	$data  = input('id');//传过来的栏目id    
	$news = db('news');//新闻表
	$id['pid'] = $data;     
	$havenews=$news->where($id)->select();//查询input(id)栏目下的新闻
	if ($havenews)
	{//如果有数据
		error('请先删除栏目下的新闻!');
	}else
	{         
		$news_title = db('news_title');//新闻栏目表
		$ids['id'] = $data;
		$dlttitle = $news_title->where($ids)->delete();
	}                  
	if ($dlttitle===false)
	{
		error('删除失败!');
	}else
	{
		success('删除成功!', url('index'));
	} 
}

//新闻列表页
public function entry()
{//搜索
	$map=array();
	$keyword               = input('keyword', '', 'string');
	if($keyword)
	{
		$condition             = array('like', '%' . $keyword . '%');
		$map['type|id|px|title'] = $condition;
	}   
	$user_object   = db('news'); 
	$data_list     = $user_object
	->where($map)
	->order('px desc')
	->paginate(10,false,['query'=>request()->param()]);
	$this->assign('list',$data_list);
	$page=$data_list->render();
	$this->assign('table_data_page',$page);
	return $this->fetch();
}

//添加新闻页
public function addnews()
{      
	
	$id=input('ids');
	$type_id=0;
	if(isset($id))
	{
		$info = db('news')->find($id);
		$type_id=$info['pid'];
		$this->assign('info',$info);
	}
	$arr=array(
		'news_name' =>  $this->newss($type_id),
	);
	$this->assign($arr);
	return $this->fetch();      
}

//新闻栏目信息
private function newss($selectid=0)
{
	$db=db('news_title');
	$info=$db->where('id != 6')->order('sort desc')->select();
	$title=$db->where('id = 6')->value('title');
	$str='';
	foreach ($info as $k => $v) 
	{
		if($v['pid']==6){
			if($selectid==$v['id'])
			$str.='<option selected="true" value="'.$v['id'].'" >'.$title.'-'.$v['title'].'</option>';
			else
				$str.='<option value="'.$v['id'].'" >'.$title.'-'.$v['title'].'</option>';
		}else{
			if($selectid==$v['id'])
				$str.='<option selected="true" value="'.$v['id'].'" >'.$v['title'].'</option>';
			else
				$str.='<option value="'.$v['id'].'" >'.$v['title'].'</option>';
		}
		
	}
	return $str;
}

//保存新闻
public function savenews()
{
	if (request()->isAjax())
	{
		$table = db('news');
		$data  = input('post.');         
		$id['id']=$data['pid'];
		$path=db('news_title')->where($id)->find();  
		if(empty($data['title']))
		{
			error('标题不能为空');
		}
		$data['addtime']=time();
		//修改
		if(isset($data['id']) && !empty($data['id']))
		{               
			$up = $table->update($data);
		}else
		{ //添加        
			$data['type']=$path['title'];           
			$up = $table->insert($data);
		}
		if ($up===false) {
			error('保存失败');
		}else 
		{
			success('保存成功', url('entry'));
		} 
	}
}

//删除新闻
public function deletenews()
{
	$data  = input('ids');//传过来的新闻id    
	$id['id'] = $data;     
	$dltnews = db('news')->where($id)->delete();                    
	if ($dltnews===false)
	{
		error('删除失败');
	}else
	{
		success('删除成功', url('entry'));
	} 
}




//学员列表页
public function student()
{
	//搜索
	$map=array();
	$keyword         = input('keyword', '', 'string');
	if($keyword)
	{
		$condition       = array('like', '%' . $keyword . '%');
		$map['name|id|addres|sort'] = $condition;
	}
	$user_object   = db('school_people'); 
	$data_list     = $user_object           
	->where($map)
	->order('addtime desc')
	->paginate(10,false,['query'=>request()->param()]);
	$this->assign('list',$data_list);
	$page=$data_list->render();
	$this->assign('table_data_page',$page);
	return $this->fetch();
}

//添加成员信息页面
public function school_add_people($id=0)
{
	$id=input('id');
	if(isset($id))
	{
		$info = db('school_people')->find($id);
		$this->assign('info',$info);
	}
	return $this->fetch();
}



//保存学员信息
public function save_people()
{
	if (request()->isPost()) 
	{
		$table = db('school_people');
		$data  = input('post.');
		//如果是文件上传
		// if(!empty($_FILES['image']['name']))
		// {
		// 	$img=upload_img('image');
		// 	if($img['status'])
		// 	{
		// 		$data['image']=$img['path'];
		// 	}else
		// 	{
		// 		$this->error($img['error']);
		// 	}
		// }
		$data['addtime']=time();
		if(empty($data['name']))
		{
			error('姓名不能为空');
		}
		if(empty($data['image']))
		{
			error('请上传头像');
		}
		if(empty($data['content']))
		{
			error('请填写介绍');
		}     
		if(isset($data['id']) && !empty($data['id']))
		{//修改
			$res = $table->update($data);
		/*            $id=$data['id'];*/
		}else
		{ //添加          
			$res = $table->insert($data);
		/*            $id=$table->getLastInsID();*/
		}
		if($res===false) 
		{
			error('保存失败');
		}else 
		{
			success('保存成功', url('student'));
		} 
	}	
}

//删除成员
public function delete_people()
{
	$id  = input('id');//传过来的成员id    
	$m = db('school_people');//成员作品表
	$where['id'] = $id;
	$dltpeople = $m->where($where)->delete();
	if ($dltpeople===false)
	{
		error('删除失败!');
	}else
	{
		success('删除成功!', url('student'));
	} 
}


//成员作品页
public function zuopin()
{//搜索
	$map=array();
	$keyword        = input('keyword', '', 'string');
	if($keyword)
	{
		$condition      = array('like', '%' . $keyword . '%');
		$map['people_id|people_name|title|id|sort'] = $condition;
	}   
	$user_object   = db('school_details'); 
	$data_list     = $user_object
	->where($map)
	->order('sort desc')
	->paginate(10,false,['query'=>request()->param()]);
	$this->assign('list',$data_list);
	$page=$data_list->render();
	$this->assign('table_data_page',$page);

	return $this->fetch();
}

//添加成员作品页
public function school_add_details()
{
$arr=array(
'people_name' =>  $this->peoples(),     
);
$this->assign($arr);
$id=input('ids');
if(isset($id))
{
	$info = db('school_details')->find($id);
	$this->assign('info',$info);
}
return $this->fetch();      
}

//成员栏目信息
private function peoples($selectid=0)
{
	$db=db('school_people');
	$info=$db->order('sort desc')->select();
	$str='';
	foreach ($info as $k => $v) 
	{
		if($selectid==$v['id'])
		$str.='<option selected="true" value="'.$v['id'].'" >'.$v['name'].'</option>';
		else
		$str.='<option value="'.$v['id'].'" >'.$v['name'].'</option>';
	}
	return $str;
}

//保存成员作品
public function save_details()
{
	if (request()->isAjax())
	{
		$table = db('school_details');
		$data  = input('post.');         
		$id['id']=$data['people_id'];
		$path=db('school_people')->where($id)->find();
		if(empty($data['people_id']))
		{
			error('请选择成员！');
		}
		if(empty($data['title']))
		{
			error('请输入标题！');
		}
		if(empty($data['link']))
		{
			error('请填写视频连接！');
		}
		if(empty($data['content']))
		{
			error('请填写内容描述！！');
		}
		$data['addtime']=time();
		//修改
		if(isset($data['id']) && !empty($data['id']))
		{               
			$up = $table->update($data);
		}else
		{ //添加        
			$data['people_name']=$path['name'];           
			$up = $table->insert($data);
		}
		if ($up===false) 
		{
			error('保存失败');
		}else 
		{
			success('保存成功', url('zuopin'));
		} 
	}
}

//删除成员作品
public function delete_details()
{
	$data  = input('ids');//传过来的新闻id    
	$id['id'] = $data;     
	$dltdetails = db('school_details')->where($id)->delete();                    
	if ($dltdetails===false)
	{
		error('删除失败');
	}else
	{
		success('删除成功', url('zuopin'));
	} 
}



}
