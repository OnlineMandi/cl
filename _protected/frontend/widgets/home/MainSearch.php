<?php
namespace frontend\widgets\home;

use Yii;
use yii\base\Widget;
class MainSearch extends Widget
{
	public function run()
	{
		return $this->render('mainSearch');
		
	}
}