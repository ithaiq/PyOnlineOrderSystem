<?php 
namespace app\admin\model;

use think\Model;
/**
* 用户分组明细表
*/
class GroupAccess extends Model
{
	protected $table = 'think_group_access';
	protected $pk = 'id';
}