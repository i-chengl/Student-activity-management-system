<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\UploadFileModel;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
       

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//             return $this->goBack();
				$this->actionAdmin();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    
    
    
    public function actionUpload()
    {
    	$model = new UploadFileModel();
    
    	if (Yii::$app->request->isPost) {
    		$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
    		if ($model->uploadImage()) {
    			echo "上传成功";// 文件上传成功
    			return;
    		}
    	}
    
    	return $this->render('upload', ['model' => $model]);
    }
    
    
    
    

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionAdmin()
    {
    	return $this->render('admin_index' , ['username' =>'']);
    }
}
