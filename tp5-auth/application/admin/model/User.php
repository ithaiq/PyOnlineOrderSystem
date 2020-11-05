<?php 
namespace app\admin\model;

use think\Model;
/**
* 用户模型
*/
class User extends Model
{
	protected $table = 'think_user';
	protected $pk = 'id';

	//关联用户组明细表，一对多
	public function getGroup()
	{
		return $this->hasMany('GroupAccess','uid');
	}
}