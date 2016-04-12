<?php

namespace frontend\models;

use Yii;

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
            [['root', 'lft', 'rgt', 'lvl', 'icon_type', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all'], 'integer'],
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

    /**
     * @inheritdoc
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRootMenu()
    {

		$roots = Category::find()->roots()->all();
		
		foreach($roots as $root){
			print_r($root);
			die;
			
		}
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }	
	
}
