<?php

namespace common\models;

use Yii;
use yii\imagine\Image;
/**
 * This is the model class for table "slider_images".
 *
 * @property integer $id
 * @property integer $slider_id
 * @property string $title
 * @property string $image
 * @property integer $status
 *
 * @property Sliders $slider
 */
class SliderImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slider_id', 'title', 'image'], 'required'],
            [['slider_id', 'status'], 'integer'],
            [['title'], 'string', 'max' => 250],
            [['image'], 'image'],
            [['image'], 'file', 'extensions' => 'gif, jpg, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slider_id' => 'Slider ID',
            'title' => 'Title',
            'image' => 'Image',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlider()
    {
        return $this->hasOne(Sliders::className(), ['id' => 'slider_id']);
    }

    public function updateImage($image,$name)
    {
        $imagine = new Image();
        Yii::$app->params['upload'] = 'uploads/';
        Yii::$app->params['uploadPath'] = 'uploads/slides/';

        $mimage = $name.'.'. $image->extension;
        $uploadPath = Yii::$app->params['uploadPath'] .'/'. $mimage;

        if (!file_exists(Yii::$app->params['upload'])) {
            mkdir(Yii::$app->params['upload'], 0777, true);
        }
        if (!file_exists(Yii::$app->params['uploadPath'])) {
            mkdir(Yii::$app->params['uploadPath'], 0777, true);
        }
        if($image->saveAs($uploadPath)){

            return $mimage;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     * @return SliderImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SliderImagesQuery(get_called_class());
    }
}
