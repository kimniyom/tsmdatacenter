<?php
/* @var $this HeadrowstablesController */
/* @var $model Headrowstables */

$this->breadcrumbs=array(
	'Headrowstables'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Headrowstables', 'url'=>array('index')),
	array('label'=>'Create Headrowstables', 'url'=>array('create')),
	array('label'=>'Update Headrowstables', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Headrowstables', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Headrowstables', 'url'=>array('admin')),
);
?>

<h1>View Headrowstables #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'report_id',
		'headname',
		'upper',
		'rows',
	),
)); ?>
