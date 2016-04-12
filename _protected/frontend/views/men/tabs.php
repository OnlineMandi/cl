						<div class="product-tab-head">
							<a class="active">Description</a>
							<a>Reviews (0)</a>
							<a>Additional Info</a>
							<a>Measurement Image</a>
							<a>Measurement Info</a>
						</div>
						<div class="product-tab-body">
							<div class="pro-disc">
								<h4>Quick Overview</h4>
								<p><?= $model->description ?></p>
							</div>
							<div class="reviews">
								<?php if(Yii::$app->user->isGuest){ ?>
									<p>Please login to give review!</p>
								<?php }else{
									echo $this->render('form', ['model' => $commentModel]);
								} ?>
																	
							</div>
							<div class="table-box">
								<table class="table table-bordered">
									<tbody>
										<?php foreach($otherInfo as $info){
											echo "<tr><th>".$info['name']."</th><td>".$info['value']."</td></tr>";											
										} ?>
									</tbody>
								</table>
							</div>
							<div>
								<img src="<?= Yii::$app->params['baseurl'] . '/uploads/medium/category/' . $model->cat->image ?>">
							</div>
							<div class="table-box">
								<table class="table table-bordered">
									<tbody>
										<?php foreach($meauserments as $meauserment){
											echo "<tr><th>".$meauserment['name']."</th><td>".$meauserment['value']."</td></tr>";											
										} ?>
									</tbody>
								</table>
							</div>							
						</div>