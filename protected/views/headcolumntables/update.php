<?php
/* @var $this HeadcolumntablesController */
/* @var $model Headcolumntables */

$this->breadcrumbs=array(
	'Headcolumntables'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Headcolumntables', 'url'=>array('index')),
	array('label'=>'Create Headcolumntables', 'url'=>array('create')),
	array('label'=>'View Headcolumntables', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Headcolumntables', 'url'=>array('admin')),
);
?>

<h1>Update Headcolumntables <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>