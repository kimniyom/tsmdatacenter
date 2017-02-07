<?php
/* @var $this SysLogoController */
/* @var $model SysLogo */

$this->breadcrumbs=array(
	'Sys Logos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SysLogo', 'url'=>array('index')),
	array('label'=>'Create SysLogo', 'url'=>array('create')),
	array('label'=>'Update SysLogo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SysLogo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysLogo', 'url'=>array('admin')),
);
?>

<h1>View SysLogo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'Logo',
		'Distid',
		'Note',
		'active',
	),
)); ?>
