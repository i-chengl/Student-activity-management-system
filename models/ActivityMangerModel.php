<?php

namespace app\models;

use yii\base\Model;
use app\models\interface_file\IActivityManger;
use app\models\query\ActivityQuery;

class ActivityMangerModel extends Model implements IActivityManger {
	
	
	
	public function getActivityByActName($actName) {
		
		return Activity::find()
			->where(['act_name' =>$actName])
			->asArray()
			->all();
	}
	
	
	public function getActivityByDate($date){
		
	}
	
	//根据用户名查询自己参加的活动
	public function getActivityByPartName($name){
		
		$id = UserMangerModel::getIdByName($name);
		
		return $this->getActivityByParyId($id['usr_id']);
	}
	
	
	
	
	public function getActivityByParyId($id){
		
		$this->getPensonlAcitivityById($id);

	}
	
	/*根据用户ID获取自己参加的个人活动  */
	public function getPensonlAcitivityById($id){
		//我参加的活动的活动id 集合
		$act_id = array();
		
		$activity = Activity::find()
						->select(['act_id','act_partici'])
						->where(['act_is_personal' =>1])
						->asArray()
						->all();
		foreach ($activity as $value){
				
			$name = $value['act_id'];
			$partici = $value['act_partici'];
			$nameArray = explode('、', $partici);
				
			if(in_array($id, $nameArray)){
				$act_id[] = $name;
				// 				var_dump($act_id);die;
			}
		}
		
		return Activity::find()
					->where(['in','act_id',$act_id])
					->asArray()
					->all();
	}
	
	
	public function getGroupActivityById($id){
		
	}
	
	
}