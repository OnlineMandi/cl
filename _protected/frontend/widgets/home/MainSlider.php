<?php
namespace frontend\widgets\home;

use Yii;
use yii\base\Widget;
use common\models\SliderImages;

class MainSlider extends Widget
{
	public $images;
	public function run()
	{
		$this->images = SliderImages::find()->where(['slider_id'=>1, 'status' => 1])->all();
		return $this->render('mainSlider', [
			'images' =>  $this->images,
        ]);
	}
}