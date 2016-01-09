<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "act_user".
 *
 * @property string $usr_id
 * @property string $usr_name
 * @property string $usr_passwd
 * @property integer $usr_state
 * @property string $usr_depart
 * @property string $usr_class
 *
 * @property ActActivity[] $actActivities
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'act_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usr_id', 'usr_name', 'usr_passwd', 'usr_state'], 'required'],
            [['usr_id', 'usr_state'], 'integer'],
            [['usr_name'], 'string', 'max' => 10],
            [['usr_passwd', 'usr_class'], 'string', 'max' => 20],
            [['usr_depart'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usr_id' => '学号/工号',
            'usr_name' => '姓名',
            'usr_passwd' => '密码',
            'usr_state' => '状态（0.学生，1.教师）',
            'usr_depart' => '学院',
            'usr_class' => '班级',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActActivities()
    {
        return $this->hasMany(Activity::className(), ['act_id_submit' => 'usr_id']);
    }
}
