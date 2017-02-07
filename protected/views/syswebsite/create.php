<?php
/* @var $this SysWebsiteController */
/* @var $model SysWebsite */

$this->breadcrumbs=array(
	'Sys Websites'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SysWebsite', 'url'=>array('index')),
	array('label'=>'Manage SysWebsite', 'url'=>array('admin')),
);
?>

<h1>Create SysWebsite</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>