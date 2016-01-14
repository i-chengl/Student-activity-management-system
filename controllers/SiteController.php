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
        //存取控制过滤器（ACF），基于过滤器的访问控制      		
            'access' => [//某个规则没有或者为空的时候，表示匹配所有规则
                'class' => AccessControl::className(),
                'only' => ['logout','login','contact','about','admin'],
            		
            	'denyCallback' => function ($rule, $action) {
//        							 throw new \Exception('You are not allowed to access this page');
        							return $this->render('index');
            	},
                'rules' => [//允许所有已授权用户进行‘logout，contact’ 'about'操作
                    [
                        'actions' => ['logout', 'contact' ,'about'],
                        'allow' => true,
                        'roles' => ['@'],//'@'代表已授权用户
                    ],
                		
                	[
                		'actions' =>['login','about'],
                		'allow' =>true,
                		'roles' =>['?'],//'?'代表访客用户
//                 		'matchCallback' => function ($rule, $action) {
//                 			return date('d-m') === '31-10';
//                 			},//表示在特定的某一天才可以访问
                	],
                		
                	[
//                 		'controllers' =>['user'],
                		'actions' =>['admin'],
                		'allow' =>false,
                		'roles' =>['?'],
                	],
                	[
                		'actions' =>['admin'],
                		'allow' =>true,
                		'roles' =>['@'],
                		'ips' =>['127.0.0.1'],//仅支持本地使用，局域网或者外网不可访问
                	],
                	//	……
                ],
            ],
            'verbs' => [//用于判断哪种请求方式，get 或者post
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
        	
        	
//         	var_dump($model->usr_group);die;
        	if($model->usr_group == 2){
        		return $this->loginAdmin($model->toArray());
        		
//         		return $this->render('admin_index' , ['username' =>$model->usr_name]);
        	}
        	elseif($model->usr_group == 1){
        		return $this->loginManger($model->toArray());
//         		return $this->render('manger' , ['user' => $model->toArray()]);
        	}
        	return $this->goBack();
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
    
    
    private function loginManger($model)
    {
    	
    	return $this->render('manger' , ['user' =>$model]);
    }
    
    private function loginAdmin($model)
    {
    	return $this->render('admin_index' , ['username' =>$model['usr_name']]);
    }
}
