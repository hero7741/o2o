<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected $autoWriteTimestamp=TRUE;
    public function add($data){
        $data['status']=1;
//         $data['create_time']=time();
       return  $this->save($data);
    }
    public function getNormalFirstCategory(){
        $data=[
            'status'=>1,
            'parent_id'=>0,
        ];
        
        $order=[
           'id'=>'desc',
        ];
        return $this->
        where($data)->
        order($order)->
        select();
    }
    public function getfirstCategorys($parentID=0){
        $data=[
            'parent_id'=>$parentID,
            'status'=>['neq',-1],
        ];
        $order=[
            'listorder'=>'desc',
            'id'=>'desc',
        ];
        $res=$this->where($data)->order($order)->paginate(2);
       
        return $res;
    }
}