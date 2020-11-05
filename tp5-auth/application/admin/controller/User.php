<?php 
namespace app\admin\controller;

use app\admin\controller\Common;
use think\Db;
use think\Cache;
use think\Request;
use app\admin\model\User as U;		//使用 User 模型
use app\admin\model\Group as G;		//使用 Group 模型
/**
* 用户控制器
*/
class User extends Common
{
	public $view;	//视图实例
	function __construct()
	{
		parent::__construct();
		$this->view = new \think\View();
	}

	public function index()
	{
		return $this->view->fetch();
	}

	//添加用户
	public function adduser()
	{
		return $this->view->fetch();
	}

	//编辑用户
	public function editUser($id)
	{
		return $this->view->fetch();
	}

	//删除用户
	public function delUser($id)
	{
		
	}

	//分组列表
	public function groupList()
	{
		return $this->view->fetch();
	}

	//添加分组
	public function addGroup()
	{
		return $this->view->fetch();
	}

	//编辑分组信息
	public function editGroup($id)
	{
		return $this->view->fetch();
	}

	//删除分组
	public function delGroup($id)
	{
		
	}

	//锁定分组
	public function lockGroup($id,$lock)
	{
		
	}

	//锁定用户
	public function lockUser($id,$lock)
	{
		
	}

	//检查用户信息唯一性
	public function checkUnique($name,$email,$id = 0)
	{
		
	}
}