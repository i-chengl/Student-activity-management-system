<?php
namespace app\models;

use yii\base\Model;
use app\models\interface_file\IUserManger;

class UserMangerModel extends Model implements IUserManger {
	
	/*  
	 * 查询自己组织过的活动
	 * @params
	 * @return
	 * */
	
	public function getActivityByid($id){
		
		return User::findOne(['usr_id' =>$id])
					->activities;
	}
	

	
	/*
	 * 根据用户id获取用户详细信息 
	 */
	
	public static function getUserById($id){
		
		return User::findOne(['usr_id' =>$id])->toArray();
	}
	
	/*根据用户名查询ID
	 * 
	  */
	public static function getIdByName($username){
		return User::find()
					->select('usr_id')
					->where(['usr_name' => $username])
					->asArray()
					->one();
	}
	
	public static function getClassById($id){
		
		return User::find()
					->select('usr_class')
					->where(['usr_id' => $id])
					->asArray()
					->one();
	}
	
	public static function getDepartById($id){
		return User::find()
					->select('usr_depart')
					->where(['usr_id'=>$id])
					->asArray()
					->one();
	}
	
	
	
	
	public function getActivityByUserId($user_id){
		
		return User::findOne(['usr_id' => $user_id])->activities;
	}
	
	/*  登陆
	 * */
	public function login(){}
	
	/*
	 * 退出 */
	public function logout(){}
	
	/*
	 * 注册 */
	public function register(){}
}