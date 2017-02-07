<?php
/* @var $this SysWebsiteController */
/* @var $model SysWebsite */

$this->breadcrumbs=array(
	'Sys Websites'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SysWebsite', 'url'=>array('index')),
	array('label'=>'Create SysWebsite', 'url'=>array('create')),
	array('label'=>'View SysWebsite', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SysWebsite', 'url'=>array('admin')),
);
?>

<h1>Update SysWebsite <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>