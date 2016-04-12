<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SliderImages]].
 *
 * @see SliderImages
 */
class SliderImagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SliderImages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SliderImages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}