<?php
/* @var $this FilenewsController */
/* @var $model Filenews */

$this->breadcrumbs=array(
	'Filenews'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Filenews', 'url'=>array('index')),
	array('label'=>'Create Filenews', 'url'=>array('create')),
	array('label'=>'View Filenews', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Filenews', 'url'=>array('admin')),
);
?>

<h1>Update Filenews <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>