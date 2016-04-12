<?php
namespace frontend\widgets\home;
use Yii;
use yii\base\Widget;

class RecentProducts extends Widget
{
	public function run()
	{
		return $this->render('recentProducts');
		
	}
}