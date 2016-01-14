<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;

/**
 * 检查是否匹配用户的组
 */
class UserGroupRule extends Rule
{
	public $name = 'userGroup';

	public function execute($user, $item, $params)
	{
		if (!Yii::$app->user->isGuest) {
			$group = Yii::$app->user->identity->group;
			if ($item->name === 'admin') {
				return $group == 2;
			} elseif ($item->name === 'user') {
				return $group == 2 || $group == 1;
			}
		}
		return false;
	}
}

	$auth = Yii::$app->authManager;
	
	$rule = new \app\rbac\UserGroupRule;
	$auth->add($rule);
	
	$author = $auth->createRole('user');
	$author->ruleName = $rule->name;
	$auth->add($author);
	// ... 添加$author角色的子项部分代码 ... （注：省略部分参照之前的控制台命令）
	
	$admin = $auth->createRole('admin');
	$admin->ruleName = $rule->name;
	$auth->add($admin);
	$auth->addChild($admin, $author);
	// ... 添加$admin角色的子项部分代码 ... （注：省略部分参照之前的控制台命令）