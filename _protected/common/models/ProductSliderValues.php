<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_slider_values".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $value
 * @property integer $status
 *
 * @property Product $product
 */
class ProductSliderValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_slider_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'value'], 'required'],
            [['product_id', 'status'], 'integer'],
            [['value'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'value' => 'Value',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
	
    public function getAttr()
    {
        return $this->hasOne(Attributes::className(), ['id' => 'attr_id']);
    }
	
	
}
