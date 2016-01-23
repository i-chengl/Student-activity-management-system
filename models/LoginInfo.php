<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "login_info".
 *
 * @property integer $id
 * @property string $session_id
 * @property string $login_ip
 * @property string $login_id
 * @property integer $login_flag
 * @property string $add_time
 * @property string $update_time
 */
class LoginInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'login_info';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('testDb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['session_id'], 'required'],
            [['login_flag'], 'integer'],
            [['add_time', 'update_time'], 'safe'],
            [['session_id', 'login_ip'], 'string', 'max' => 64],
            [['login_id'], 'string', 'max' => 20],
            [['session_id', 'login_flag'], 'unique', 'targetAttribute' => ['session_id', 'login_flag'], 'message' => 'The combination of 用户中心jessionIdNb and 登陆状态 0未登陆 1登陆 has already been taken.'],
            [['session_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'session_id' => '用户中心jessionIdNb',
            'login_ip' => '登陆ip',
            'login_id' => '登陆身份标识',
            'login_flag' => '登陆状态 0未登陆 1登陆',
            'add_time' => '登陆时间',
            'update_time' => '更新时间',
        ];
    }
}
