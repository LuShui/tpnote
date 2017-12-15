<?php
namespace Home\Controller;
use Think\Controller;
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type');
class HomeController extends Controller {

	/**
	 * 获取数据
	 * @return [type] [description]
	 */
    public function getsoure(){
      	$type = I('post.type',6);	
      	$model = M('notetable');
      	$result = $model->where("type=$type and ishow=1")->order('addtime DESC')->select();
      	$this->send($result);
    }


    /**
     * 修改点击量
     */
    public function addnum(){
		$id = I('post.id',54);	
      	$model = M('notetable');
      	$result = $model->where("id=$id")->find();
      	$map['num'] = (int)($result['num']) + 1;
      	$model->where("id=$id")->save($map);
    }


    /**
     * 获取笔记详情
     */
    public function getdetil(){
    	$id = I('post.id',42);
    	$model = $model = M('notetable');
    	$result = $model->where("id=$id")->find();
      $ctn = $result['ctn'];
      $result['ctn'] = htmlspecialchars_decode($ctn);
    	$this->send($result);
    }

    /*
    接口输出函数
   */
    public function send($soure){
      $backArray = array();
      if (!empty($soure)) {
        $backArray = array(
          'code'=>1,
          'ctn'=>$soure
          );
      }else {
        $backArray = array(
          'code'=>0,
          'ctn'=>array()
          );
      }
      echo json_encode($backArray);
    }
}