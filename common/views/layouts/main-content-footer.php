<?php
/**
 * Main content footer templates.
 * @author Terry
 */
?>
<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
Green Cyber
</div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y'); ?> .</strong> All rights reserved.
</footer>
<?php
yii\bootstrap\Modal::begin([
	'headerOptions' => ['id' => 'modalHeader'],
	'id' => 'modal',
	'size' => 'modal-md',
	'header' => '1236545',
	'closeButton' => [
		'tag' => 'button',
		'label' => '&times;'
	],
	'footer' => false,
	//keeps from closing modal with esc key or by clicking out of the modal.
	// user must click cancel or X to close
	'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo '<div id="modalContent"><div style="text-align:center"><i class="fa fa-4x fa-refresh fa-spin"></i></div></div>';
yii\bootstrap\Modal::end();