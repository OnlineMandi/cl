<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "states".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 *
 * @property Cities[] $cities
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'states';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 30]
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
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['state_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return StatesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatesQuery(get_called_class());
    }
}
