<?php
namespace app\adminmall\controller;
use think\Controller;
use app\admin\controller\Base;
/**
 * 商品类型控制器
 * 
 */
class Industry extends Base
{


    /**
     * 用户列表
     * 
     */
    public function index()
    {   
        $tree =   $this->getTree();
        $this->assign('tree',$tree);

        return $this->fetch();
    }


    public  function getTree($pid='0')
    {
        $t=db('industry');
        $list=$t->where(array('pid'=>$pid))->order('sort_order desc')->select();
        $i=0;
        if(is_array($list)){
            $html = '';
                $i++;
                foreach($list as $k => $v)
                {
                   if($v['pid'] == $pid)
                   {   
                        //父亲找到儿子
                        $html .= '<li style="display:none" >';
                        // if($v['level']<3)
                        $html .= '<span>';
                  /*    $html .= '<i class="icon-plus-sign fa_plus blue"></i>' .$v['name'].'</span>';*/
                        $html .= '<i class="icon-plus-sign blue fa-plus"></i>';
                        $html .= $v['name'];
                        $html .= '</span>';
                        $html .= '<div class="right-cs" >';
                        $html .= '<span>排序：<input data="'.$v['id'].'" class="inputtxt" type="text" value="'.$v['sort_order'].'" ></span>';
                        
                        if($v['is_show']==1)
                            $html .= '<span><a data="'.$v['id'].'" val="'.$v['is_show'].'" class="label label-success-outline label-pill show" href="#">显示</a></span>';
                        else
                            $html .= '<span><a data="'.$v['id'].'" val="'.$v['is_show'].'" class="label label-warning-outline label-pill show" href="#">隐藏</a></span>';

                        $html .= '<a class="label label-primary-outline label-pill" href="'.url('edit',array('id'=>$v['id'])).'">编辑</a>';
                        $html .=' <a  name="delete" title="删除" class="label label-danger-outline label-pill ajax-get confirm"  href="'.url('delete',array('id'=>$v['id'])).'">删除</a>&nbsp;';
                        $html .='</div>';
                        $html .= $this->getTree($v['id']);
                        $html = $html."</li>";
                   }
                }
            return $html ? '<ul>'.$html.'</ul>' : $html ;
        }
    }

    /**
     * 编辑用户
     * 
     */
    public function edit()
    {
        $id=input('id');
        $selectpid=0;
        if(isset($id)){
            $info = db('industry')->find($id);
            $this->assign('info',$info);
            $selectpid=$info['pid'];
        }
        //获取上级分类
        $parent=$this->getParent($selectpid);
        $this->assign('parent',$parent);
        return $this->fetch();
        
    }


    public  function getParent($selectpid=0,$pid='0',$dir="")
    {
        $t=db('industry');
        $list=$t->where(array('pid'=>$pid,'level'=>array('eq',1)))->order('sort_order desc')->select();
        $i=0;
        if(is_array($list)){
            $html = '';
                $i++;
                foreach($list as $k => $v)
                {
                   if($v['pid'] == $pid)
                   {   
                        if($v['level']!=1)
                            $dir="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
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
                        
                        $html .= $this->getParent($selectpid,$v['id'],$dir);
                        $html = $html."</option>";
                   }
                }
            return $html;
        }
    }

    /**
     * [save 保存数据]
     * @return [type] [description]
     */
    public function save(){
        if (request()->isPost()) {
            $table = db('industry');
            $data        = input('post.');

            //如果是文件上传
            // if(!empty($_FILES['image']['name'])){
            //     $img=upload_img('image');
            //     if($img['status']){
            //         $data['image']=$img['path'];
            //     }else{
            //        $this->error($img['error']);
            //     }
            // }
            //+++验证数据++S+
            $rule = [
                'pid'  => 'require',
                'name' => 'require',
            ];
            $msg=[
                'pid.require'    => '请选择上级',
                'name.require'    => '分类名称不能为空',
            ];
            $res=$this->validate($data,$rule,$msg);
            if(true !== $res){
               error($res);
            }
            //+++验证数据++E+
            
            //查看上级
            $pid=$data['pid'];
            if($pid==0){
               $data['level']=1;
               $data['path']='0,';
            }else{
                $p_info=$table->where('id',$pid)->field('path,level')->find();
                if(!isset($p_info) || empty($p_info)){
                    error('上级不存在');
                }
                $data['level']=$p_info['level']+1;
                $data['path']=$p_info['path'];
            }
            
            //修改
            if(isset($data['id']) && !empty($data['id'])){
                $res = $table->update($data);
                $id=$data['id'];
            }else{ //添加
                $data['is_show']=1;
                $res = $table->insert($data);
                $id=$table->getLastInsID();
            }
            if ($res===false) {
                error('保存失败');
            } else {
                $path_data['path']=array('exp',"CONCAT(`path`,'".$id.",')");
                $table->where('id',$id)->update($path_data);
                success('保存成功', url('index'));
            } 
        }
    }
    

    /**
     * [changeorder 修改排序]
     * @return [type] [description]
     */
    public function changeorder(){
        $id=input('post.id');
        $sort_order=input('post.sort_order');
        $table=db('industry');
        $where['id']=$id;
        $res=$table->where($where)->setField('sort_order',$sort_order);
        if($res)
            success('修改成功');
        else
            error('修改失败');
    }

    /**
     * [showhide 显示后隐藏]
     * @return [type] [description]
     */
    public function showhide(){
        $id=input('post.id');
        $table=db('industry');
        $where['id']=$id;
        $is_show=$table->where($where)->value('is_show');
        if($is_show==0)
            $is_show=1;
        else
            $is_show=0;
        $res=$table->where($where)->setField('is_show',$is_show);
        if($res)
            success('修改成功');
        else
            error('修改失败');
    }
    
    public function delete(){
        $id=input('id');
        $table=db('industry');
        
        $res=$table->delete($id);
        if($res)
            success('删除成功');
        else
            error('删除失败');
    }
}
