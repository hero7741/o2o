<?php
namespace app\admin\controller;

use think\Controller;
class Category extends Controller
{//入口
    public function _initialize(){
        $this->obj=model("Category");
    }
    public function index()
    {  
            $parent=input('get.parent_id',0,'intval');
            $categorys= $this->obj->getfirstCategorys($parent);
            return $this->fetch('',[
            'categorys'=>$categorys
        ]);
    }
//欢迎
    public function add(){
        $categorys=$this->obj->getNormalFirstCategory();
        
        return $this->fetch('',[
            'categorys'=>$categorys
        ]);
    }  
    public function save(){
//         print_r($_POST);
    $data=input('post.');
 
    //对数据进行校验
    if (!request()->isPost()){
        $this->error('请求失败');
    }
    $validate=validate('Category');
   
    if(!$validate->scene('add')->check($data)){
        $this->error($validate->getError());
    }
    if (!empty($data['id'])){
        return $this->update($data);
    }
   $res=$this->obj->add($data);
    if ($res){
        $this->success('sucess');
    }else {
        $this->error('fail');
    }
    }
    
    /*
     * 编辑
     */
    public function edit($id=0){
       if(intval($id)<0){
           $this->error('id不合法');
       }
       $category=$this->obj->get($id);
//        print_r($category);
       $categorys=$this->obj->getNormalFirstCategory();
       
       return $this->fetch('',[
           'categorys'=>$categorys,
           'category'=>$category,
       ]);
    }
    public function update($data){
        $res=$this->obj->save($data,['id'=>intval($data['id'])]);
        if($res){
            $this->success('success');
        }else {
            $this->error('faild');
        }
    }
    public function listorder($id,$listorder){
      $res=$this->obj->save(['listorder'=>$listorder],['id'=>$id]);
        if($res){
            $this->result($_SERVER['HTTP_REFERER'],1,'success');
        }else {
            $this->result($_SERVER['HTTP_REFERER'],0,'false');
        }
    }
    //修改状态
    public function status(){
//         print_r(input('get.'));
        $data=input('get.');
        

  
        $validate=validate('Category');
         
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        $res=$this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
        if($res){
            $this->success('success');
        }else {
            $this->error('false');
        }
    }
}
