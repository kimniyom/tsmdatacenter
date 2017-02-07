<?php
/* @var $this HeadrowstablesController */
/* @var $model Headrowstables */

$this->breadcrumbs=array(
	'Headrowstables'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Headrowstables', 'url'=>array('index')),
	array('label'=>'Create Headrowstables', 'url'=>array('create')),
	array('label'=>'View Headrowstables', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Headrowstables', 'url'=>array('admin')),
);
?>

<h1>Update Headrowstables <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>