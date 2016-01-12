<?php

namespace app\controllers;



use app\models\User;
use app\models\Activity;
class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {

        return $this->render('index');
    }
    
    public function actionTest(){
    	$connetion = \Yii::$app->db;
    	$sql = 'select * from act_user';
        $query = $connetion->createCommand($sql);
        
        $reslt = $query->queryone();
       var_dump($reslt['usr_name']);
    	
    }
    
    public function actionTest2(){
    	$activity = new Activity();
    	
    	$activity->act_id_submit = 'name';
//     	$activity->

    	$user = new User();
    	$user->usr_name = '测试';
    	$user->usr_passwd ='12345';
    	$user->usr_id = '2321321321';
    	$user->usr_state ='1';
    	
    	try {
    		$user->save();
    	} catch (Exception $e) {
    		echo '出错';
    	}
    	
    	
    }

}
