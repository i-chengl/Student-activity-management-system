<?php

namespace app\controllers;

use Yii;
use app\models\Activity;
use app\models\search\ActivitySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\ActivityMangerModel;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class ActivityController extends Controller
{
	
	public $enableCsrfValidation = false;//不防范csrf攻击
	
    public function behaviors()
    {
        return 
        [
        	'access' =>[
        			'class' => AccessControl::className(),
        			'only' => ['views'],
        			'rules' => [
//         					'actions' => ['views'],
//         					'allow' => true,
//         					'roles' => ['?'],//'@'代表已授权用户
        			],
        	],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Activity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    

    /**
     * Displays a single Activity model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Activity();
        
       
        if(!empty($model->zipUpload)){
        	$model->zipUpload = UploadedFile::getInstance($model, 'zipUpload');
        }
        if($model->uploadZip()){
        	$model->act_attach = '1';
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->act_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Activity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->act_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /* 
     * 根据活动状态查询活动
     * 词穷了 帮忙想词！！！！！添加链接时候记得改呀！！！！！！！
     *  */
    public function actionViews(){
    	
//     	$state = 0;//\yii::$app->getParams('state');
//     	$searchModel = new ActivitySearch();

//     	$activity = ActivityMangerModel::getActivityByState($state);
    	$activity = ActivityMangerModel::getAllActivity();


    	return $this->render('views' ,['activity' => $activity]);
    	
    }

    /**
     * Deletes an existing Activity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
