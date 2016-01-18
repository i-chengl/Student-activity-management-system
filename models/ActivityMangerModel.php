<?php

namespace app\models;

use yii\base\Model;
use app\models\interface_file\IActivityManger;
use app\models\query\ActivityQuery;

class ActivityMangerModel extends Model  {
	
	
	
	public static function getAllActivity(){
		return Activity::find()
							->asArray()
							->all();
	}
	
	public function getActivityByActName($actName) {
		
// 		返回的是数组
		return Activity::find()
					->where(['act_name' =>$actName])
					->asArray()
					->all();
		
// 		返回的是对象
// 		return Activity::findAll(['act_name' => $actName]);
	}
	
	/*
	 * 根据活动状态查询活动
	 *   */
	
	public static function getActivityByState($state){
		return Activity::find()
							->where(['act_state' =>$state])
							->asArray()
							->all();
	}

	
// 	/* 
// 	 * 查看所有待审核的活动
// 	 *  */
// 	public static function getActivityWaitAudit(){
// 		return Activity::find()
// 							->where(['act_state' =>'0' ])
// 							->asArray()
// 							->all();
// 	}
	
// 	/*
// 	 * 查看所有审核未通过的活动
// 	 *   */
// 	public static function getActivityNotPass(){
// 		return Activity::find()
// 							->where(['act_state' => '1'])
// 							->asArray()
// 							->all();
// 	}
// 	/*
// 	 * 获取已完结的活动
// 	 *   */
// 	public static function getActivityFinished(){
// 		return Activity::find()
// 							->where(['act_state' =>'2'])
// 							->asArray()
// 							->all();
// 	}
	
	
	public function getActivityByDate($date){
		
	}
	
	//根据用户名查询自己参加的活动
	public function getActivityByPartName($name){
		
// 		$id = UserMangerModel::getIdByName($name);
		$id = User::findByUsername($name, 1)->usr_id;
		
		return $this->getActivityByParyId($id['usr_id']);
	}
	
	
	/*
	 * 根据用户ID获取自己参加的活动  
	 * */
	public function getActivityByParyId($id){
		//我参加的活动的活动id 集合
		$act_id = array();
		
		$activity = Activity::find()
						->select(['act_id','act_partici'])
						->asArray()
						->all();
		//对集体活动进行处理
		$classArray = UserMangerModel::getClassById($id);
		$departArray = UserMangerModel::getDepartById($id);
		
		$class = $classArray['usr_class'];
		$depart = $departArray['usr_depart'];
		
		foreach ($activity as $value){
				
			$name = $value['act_id'];
			$partici = $value['act_partici'];
			
			//包含个人活动的ID 和集体活动的集体名称 如：计算机1201  后续考虑扩展的话 需要建立班级，学院表
			$nameArray = explode('、', $partici);
				
			if( in_array($id, $nameArray) || in_array($class, $nameArray) || in_array($depart, $nameArray)){
				$act_id[] = $name;
			}
		}
		
		return Activity::find()
					->where(['in','act_id',$act_id])
					->asArray()
					->all();
	}

}