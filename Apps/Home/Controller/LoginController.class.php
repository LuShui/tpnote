<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller{
	public function login(){
		$this->display();
	}
	public function userlogin(){
		$url = __ROOT__.'/index.php/home/admin/index';
		$username = I('post.username');
		$password = I('post.password');
		if ($username == 'lushui' && $password == '718093910') {
			session('admin','lushui'); 
			header("Location: $url");
		}else{
			$this->error("用户名密码错误",U("Home/login/login"),2);
		}
	}


	public function layout(){
		// $url = __ROOT__.'/index.php/home/login/login';
		session('admin',null); 
		// $this->display('login');
	}
}



