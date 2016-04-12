<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;

class Mainheader extends Widget
{
	public function run()
	{
		return $this->render('mainHeader', []);
	}
}