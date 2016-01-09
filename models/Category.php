<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "act_category".
 *
 * @property string $cat_id
 * @property string $cat_name
 * @property integer $cat_level
 * @property string $cat_id_parent
 *
 * @property ActActivity[] $actActivities
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'act_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name', 'cat_level'], 'required'],
            [['cat_level', 'cat_id_parent'], 'integer'],
            [['cat_name'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'cat_name' => 'Cat Name',
            'cat_level' => 'Cat Level',
            'cat_id_parent' => 'Cat Id Parent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActActivities()
    {
        return $this->hasMany(Activity::className(), ['act_id_cat' => 'cat_id']);
    }
}
