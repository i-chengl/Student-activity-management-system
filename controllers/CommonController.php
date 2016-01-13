<?php

namespace app\controllers;

class CommonController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpload()
    {
    	
    	
    	
        return $this->render('upload');
    }

}
