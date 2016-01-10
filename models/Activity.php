<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%activity}}".
 *
 * @property string $act_id
 * @property string $act_name
 * @property string $act_date_beg
 * @property string $act_date_end
 * @property string $act_time_submit
 * @property string $act_time_update
 * @property integer $act_is_personal
 * @property string $act_id_submit
 * @property string $act_host
 * @property string $act_partici
 * @property string $act_id_cat
 * @property integer $act_state
 * @property string $act_attach
 * @property string $act_comment
 * @property string $act_detail
 *
 * @property Category $actIdCat
 * @property User $actIdSubmit
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['act_name', 'act_date_beg', 'act_date_end', 'act_is_personal', 'act_id_submit', 'act_partici', 'act_id_cat', 'act_state', 'act_detail'], 'required'],
            [['act_date_beg', 'act_date_end', 'act_time_submit', 'act_time_update'], 'safe'],
            [['act_is_personal', 'act_id_submit', 'act_id_cat', 'act_state'], 'integer'],
            [['act_partici', 'act_comment', 'act_detail'], 'string'],
            [['act_name'], 'string', 'max' => 10],
            [['act_host', 'act_attach'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'act_id' => '活动id',
            'act_name' => '活动名称',
            'act_date_beg' => '活动起始日期',
            'act_date_end' => '活动结束日期',
            'act_time_submit' => '活动提交时间',
            'act_time_update' => '活动最后更新时间',
            'act_is_personal' => '是否个人活动(参与者可数)',
            'act_id_submit' => '活动所有者(该活动表提交者)',
            'act_host' => '主办方',
            'act_partici' => '活动参与者(存储参与者id，函数分割/查询/统计)',
            'act_id_cat' => '活动所属类别id',
            'act_state' => '活动状态(待审核/审核未通过/完结)',
            'act_attach' => '附件',
            'act_comment' => '备注',
            'act_detail' => '详情(指导老师，描述，介绍，总结...)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActIdCat()
    {
        return $this->hasOne(Category::className(), ['cat_id' => 'act_id_cat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActIdSubmit()
    {
        return $this->hasOne(User::className(), ['usr_id' => 'act_id_submit']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\ActivityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ActivityQuery(get_called_class());
    }
}
