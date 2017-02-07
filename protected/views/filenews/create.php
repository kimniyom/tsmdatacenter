<?php
/* @var $this FilenewsController */
/* @var $model Filenews */

$this->breadcrumbs=array(
	'Filenews'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Filenews', 'url'=>array('index')),
	array('label'=>'Manage Filenews', 'url'=>array('admin')),
);
?>

<h1>Create Filenews</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>