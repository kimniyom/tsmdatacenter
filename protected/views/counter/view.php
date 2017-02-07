<?php
/* @var $this CounterController */
/* @var $model Counter */

$this->breadcrumbs=array(
	'Counters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Counter', 'url'=>array('index')),
	array('label'=>'Create Counter', 'url'=>array('create')),
	array('label'=>'Update Counter', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Counter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Counter', 'url'=>array('admin')),
);
?>

<h1>View Counter #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ip',
		'date',
		'd_update',
	),
)); ?>
