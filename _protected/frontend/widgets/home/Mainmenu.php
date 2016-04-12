<?php
namespace frontend\widgets\home;

use Yii;
use yii\base\Widget;

class Mainmenu extends Widget
{
	public function run()
	{
		return $this->render('mainMenu');
		
	}
}