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
		
	}
	
	/*
	 * 查询自己参过过的活动
	 * @return
	 * @params
	 *   */
	
}