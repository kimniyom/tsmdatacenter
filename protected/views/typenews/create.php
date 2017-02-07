<?php
/* @var $this TypenewsController */
/* @var $model Typenews */

$this->breadcrumbs=array(
	'Typenews'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Typenews', 'url'=>array('index')),
	array('label'=>'Manage Typenews', 'url'=>array('admin')),
);
?>

<h1>Create Typenews</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>