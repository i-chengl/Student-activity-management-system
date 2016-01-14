<?php


/* 
 * 可用于一次性初始化数据
 * 权限层次不会发生变化，用户数恒定
 *  */
namespace app\commands;


use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
	public function actionInit()
	{
		$auth = Yii::$app->authManager;

		// 添加 "createPost" 权限
		$createPost = $auth->createPermission('createPost');
		$createPost->description = 'Create a post';
		$auth->add($createPost);

		// 添加 "updatePost" 权限
		$updatePost = $auth->createPermission('updatePost');
		$updatePost->description = 'Update post';
		$auth->add($updatePost);

		// 添加 "user" 角色并赋予 "createPost" 权限
		$user = $auth->createRole('user');
		$auth->add($user);
		$auth->addChild($user, $createPost);

		// 添加 "admin" 角色并赋予 "updatePost"
		// 和 "author" 权限
		$admin = $auth->createRole('admin');
		$auth->add($admin);
		$auth->addChild($admin, $updatePost);
		$auth->addChild($admin, $author);

		// 为用户指派角色。其中 1 和 2 是由 IdentityInterface::getId() 返回的id （注：user表的id）
		// 通常在你的 User 模型中实现这个函数。
		$auth->assign($user, 2);//为每个用户分配角色
		$auth->assign($admin, 1);
	}
}