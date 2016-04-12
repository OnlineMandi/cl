<?php
namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use common\models\LoginForm;

class Login extends Widget
{
	public function run()
	{
        // get setting value for 'Login With Email'
        $lwe = Yii::$app->params['lwe'];

        // if 'lwe' value is 'true' we instantiate LoginForm in 'lwe' scenario
        $model = $lwe ? new LoginForm(['scenario' => 'lwe']) : new LoginForm();	
		
		return $this->render('login', 
		[
            'model'  => $model,
        ]);
		
	}
}