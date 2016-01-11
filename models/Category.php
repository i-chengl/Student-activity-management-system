<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $cat_id
 * @property string $cat_name
 * @property integer $cat_level
 * @property string $cat_id_parent
 *
 * @property Activity[] $activities
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name', 'cat_level', 'cat_id_parent'], 'required'],
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
            'cat_id' => '活动类别id',
            'cat_name' => '类别名称',
            'cat_level' => '类别深度(1，2...级分类)',
            'cat_id_parent' => '父类别id(level为1时此处为NULL)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['act_id_cat' => 'cat_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CategoryQuery(get_called_class());
    }
}
