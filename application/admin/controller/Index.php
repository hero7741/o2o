<?php
namespace app\admin\controller;

use think\Controller;
class Index extends Controller
{//入口
    public function index()
    {
         return $this->fetch();
    }
    public function test(){
        \Map::getLngLat('北京昌平沙河地铁');
        
    }
    public function map(){
        return   \Map::staticimage('北京昌平沙河地铁');
    }
//欢迎
    public function welcom(){
        return 'welcom';
    }  
}
