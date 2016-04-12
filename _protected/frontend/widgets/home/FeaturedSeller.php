<?php
namespace frontend\widgets\home;

use Yii;
use yii\base\Widget;

class FeaturedSeller extends Widget
{
	public function run()
	{
		return $this->render('featuredSeller');
		
	}
}