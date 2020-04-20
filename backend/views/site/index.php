<?php

/* @var $this yii\web\View */
/* @var $companyMap Array */
/* @var $model common\models\ParkingSlip */
/* @var $operation string */



use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\base\Model;



$this->title = 'Dashboard';
?>
<div class="site-index">
	<div class="box box-success">
	<?php
	$form = ActiveForm::begin([
		'id' => 'check-in-out-form',
		'action' => Url::to(['/entry/record-entry', 'operation' => $operation]),
		'enableAjaxValidation' => true,
		'options' => [
				'autocomplete' => 'off'
		]
	]);
	echo Html::beginTag('div', ['class' => 'box-body']);
	echo Html::beginTag('div', ['class' => 'col-md-4']);
	
	echo $form->field($model, 'tagid', [
		'inputOptions' => [
				'class' => 'form-control',
				'autofocus' => true,
				'value' => ''
			]
	]);
	echo Html::endTag('div');
	echo Html::endTag('div');
	echo Html::beginTag('div', [
		'class' => 'box-footer'
	]);
	
	echo Html::button($model->generateAttributeLabel($operation), [
		'type' => 'submit',
		'name' => $operation,
		'value' => 1,
		'class' => 'btn btn-success'
	]);
	echo Html::endTag('div');
	ActiveForm::end();
	?>
	</div>
	<div class="box box-success">
	<?php 
	$count = 1;
	foreach ($companyMap as $cid => $name) {
		$bg = 'bg-blue';
		if(($count % 2) == 0) {
			$bg = 'bg-red';
		}
		?>
		<div class="col-md-6 col-sm-12 col-xs-12 company<?= $cid ?>">
           <div class="info-box <?= $bg ?>">
            <span class="info-box-icon"><?= Icon::show('car') ?></span>

            <div class="info-box-content">
	              <span class="info-box-text"><?= $name ?></span>
	              <span class="info-box-text">Taken / Available Slots</span>
	              
	              <span class="info-box-number"> 0 / 0</span>
	
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
    <?php 
    $count++;
	}
	?>
	</div>
		
	
    
</div>

<?php 
$companyArray = json_encode(array_keys($companyMap));
$url = Url::to(['/site/index']);
$js = <<<JS
var companyArray = $companyArray;
setInterval(function() {
  refreshSlots();
}, 1000 * 60 * 0.25);

function refreshSlots() {
	$.each(companyArray, function(index, value) {
		var req = $.ajax({
	        type:"get",
	        url:"$url",
	        data:{ajax:1, companyId:value}
	    });
		req.done(function(data) {
			$('.company' + value + ' .info-box-number').html(data.takenSpaces + " / " + data.companySpaces);
			$('.company' + value + ' .progress-bar').css('width', data.parkingAvailablePercentage + '%');
			$('.company' + value + ' .progress-description').html(data.parkingAvailablePercentage + '% Full')
		});
	});
	
}
refreshSlots();

$("#check-in-out-form").on("afterValidate", function (event, messages, errorAttributes) {
	console.log(messages);
	console.log(errorAttributes);
	if(errorAttributes.length > 0) {
		$("#entry-tagid").val('');
	}
});
JS;
$this->registerJs($js);
?>
