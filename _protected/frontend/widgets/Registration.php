<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use frontend\models\SignupForm;
use common\models\Profile;
use common\models\Closet;

class Registration extends Widget
{
	public function run()
	{
		// get setting value for 'Registration Needs Activation'
        $rna = Yii::$app->params['rna'];

        // if 'rna' value is 'true', we instantiate SignupForm in 'rna' scenario
        $model = $rna ? new SignupForm(['scenario' => 'rna']) : new SignupForm();
		$profile = new Profile();
		$closet = new Closet();
		return $this->render('registration', 
		[
            'model'  => $model,
            'profile'  => $profile,
            'closet'  => $closet,
        ]);
		
	}
}