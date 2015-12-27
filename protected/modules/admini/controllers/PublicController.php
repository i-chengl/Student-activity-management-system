<?php
/**
 * 公共登录
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.admini.Controller
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class PublicController extends Controller
{

    /**
     * 会员登录
     */
    public function actionLogin ()
    {
        $model = new Admin('login');
        if (XUtils::method() == 'POST') {
            $model->attributes = $_POST['Admin'];
            if ($model->validate()) {
                $data = $model->find('username=:username', array ('username' => $model->username ));
                if ($data === null) {
                    $model->addError('username', '用户不存在');
                    AdminLogger::_create(array ('catalog' => 'login' , 'intro' => '登录失败，用户不存在:' . CHtml::encode($model->username) , 'user_id' => 0 ));
                } elseif (! $model->validatePassword($data->password)) {
                    $model->addError('password', '密码不正确');
                    AdminLogger::_create(array ('catalog' => 'login' , 'intro' => '登录失败，密码不正确:' . CHtml::encode($model->username). '，使用密码：'.CHtml::encode($model->password) , 'user_id' => 0 ));
                } elseif ($data->group_id == 2) {
                    $model->addError('username', '用户被锁定，请联系网站管理');
                } else {
                    parent::_stateWrite(
                        array(
                            'userId'=>$data->id,
                            'userName'=>$data->username,
                            'groupId'=>$data->group_id,
                            'super'=>$data->group_id == 1 ? 1 : 0,
                        ),array('prefix'=>'_admini')
                    );

                    $data->last_login_ip = XUtils::getClientIP();
                    $data->last_login_time = time();
                    $data->login_count = $data->login_count+1;
                    $data->save();
                    AdminLogger::_create(array ('catalog' => 'login' , 'intro' => '用户登录成功:'.CHtml::encode($model->username) ));
                    $this->redirect(array('default/index'));
                }
            }
        }
        $this->render('login', array ('model' => $model ));
    }

    /**
     * 退出登录
     */
    public function actionLogout ()
    {
        parent::_sessionRemove('_admini');
        $this->redirect(array ('public/login' ));
    }
}

?>