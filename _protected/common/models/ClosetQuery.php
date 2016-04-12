<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Closet]].
 *
 * @see Closet
 */
class ClosetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Closet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Closet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}