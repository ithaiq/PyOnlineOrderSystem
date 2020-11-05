<?php 
namespace app\admin\controller;

use think\Controller;
/**
* 权限管理控制器
*/
class Auth extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return $this->redirect('authList');
	}

	//权限列表
	public function authList()
	{
		return $this->fetch();
	}

	//添加权限
	public function addAuth()
	{
		return $this->fetch();
	}
}