<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
	public $category;
	public $step;
	public $general_attrs;
	public $slider_attrs;
	public $feat_image;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'seller_id', 'category_id', 'quantity', 'price', 'market_price', 'description'], 'required'],
			['general_attrs', 'required', 
				 'message' => 'Please select one option.'
			],	
            [['seller_id', 'category_id', 'quantity', 'price', 'market_price', 'status', 'soldout', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['slider_attrs'], 'safe'],
            [['name'], 'string', 'max' => 110],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'seller_id' => 'Seller ID',
            'category_id' => 'Category ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'market_price' => 'Market Price',
            'description' => 'Description',
            'status' => 'Status',
            'soldout' => 'Soldout',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
	
	public function behaviors()
	{
		return [
		[
			'class' => TimestampBehavior::className(),
			'attributes' => [
				ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
				ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
			],
		],
		];
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getCat()
    {
        return $this->hasOne(Cat::className(), ['id' => 'category_id']);
    }	
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(Closet::className(), ['user_id' => 'seller_id']);
    }

    public function getFeatImage()
    {
        return $this->hasOne(ProductImages::className(), ['product_id' => 'id']);
    }	
	
    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
	
	public function getCategoryfilter(){

		$arr = array();
		$categories = Category::find()->orderBy('name')->all();
		foreach($categories as $cat){
			$arr[$cat->id] = $cat->name;
		}

		return $arr;
	}		
	public function getSellerfilter(){

		$arr = array();
		$sellers = Closet::find()->orderBy('name')->all();
		foreach($sellers as $seller){
			$arr[$seller->user_id] = $seller->name;
		}
		return $arr;
	}	
}
