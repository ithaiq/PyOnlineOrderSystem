<?php 
namespace app\admin\controller;

use think\Request;		//使用 Request 类，也可以直接使用它的助手函数
use app\admin\model\User;		//使用用户模型
use think\Controller;
use think\Db;		//使用 Db 数据库类
use app\admin\controller\Common;		//使用 Common 控制器
/**
* 公共控制器
*/
class Publics extends Controller
{
	public $captcha;
	function __construct()
	{
		parent::__construct();
		$this->captcha = new \think\captcha\Captcha();
	}
	
	public function index()
	{
		return $this->fetch('login');
	}

	//访问登录页面
	public function login()
	{
		return $this->fetch();
	}

	//登出
	public function logout()
	{
		
	}

	//执行登录操作
	public function doLogin()
	{
		
	}

	//生成验证码
	public function createCode()
	{
		return $this->captcha->entry();
	}

	//更新登录数据
	public function notify($uid)
	{
		
	}

}