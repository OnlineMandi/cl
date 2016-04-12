<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_dropdown_values".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $value_id
 * @property integer $status
 *
 * @property DropdownValues $value
 * @property Product $product
 */
class ProductDropdownValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_dropdown_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'value_id'], 'required'],
            [['product_id', 'value_id', 'status'], 'integer']
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
            'value_id' => 'Value ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValue()
    {
        return $this->hasOne(DropdownValues::className(), ['id' => 'value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
	
}
