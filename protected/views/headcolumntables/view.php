<?php
/* @var $this HeadcolumntablesController */
/* @var $model Headcolumntables */

$this->breadcrumbs=array(
	'Headcolumntables'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Headcolumntables', 'url'=>array('index')),
	array('label'=>'Create Headcolumntables', 'url'=>array('create')),
	array('label'=>'Update Headcolumntables', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Headcolumntables', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Headcolumntables', 'url'=>array('admin')),
);
?>

<h1>View Headcolumntables #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'report_id',
		'headname',
		'colspan',
		'upper',
		'rows',
		'rowsnumber',
		'headname_en',
	),
)); ?>
