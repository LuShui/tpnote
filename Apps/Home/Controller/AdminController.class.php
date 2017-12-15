<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends BaseController{


	/**
	 * 更新时间
	 */
  	public function timeupdate(){
        $oneday = 86400;
        $currtime = time();
        $model = M('notetable');
        $resArray = $model->order('id DESC')->select();
        foreach ($resArray as $key => $value) {
        	$abs = rand(2,5);
        	$currtime = ((int)$currtime - (int)($oneday *$abs));
        	echo date('Y-m-d',$currtime).'</br>';
        	$map['addtime'] = $currtime;
        	$id = $value['id'];
        	$model->where("id=$id")->save($map);
        }
    }

    /**
     * 文章列表
     */
    public function index(){
    	$result = M('notetable')->where("ishow=1")->order("addtime DESC")->select();
    	$this->assign('list',$result);
    	$this->display();
    }

    /**
     * 增加帖子
     */
    public function addnote(){
    	$this->display();
    }

    /**
	 * 添加笔记
	 */
	public function savecontent(){
		$model = M('notetable');
		$data = array();
	    $data['title'] = I('post.titlename');
		$data['type'] = I('post.type');
		$data['des'] = I('post.desbute');
		$data['ctn'] = I('content'); //''.mysql_real_escape_string($_POST['content']).'';
		$data['addtime'] = time();
		$result = $model->data($data)->add();
		$this->send($result);
	}

	/*
	编辑笔记
	 */
	public function editnote(){
		$id = I('get.id');
		$result = M('notetable')->where("id=$id")->find();
		$this->assign('json',$result);
		$this->assign('ctn',htmlspecialchars($result['ctn']));
		$this->display();
	}


	/**
	 * 笔记修改
	 */
	public function updatenote(){
		$model = M('notetable');
		$data = array();
	    $data['title'] = I('post.titlename');
		$data['type'] = I('post.type');
		$data['des'] = I('post.desbute');
		$data['ctn'] = ''.mysql_real_escape_string($_POST['content']).'';
		$id = I('post.id');
		$result = $model->where("id=$id")->save($data);
		$this->send($result);
	}

		/*
	改变笔记的状态
	 */
	public function changestaue(){
		$model = M('notetable');
		$id = I('get.id');
		$model->ishow = 0;
		$model->where("id=$id")->save();
		$result = M('notetable')->where("ishow=1")->order("addtime DESC")->select();
    	$this->assign('list',$result);
		$this->display('index');
	}


	public function yulan(){
		// $id = I('post.id');
		// $result = M('notetable')->where("id=$id")->find();
		// $this->assign('json',$result);
		// $this->display();
	}






/*****************************************************************************/
	 /*
    保存网址
     */
    public function addlink(){
    	$model = M('urltable');
    	$data = array();
    	$data['name'] = I('post.name');
    	$data['url'] = I('post.url');
    	$data['des'] = I('post.des');
	    $result = $model->data($data)->add();
	    $this->send($result);
    }
}