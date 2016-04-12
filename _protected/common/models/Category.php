<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $lvl
 * @property string $name
 * @property string $banner
 * @property string $image
 * @property string $meta_title
 * @property string $meta_descr
 * @property string $descr
 * @property string $icon
 * @property integer $icon_type
 * @property integer $active
 * @property integer $selected
 * @property integer $disabled
 * @property integer $readonly
 * @property integer $visible
 * @property integer $collapsed
 * @property integer $movable_u
 * @property integer $movable_d
 * @property integer $movable_l
 * @property integer $movable_r
 * @property integer $removable
 * @property integer $removable_all
 */
class Category extends \kartik\tree\models\Tree
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['root', 'lft', 'rgt', 'lvl', 'icon_type', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all','status','ptype'], 'integer'],
            [['name'], 'required'],
            [['descr'], 'string'],
            [['name'], 'string', 'max' => 60],
            [['slug'], 'string', 'max' => 1000],
            [['banner', 'image', 'meta_title', 'meta_descr', 'icon'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'root' => 'Root',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'lvl' => 'Lvl',
            'slug' => 'slug',
            'name' => 'Name',
            'status' => 'Status',
            'ptype' => 'Product Type',
            'banner' => 'Banner',
            'image' => 'Image',
            'meta_title' => 'Meta Title',
            'meta_descr' => 'Meta Descr',
            'descr' => 'Descr',
            'icon' => 'Icon',
            'icon_type' => 'Icon Type',
            'active' => 'Active',
            'selected' => 'Selected',
            'disabled' => 'Disabled',
            'readonly' => 'Readonly',
            'visible' => 'Visible',
            'collapsed' => 'Collapsed',
            'movable_u' => 'Movable U',
            'movable_d' => 'Movable D',
            'movable_l' => 'Movable L',
            'movable_r' => 'Movable R',
            'removable' => 'Removable',
            'removable_all' => 'Removable All',
        ];
    }
	
	public function getCategoryAttributes()
    {
        $model = CategoryAttributes::findOne(['category_id' => $this->id]);
		return $model;
    }
	public function getCreateAttrsModel()
	{
		$model = new CategoryAttributes();
		$model->category_id = $this->id;
		$model->general_attributes = serialize(array());
		$model->slider_attributes = serialize(array());
		$model->save();
		return $model;
	}
	public function getCategories($id){
		
	}
    /**
     * @inheritdoc
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
