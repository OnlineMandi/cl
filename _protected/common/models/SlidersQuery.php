<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Sliders]].
 *
 * @see Sliders
 */
class SlidersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Sliders[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Sliders|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}