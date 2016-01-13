<?php

namespace app\controllers;



use app\models\User;
use app\models\Activity;
use app\models\ActivityMangerModel;
class TestController extends \yii\web\Controller
{
//     public function actionIndex()
//     {

//         return $this->render('index');
//     }
    
//     public function actionTest(){
//     	$connetion = \Yii::$app->db;
//     	$sql = 'select * from act_user';
//         $query = $connetion->createCommand($sql);
        
//         $reslt = $query->queryone();
//        var_dump($reslt['usr_name']);
    	
//     }
    
//     public function actionTest2(){
//     	$activity = new Activity();
    	
//     	$activity->act_id_submit = 'name';
// //     	$activity->

//     	$user = new User();
//     	$user->usr_name = '测试';
//     	$user->usr_passwd ='12345';
//     	$user->usr_id = '2321321321';
//     	$user->usr_state ='1';
    	
//     	try {
//     		$user->save();
//     	} catch (Exception $e) {
//     		echo '出错';
//     	}
//     }
	private $act_name = "测试添加活动";
	private  $act_id = 3120602019;
	private $user_name = "陈林";

	public function actionIndex(){
		
		$activity = new ActivityMangerModel();
		
// 		$reslut = $activity->getActivityByActName($this->act_name);
		
		$reslut = $activity->getActivityByParyId($this->act_id);

// 		$reslut = $activity->getActivityByPartName($this->user_name);
		
		var_dump($reslut);
	}

}
