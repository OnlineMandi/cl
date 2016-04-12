<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>



        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    [
                        'label' => 'User Management',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
							['label' => 'All Users', 'icon' => 'fa fa-file-code-o', 'url' => ['/user'],],
                            ['label' => 'Add New User', 'icon' => 'fa fa-dashboard', 'url' => ['/user/create'],],
                        ],
                    ],
					[   'label' => 'Global Settings',
                        'icon' => 'fa fa-cogs',
                        'url' => ['/global-setting/update?id=1'],
                        	
					],  
					[
                        'label' => 'Slider Management',
                        'icon' => 'fa fa-sliders',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Home Slider', 'icon' => 'fa fa-angle-right', 'url' => ['/slider-images/home-slider'],'active' => ($this->context->route == 'admin/slider-images/home-slider' ),],                           
                        ],
                    ],


					['label' => 'Menu Management', 'icon' => 'fa fa-bars', 'url' => ['/menu'],'active' => ($this->context->route == 'admin/menu/index'),],

					[
                        'label' => 'Pages Management',
                        'icon' => 'fa-file',
                        'url' => 'javascript:void(0);',
                        'items' => [
                            ['label' => 'All Pages', 'icon' => 'fa fa-angle-right', 'url' => ['/pages'],'active' => ($this->context->route == 'admin/pages/index'),],
                            ['label' => 'Add Page', 'icon' => 'fa fa-angle-right', 'url' => ['/pages/create'],'active' => ($this->context->route == '/pages/create'),],
                           
                        ],
                    ],	

                    ['label' => 'Category Management', 'icon' => 'fa fa-circle-o', 'url' => ['/category'],],
					[
                        'label' => 'Attribute Management',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Attributes', 'icon' => 'fa fa-angle-right', 'url' => ['/attributes'],],
                            ['label' => 'Input Type', 'icon' => 'fa fa-angle-right', 'url' => ['/entity'],],
                        ],
                    ],
					
                ],
				
            ]
        ) ?>

    </section>

</aside>
