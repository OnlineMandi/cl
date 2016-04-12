<?php 
use frontend\widgets\Login;
use frontend\widgets\Registration;

?>

<!-- Login popup -->
<div class="login-popup" data-popup="login" data-popup-close="login">
    <div class="popup-box">
        <i class="fa fa-times" data-popup-close="login"></i>
		<?= Login::widget() ?>        
    </div>
</div>

<!-- Login popup -->
<div class="signup-popup" data-popup="signup" data-popup-close="signup">
    <div class="popup-box">
        <i class="fa fa-times" data-popup-close="signup"></i>
		<?= Registration::widget() ?>
    </div>
</div>