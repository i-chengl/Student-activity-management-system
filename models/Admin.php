<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property string $adm_id
 * @property string $adm_name
 * @property string $adm_passwd
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adm_name', 'adm_passwd'], 'required'],
            [['adm_name'], 'string', 'max' => 10],
            [['adm_passwd'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'adm_id' => 'id',
            'adm_name' => '姓名',
            'adm_passwd' => '密码',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\AdminQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\AdminQuery(get_called_class());
    }
}
