<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "closet".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $descr
 * @property string $banner
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Closet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'closet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 70],
            [['descr'], 'string', 'max' => 1800],
			[['banner'], 'string', 'max' => 100],
            ['name', 'unique', 'targetClass' => '\common\models\Closet', 
                'message' => 'closet name has already been taken.'],
		
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'descr' => 'Descr',
            'banner' => 'Banner',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return ClosetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClosetQuery(get_called_class());
    }
}
