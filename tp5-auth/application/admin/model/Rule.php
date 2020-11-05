<?php 
namespace app\admin\model;

use think\Model;
/**
* 权限规则模型
*/
class Rule extends Model
{
	protected $table = 'think_rule';
	protected $pk = 'id';
}