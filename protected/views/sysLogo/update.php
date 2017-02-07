<?php
/* @var $this SysLogoController */
/* @var $model SysLogo */

$this->breadcrumbs=array(
	'Sys Logos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SysLogo', 'url'=>array('index')),
	array('label'=>'Create SysLogo', 'url'=>array('create')),
	array('label'=>'View SysLogo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SysLogo', 'url'=>array('admin')),
);
?>

<h1>Update SysLogo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>