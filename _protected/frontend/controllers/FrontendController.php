<?php
namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

/**
 * FrontendController extends Controller and implements the behaviors() method
 * where you can specify the access control ( AC filter + RBAC) for
 * your controllers and their actions.
 */
class FrontendController extends Controller
{
    /**
     * Returns a list of behaviors that this component should behave as.
     * Here we use RBAC in combination with AccessControl filter.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'controllers' => ['article'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'admin'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'controllers' => ['seller'],
                        'actions' => ['design', 'select-category', 'add-product', 'subcategories', 'feedbacks', 'questions','list-products', 'sold-products', 'refunded-products', 'coupons', 'closet-lovers','subscriptions', 'comments'],
                        'allow' => true,
						 'roles' => ['seller'],
                    ],
					
                    [
                        'controllers' => ['account'],
                        'actions' => ['index','dashboard', 'information','address','newsletter','notifications'],
                        'allow' => true,
						 'roles' => ['member']
                    ],
					[
                        'controllers' => ['product'],
                        'actions' => ['index','create', 'update','delete'],
                        'allow' => true,
						 'roles' => ['seller']
                    ],
					
                    [
                        'controllers' => ['customer'],
                        'actions' => ['favourite','become-seller', 'orders','comments','questions','wishlist','feedbacks'],
                        'allow' => true
                    ],					
                    [
                        'controllers' => ['men','women'],
                        'actions' => ['index','product','comment'],
                        'allow' => true
                    ],

                ], // rules

            ], // access

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ], // verbs

        ]; // return

    } // behaviors

} // AppController
