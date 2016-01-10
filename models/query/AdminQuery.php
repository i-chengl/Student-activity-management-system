<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Admin]].
 *
 * @see \app\models\Admin
 */
class AdminQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Admin[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Admin|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}