<?php
/* @var $this SysLogoController */
/* @var $model SysLogo */

$this->breadcrumbs=array(
	'Sys Logos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SysLogo', 'url'=>array('index')),
	array('label'=>'Manage SysLogo', 'url'=>array('admin')),
);
?>

<h1>Create SysLogo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>