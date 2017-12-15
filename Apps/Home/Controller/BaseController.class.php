<?php
namespace Home\Controller;
use Think\Controller;
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type');

class BaseController extends Controller {


    public function __construct(){
        parent::__construct();
         if(!session('?admin')){
            $this->error("您还没有登录！",U("Home/login/login"),2);
        }else{
        }   
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