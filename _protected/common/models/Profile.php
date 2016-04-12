<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string $fname
 * @property string $lname
 * @property string $phone
 * @property integer $city_id
 * @property string $image
 */
class Profile extends \yii\db\ActiveRecord
{
	
	public $is_seller;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname', 'phone'], 'required'],
            [['user_id', 'city_id','is_seller'], 'integer'],
            [['fname', 'lname'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 14],
            [['image'], 'string', 'max' => 100],
            ['phone', 'unique', 'targetClass' => '\common\models\Profile', 
                'message' => 'This phone has already been taken.'],

        ];
    }

	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'fname' => 'First name',
            'lname' => 'Last name',
            'is_seller' => 'Want to become seller',
            'phone' => 'Phone',
            'gender' => 'Gender',
            'city_id' => 'City ID',
            'image' => 'Image',
        ];
    }

    /**
     * @inheritdoc
     * @return ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileQuery(get_called_class());
    }
}
