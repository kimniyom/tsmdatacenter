<?php
/* @var $this FilenewsController */
/* @var $model Filenews */

$this->breadcrumbs=array(
	'Filenews'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Filenews', 'url'=>array('index')),
	array('label'=>'Create Filenews', 'url'=>array('create')),
	array('label'=>'Update Filenews', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Filenews', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Filenews', 'url'=>array('admin')),
);
?>

<h1>View Filenews #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'news',
		'filename',
	),
)); ?>
