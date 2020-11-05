<?php 
namespace app\admin\model;

use think\Model;
/**
* 用户分组模型
*/
class Group extends Model
{
	protected $table = 'think_group';
	protected $pk = 'id';
}