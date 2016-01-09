<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "act_admin".
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
        return 'act_admin';
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
            'adm_id' => 'Adm ID',
            'adm_name' => 'Adm Name',
            'adm_passwd' => 'Adm Passwd',
        ];
    }
}
