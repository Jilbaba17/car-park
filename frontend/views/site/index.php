<?php

use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use conquer\momentjs\MomentjsAsset;

/* @var $this yii\web\View */

$this->title = 'Dashboard';
MomentjsAsset::register($this);
// echo Url::home(true);
?>
<div class="site-index">

    <div class="jumbotron">
        <h2><?= Yii::$app->name; ?> | Dashboard</h2>

        <!--<p class="lead">Parking App</p>-->

        <p><img src="images/logo.png"></p>
    </div>

    <div class="body-content">
        <div class="row">
	        <div id="userInfo" class="col-md-6 col-sm-12 col-xs-12">
	           <div class="info-box bg-blue">
	            <span class="info-box-icon"><?= Icon::show('clock-o') ?></span>
	
	            <div class="info-box-content">
	              <span class="info-box-text"><?= $companyName ?></span>
	              <span class="info-box-text"><?= $user['names'] ?></span>
	              
	
	              <div class="progress">
	                <div class="progress-bar" style="width: 0%"></div>
	              </div>
	              <span class="info-box-time"> 0 / 0</span>
	              
	                  
	            </div>
	            <!-- /.info-box-content -->
	          </div>
	          <!-- /.info-box -->
	        </div>
	           <div class="col-md-6 col-sm-12 col-xs-12">
	           <div class="info-box bg-red">
	            <span class="info-box-icon"><?= Icon::show('car') ?></span>
	
	            <div class="info-box-content">
	              <span class="info-box-text"></span>
	              <span class="info-box-text">Taken / Available Slots</span>
	              
	              <span class="info-box-number"> 0 / 0</span>
					<span class="refresh-button pull-right">
	                   <a class="btn btn-success btn-sm fa-lg" onclick="refreshSlots()">
               				<i class="fa fa-refresh"></i> Refresh
              			</a>
	                  </span>
	              <div class="progress">
	                <div class="progress-bar" style="width: 0%"></div>
	              </div>
	                  <span class="progress-description">
	                    0% Full
	                  </span>
	            </div>
	            <!-- /.info-box-content -->
	          </div>
	          <!-- /.info-box -->
        	</div>
        	
        </div>
	<?php 
	$this->registerJsFile(Url::home(true). 'js/updateParking.js', ['depends' => JqueryAsset::className()]);
	?>
    </div>
</div>
<?php 
$js = <<<JS

function displayTime() {
	$('.info-box-time').html(moment().format("dddd, MMMM Do YYYY, h:mm:ss A"));
    setTimeout(displayTime, 1000);
}
displayTime();

$(window).scrollTop($('#userInfo').offset().top);

JS;
$this->registerJs($js, $this::POS_READY);
?>
