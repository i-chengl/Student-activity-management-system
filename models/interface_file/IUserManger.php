<?php

namespace app\models\interface_file;


/*
 * 与用户有关的功能接口
 * 
 * 有具体的类进行实现
 * */
interface IUserManger {
	
	
// 	public $user

	
	/*
	 *根据用户ID 查询活动   */
	public function getActivityByUserId($user_id); 
	
	/*  登陆
	 * */
	public function login();
	
	/* 
	 * 退出 */
	public function logout();
	
	/* 
	 * 注册 */
	public function register();
}